<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Giving;
use App\Status;
class GivingController extends Controller
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
        $givings = DB::table('givings')
        ->leftJoin('statuses', 'givings.status_id', '=', 'statuses.id')
        ->select('givings.id', 'givings.en_name','givings.ar_name', 'statuses.en_name as status_en_name')
        ->get();
        $count = DB::table('givings')->count();
   
        
        return view('drugAdministration/givings/index', compact('givings','count'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from statuses');
        return view('/drugAdministration/givings/create',compact('status'));
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
         Giving::create([
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
        ]);

        return redirect()->intended('/drug-administration/giving');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giving = Giving::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($giving == null ) {
            return redirect()->intended('drug-administration/giving');
        }
         
        $status = DB::select('select * from statuses');
        return view('drugAdministration/givings/edit', ['giving' => $giving , 'status' =>$status]);
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
        $giving = Giving::findOrFail($id);
        $input = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
        ];
        $this->validate($request, [
        'en_name' => 'required | unique:givings,en_name,'.$id.'',
        'status_id' => 'required'
        ]);
        Giving::where('id', $id)
            ->update($input);
        
        return redirect()->intended('drug-administration/giving');
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
        Giving::where('id', $id)->delete();
         return redirect()->intended('drug-administration/giving');
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

        $givings = $this->doSearchingQuery($constraints);
       return view('drugAdministration/givings/index', ['givings' => $givings, 'searchingVals' => $constraints]);
    }
    private function doSearchingQuery($constraints) {
        //$query = giving::query();
         $query = DB::table('givings')
        ->leftJoin('statuses', 'givings.status_id', '=', 'statuses.id')
        ->select('givings.id', 'givings.en_name','givings.ar_name', 'statuses.en_name as status_en_name');
        $fields = array_keys($constraints);
        $index = 0;

        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( 'givings.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
       
        return $query->paginate(5);
    }


    private function validateInput($request) {
        $this->validate($request, [
            'en_name' => 'required|unique:givings'
            ]);
    }
}