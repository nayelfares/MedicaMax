<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DailyDose;
use App\Status;
use App\Giving;
class DailyDoseController extends Controller
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
        $dailyDoses = DB::table('daily_dose')
        ->leftJoin('status', 'daily_dose.status_id', '=', 'status.id')
        ->leftJoin('giving','daily_dose.giving_id','=','giving.id')
        ->select('daily_dose.id','daily_dose.amount','giving.en_name as giving_en_name','daily_dose.note','status.en_name as status_en_name')
        ->get();
   
        return view('drugAdministration/dailyDoses/index', compact('dailyDoses'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from status');
        $giving = DB::table('giving')->where('status_id','=',1)->get();
        return view('/drugAdministration/dailyDoses/create',compact('status','giving'));
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
         DailyDose::create([
            'amount' => $request['amount'],
            'giving_id' => $request['giving_id'],
            'note' => $request['note'],
            'status_id' => $request['status_id']
        ]);

        return redirect()->intended('/drug-administration/dailyDose');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dailyDose = DailyDose::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($dailyDose == null ) {
            return redirect()->intended('drug-administration/dailyDose');
        }
         
        $status = DB::select('select * from status');
        $giving = DB::table('giving')->where('status_id','=',1)->get();
        //$giving = DB::select('select * from giving where giving.id == 2');
        return view('drugAdministration/dailyDoses/edit', ['dailyDose' => $dailyDose , 'status' =>$status , 'giving' =>$giving]);
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
        $dailyDose = DailyDose::findOrFail($id);
        $input = [
            'amount' => $request['amount'],
            'giving_id' => $request['giving_id'],
            'note' => $request['note'],
            'status_id' => $request['status_id']
        ];
        $this->validate($request, [
        'amount' => 'required',
        'giving_id' => 'required',
        'status_id' => 'required'
        ]);
        DailyDose::where('id', $id)
            ->update($input);
        
        return redirect()->intended('drug-administration/dailyDose');
    }  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    { 
       $dailyDoses = DB::table('daily_doses')
                    ->leftJoin('givings','daily_doses.giving_id','=','givings.id')
                    ->where('classification_id','=',$id)->get();
        return $dailyDoses;            
    }

    public function details($id)
    { 
       $dailyDoses = DB::table('daily_doses')
                    ->leftJoin('givings','daily_doses.giving_id','=','givings.id')
                    ->select('daily_doses.amount','givings.en_name as giving_en_name')
                    ->where('classification_id','=',$id)->get();
        return $dailyDoses;            
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DailyDose::where('id', $id)->delete();
    }

    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'amount' => $request['amount'],
            'note' => $request['note']
            ];

        $dailyDoses = $this->doSearchingQuery($constraints);
       return view('drugAdministration/dailyDoses/index', ['dailyDoses' => $dailyDoses, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DailyDose::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
            'amount' => 'required',
            'note' => 'required',
            'giving_id' => 'required',
            'status_id' => 'required'

            ]);
    }
}