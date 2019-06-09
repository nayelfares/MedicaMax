<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Status;
use App\Country;
class CountryController extends Controller
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

        $countries = DB::table('countries')
        ->leftjoin('statuses','countries.status_id','=','statuses.id')
        ->select('countries.*', 'statuses.en_name as status_en_name')
        ->get();

        $count = DB::table('countries')->count();
        return view('UserManagement/Countries/index',compact('countries','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from statuses');
        return view('UserManagement/Countries/create',compact('status'));
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
         Country::create([
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
        ]);

        return redirect()->intended('/user_management/country');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($country == null ) {
            return redirect()->intended('user_management/country');
        }
         
        $status = DB::select('select * from statuses');
        return view('UserManagement/Countries/edit', ['country' => $country , 'status' =>$status]);
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
        $country = Country::findOrFail($id);
        $input = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
        ];
        $this->validate($request, [
        'en_name' => 'required| unique:countries,en_name,'.$id.''
        ]);
        Country::where('id', $id)
            ->update($input);
        
        return redirect()->intended('user_management/country');
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
        Country::where('id', $id)->delete();
         return redirect()->intended('user_management/country');
    }

    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
            ];

        $countries = $this->doSearchingQuery($constraints);
       return view('UserManagement/Countries/index', ['countries' => $countries, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Country::query();
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
            'en_name' => 'required|unique:countries'
            ]);
    }
}
