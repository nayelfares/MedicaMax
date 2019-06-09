<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

use Response;
use DB;
use Status;
Use App\Company;
use Intervention\Image\ImageServiceProvider;
use App\Picture;
use App\Http\Controllers\PictureController;
use App\Exports\CompaniesExport;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\CompaniesImport;
use App\Imports\ATC_ODDImport;

class CompanyController extends Controller
{
    

public function __construct(){
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = DB::table('companies')
        ->leftJoin('statuses', 'companies.status_id', '=', 'statuses.id')
        ->select('companies.id', 'companies.en_name','companies.ar_name','companies.location','statuses.en_name as status_en_name')
        ->get();
        $count = DB::table('companies')->count();
        //return view('aa/a/aaa'); 
        return view('drugAdministration/companies/index', compact('companies','count')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from statuses');
        return view('/drugAdministration/companies/create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //dd($request);
        $this->validateInput($request);
        // Upload image
        $image_name = null;
        if($request->file('company_logo')){
            $image_name = time() . '.' . $request->company_logo->getClientOriginalExtension();
            $request->company_logo->move(public_path('images/company_logo'),$image_name);
        }

        $company_id = Company::create([
                        'en_name' => $request['en_name'],
                        'ar_name' => $request['ar_name'],
                        'en_article' => $request['en_article'],
                        'ar_article' => $request['ar_article'],
                        'location' => $request['location'],
                        'company_logo' => $image_name,
                        'status_id' => $request['status_id']
                    ])->id;

        //create imags
        if($request->hasfile('pictures')){
          foreach($request->file('pictures') as $image)
            {
                $name=time() . '.' .$image->getClientOriginalName();
                $imageUrl = public_path().'/images/company/'.$name;
                Image::make($image)->resize(200, 200)->save($imageUrl);
            
                Picture::create([
                  'title' =>  $name,
                  'path' => public_path().'/images/company/' ,
                  'class_name' => 'company',
                  'object_id' => $company_id
                ]); 
            }
          }

        return redirect()->intended('/drug-administration/company');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = DB::table('companies')
        ->leftJoin('statuses', 'companies.status_id', '=', 'statuses.id')
        ->select('companies.*','statuses.en_name as status_en_name')
        ->where('companies.id','=',$id)->first();

        $pictures = DB::table('pictures')->where([['object_id','=',$id],['class_name','=','company']])->get();

        return view('drugAdministration/companies/show', ['company' => $company ,'pictures' => $pictures ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($company == null ) {
            return redirect()->intended('drug-administration/company');
        }
         
        $status = DB::select('select * from statuses');
        $images = DB::table('pictures')->where(([['object_id','=',$id],['class_name','=','company']]))->get();
        return view('drugAdministration/companies/edit', ['company' => $company , 'status' =>$status , 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $image_name = $company->company_logo;
// Upload company logo
        if ($request->file('company_logo')) {
            $image_name = time() . '.' . $request->company_logo->getClientOriginalExtension();
            $request->company_logo->move(public_path('images/company_logo'),$image_name);
        }
//upload company picture        
        if($request->hasfile('pictures'))
        {

            foreach($request->file('pictures') as $image)
            {
                $name=time() . '.' .$image->getClientOriginalName();
                $imageUrl = public_path().'/images/company/'.$name;
               // $image->move(public_path().'/images/', $name); 
                Image::make($image)->resize(200, 200)->save($imageUrl); 
              //  $data[] = $name; 
                Picture::create([
                  'title' =>  $name,
                  'path' => public_path().'/images/company/' ,
                  'class_name' => 'company',
                  'object_id' => $id
                ]); 
            } 
        }

        $input = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'en_article' => $request['en_article'],
            'ar_article' => $request['ar_article'],
            'location' => $request['location'],
            'company_logo' => $image_name,
            'status_id' => $request['status_id']
        ];
        $this->validate($request, [
        'en_name' => 'required| unique:companies,en_name,'.$id.''
        ]);
        Company::where('id', $id)
            ->update($input);
        
        return redirect()->intended('drug-administration/company');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Company::where('id', $id)->delete();
         return redirect()->intended('drug-administration/company');
    }

     public function search(Request $request) {
    //    dd($request);
        $constraints = [           
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'location' => $request['location'],
            ];

        $companies = $this->doSearchingQuery($constraints);
       return view('drugAdministration/companies/index', ['companies' => $companies, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        //$query = unit::query();
         $query = DB::table('companies')
        ->leftJoin('statuses', 'companies.status_id', '=', 'statuses.id')
        ->select('companies.id', 'companies.en_name','companies.ar_name','companies.location', 'statuses.en_name as status_en_name');
        $fields = array_keys($constraints);
        $index = 0;

        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( 'companies.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
       
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
            'en_name' => 'required|unique:companies',
           // 'company_logo' => 'image:mimes:jpg,gif,png,jpeg|max:2048'
            ]);
    }
        /* export excel file*/
    public function companiessExport(){
     
        return Excel::download( new CompaniesExport , 'companies.xls');

    }

    /* import excel file*/
    public function importInterface(){
        return view('/drugAdministration/companies/importExcel');
    }



    public function companiesImport() 
    {
        //Excel::import(new ATC_ODDImport, request()->file('file'));
        Excel::import(new CompaniesImport, request()->file('file'));
        return redirect()->intended('drug-administration/company')->with('success', 'All good!');;
    }
}
