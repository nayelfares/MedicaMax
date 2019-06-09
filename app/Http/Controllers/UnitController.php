<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;
use App\Unit;
use App\Status;

class UnitController extends Controller
{ 

public function __construct(){
    $this->middleware('auth');
}
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 /*   public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = DB::table('units')
        ->leftJoin('statuses', 'units.status_id', '=', 'statuses.id')
        ->select('units.id', 'units.en_name','units.ar_name', 'statuses.en_name as status_en_name')
        ->get();

        $count = DB::table('units')->count();
   
        
        return view('drugAdministration/units/index', compact('units','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$status = DB::select('select * from statuses');
        return view('/drugAdministration/units/create',compact('status'));
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
         Unit::create([
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
        ]);

        return redirect()->intended('/drug-administration/unit');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($unit == null ) {
            return redirect()->intended('drug-administration/unit');
        }
         
        $status = DB::select('select * from statuses');
        return view('drugAdministration/units/edit', ['unit' => $unit , 'status' =>$status]);
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
      
        $unit = Unit::findOrFail($id);
        $input = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
        ];
        $this->validate($request, [
        'en_name' => 'required | unique:units,en_name,'.$id.''
        ]);

        Unit::where('id', $id)
            ->update($input);
        
        return redirect()->intended('drug-administration/unit');
    }  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::where('id', $id)->delete();
         return redirect()->intended('drug-administration/unit');
    }

    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
    //    dd($request);
        $constraints = [           
            'en_name' => $request['english_name'],
            'ar_name' => $request['arabic_name']
            ];

        $units = $this->doSearchingQuery($constraints);
       return view('drugAdministration/units/index', ['units' => $units, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        //$query = unit::query();
         $query = DB::table('units')
        ->leftJoin('statuses', 'units.status_id', '=', 'statuses.id')
        ->select('units.id', 'units.en_name','units.ar_name', 'statuses.en_name as status_en_name');
        $fields = array_keys($constraints);
        $index = 0;

        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( 'units.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
       
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
            'en_name' => 'required|unique:units',
            ]);
    }



    
}
