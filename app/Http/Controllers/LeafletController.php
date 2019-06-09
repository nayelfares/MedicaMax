<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Status;
use App\Leaflet; 
use App\company;


class LeafletController extends Controller
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
        $leaflets = DB::table('leaflets')
        ->leftJoin('statuses', 'leaflets.status_id', '=', 'statuses.id')
        ->leftJoin('companies' ,'leaflets.company_id' ,'=','companies.id')
        ->select('leaflets.*' , 'companies.en_name as company_en_name' ,'statuses.en_name as status_en_name')
        ->get();
   
        $count = DB::table('leaflets')->count();
        return view('drugAdministration/leaflets/index', compact('leaflets','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from statuses');
        $companies = DB::select('select * from companies');
        return view('/drugAdministration/leaflets/create',compact('status','companies'));
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


         Leaflet::create([
            'name' => $request['name'],
            'en_leaflet' => $request['en_leaflet'],
            'ar_leaflet' => $request['ar_leaflet'],
            'company_id' => $request['company_id'],
            'status_id' => $request['status_id']
        ]);

        return redirect()->intended('/drug-administration/leaflet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $leaflet = DB::table('leaflets')
        ->leftJoin('statuses', 'leaflets.status_id', '=', 'statuses.id')
        ->leftJoin('companies' ,'leaflets.company_id' ,'=','companies.id')
        ->select('leaflets.*' , 'companies.en_name as company_en_name' ,'statuses.en_name as status_en_name')
        ->where('leaflets.id','=',$id)->first();
        return view('/drugAdministration/leaflets/show',compact('leaflet'));
       
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leaflet = Leaflet::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($leaflet == null ) {
            return redirect()->intended('drug-administration/leaflet');
        }
         
        $status = DB::select('select * from statuses');
        $companies =DB::select('select * from companies');
        return view('drugAdministration/leaflets/edit', ['leaflet' => $leaflet,'companies' => $companies , 'status' =>$status]);
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

        $leaflet = Leaflet::findOrFail($id);
        $input = [
            'name' => $request['name'],
            'en_leaflet' => $request['en_leaflet'],
            'ar_leaflet' => $request['ar_leaflet'],
            'company_id' => $request['company_id'],
            'status_id' => $request['status_id']
        ];
        $this->validate($request, [
        'name' => 'required | unique:leaflets,name,'.$id.''
        ]);
        Leaflet::where('id', $id)
            ->update($input);

        return redirect()->intended('/drug-administration/leaflet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Leaflet::where('id', $id)->delete();
     return redirect()->intended('drug-administration/leaflet');
    }


    public function search(Request $request) {
    //    dd($request);
        $constraints = [           
            'en_leaflet' => $request['en_leaflet'],
            'ar_leaflet' => $request['ar_leaflet'],
            ];

        $leaflets = $this->doSearchingQuery($constraints);
       return view('drugAdministration/leaflets/index', ['leaflets' => $leaflets, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        //$query = unit::query();
         $query = DB::table('leaflets')
        ->leftJoin('statuses', 'leaflets.status_id', '=', 'statuses.id')
        ->leftJoin('companies' ,'leaflets.company_id' ,'=','companies.id')
        ->select('leaflets.id', 'leaflets.en_leaflet','leaflets.ar_leaflet', 'companies.en_name as company_en_name' ,'statuses.en_name as status_en_name');
        $fields = array_keys($constraints);
        $index = 0;

        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( 'leaflets.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required|unique:leaflets'
            ]);
    }
}
