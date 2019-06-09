<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Status;
use App\Unit; 
use App\Form;
use App\Exports\FormsExport;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\FormsImport;
use App\Imports\ATC_ODDImport;

class FormController extends Controller
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
        $forms = DB::table('forms')
        ->leftjoin('forms as parent_form','forms.parent_id','=','parent_form.id')
        ->leftJoin('statuses', 'forms.status_id', '=', 'statuses.id')
        ->select('forms.*','parent_form.en_name as parent_en_name','statuses.en_name as status_en_name')
        ->get();
        
        $count = DB::table('forms')->count();

        return view('drugAdministration/forms/index', compact('forms','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from statuses');
        $forms = DB::table('forms')->where('status_id','<>',2)->orderBy('en_name')->get();
        return view('/drugAdministration/forms/create',compact('status','forms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validateInput($request);
     
       Form::create([
        'en_name'=>$request['en_name'],
        'ar_name' => $request['ar_name'],
        'parent_id' =>$request['parent_id'],
        'form_unit' =>$request['form_unit'],
        'amount' =>$request['amount'],
        'status_id' => $request['status_id']
       ]);

       return redirect()->intended('/drug-administration/form');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = Form::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($form == null ) {
            return redirect()->intended('drug-administration/form');
        }
        $status = DB::select('select * from statuses');
        $forms = DB::table('forms')->where('status_id','<>',2)->where('id','<>',$id)->orderBy('en_name')->get();
        return view('/drugAdministration/forms/edit',compact('status','forms','form'));
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
        $form = Form::findOrFail($id);

        $input = [
            'en_name'=>$request['en_name'],
            'ar_name' => $request['ar_name'],
            'parent_id' =>$request['parent_form'],
            'form_unit' =>$request['form_unit'],
            'amount' =>$request['amount'],
            'status_id' => $request['status_id']
        ];
        $this->validate($request, [
        'en_name' => 'required | unique:forms,en_name,'.$id.''
        ]);
        Form::where('id', $id)
            ->update($input);
        
        return redirect()->intended('drug-administration/form');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        Form::where('id', $id)->delete();
         return redirect()->intended('drug-administration/form');
    }
    
    public function search(Request $request) {
    //    dd($request);
        
        $constraints = [           
            'en_name' => $request['english_name'],
            'ar_name' => $request['arabic_name'],
            ];
 
        $forms = $this->doSearchingQuery($constraints);
       return view('drugAdministration/forms/index', ['forms' => $forms, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        //$query = unit::query();
         $query = DB::table('forms')
        ->leftjoin('forms as parent_form','forms.parent_id','=','parent_form.id')
        ->leftJoin('statuses', 'forms.status_id', '=', 'statuses.id')
        ->select('forms.id', 'forms.en_name','forms.ar_name', 'forms.amount' ,'forms.form_unit','parent_form.en_name as parent_en_name','statuses.en_name as status_en_name');
        $fields = array_keys($constraints);
        $index = 0;

        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( 'forms.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
       
        return $query->paginate(5);
    }

    private function validateInput($request) {

        $this->validate($request, [
            'en_name' => 'required|unique:forms'
        ]);
    }

/* export excel file*/
    public function formsExport(){
     
        return Excel::download( new FormsExport , 'forms.xls');

    }

    /* import excel file*/
    public function importInterface(){
        return view('/drugAdministration/forms/importExcel');
    }



    public function formsImport() 
    {
        //Excel::import(new ATC_ODDImport, request()->file('file'));
        Excel::import(new FormsImport, request()->file('file'));
        return redirect()->intended('drug-administration/form')->with('success', 'All good!');;
    }



}
