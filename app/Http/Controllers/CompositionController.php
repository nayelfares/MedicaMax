<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Composition;
use App\Status;
use App\CompositionQuantity;

use App\Exports\CompositionsExport;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\CompositionsImport;
use Illuminate\Support\Facades\Input;


class CompositionController extends Controller
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

       $compositions = DB::table('compositions')
        ->leftJoin('statuses', 'compositions.status_id', '=', 'statuses.id')
        ->select('compositions.*', 'statuses.en_name as status_en_name')
        ->orderBy('en_name', 'asc')
        ->get();

        $count = DB::table('compositions')->count();
   
        
        return view('drugAdministration/compositions/index', compact('compositions','count'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from statuses');
               return view('drugAdministration/compositions/create',compact('status'));
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

         $composition_id=Composition::create([
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'quantity' => $request['quantity'],
            'status_id' => $request['status_id']
        ])->id;
         foreach ($request->quantity as $quantity) {
            if(is_null($quantity)){
                break;
            }else{
                CompositionQuantity::create([
                    'composition_id' => $composition_id,
                    'quantity' => $quantity
                ]);
            }
         }

        return redirect()->intended('drug-administration/composition');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $composition = DB::table('compositions')
        ->leftJoin('statuses', 'compositions.status_id', '=', 'statuses.id')
        ->select('compositions.*', 'statuses.en_name as status_en_name')
        ->where('compositions.id','=',$id)
        ->first();
        
        $quantities = DB::table('composition_quantities')
        ->where('composition_quantities.composition_id','=',$id)
        ->get();
        return view("drugAdministration/compositions/show",compact('composition','quantities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $composition = Composition::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($composition == null ) {
            return redirect()->intended('drug-administration/composition');
        }
        $quantities = DB::table('composition_quantities')
        ->where('composition_quantities.composition_id','=',$id)
        ->get();
         
        $status = DB::select('select * from statuses');
        return view('drugAdministration/compositions/edit', ['composition' => $composition , 'status' =>$status,'quantities'=>$quantities]);
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
       
    
        $Composition = Composition::findOrFail($id);
        $input = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
        ];
        
        $this->validate($request, [
        'en_name' => 'required| unique:compositions,en_name,'.$id.''
        ]);

        $new_quantities =$request->new_quantities;
        $old_quantities =$request->old_quantities;
        
        if(!is_null($new_quantities) and !is_null($old_quantities)){
        $deletes = array_diff($old_quantities, $new_quantities);
        $creates = array_diff($new_quantities,$old_quantities);

        foreach($deletes as $del)
        {
            CompositionQuantity::where('composition_id', $id)->where('quantity',$del)->delete();
        }
        foreach($creates as $cre)
        {
            if(!is_null($cre))
            {
                CompositionQuantity::create([
                    'composition_id'=>$id,
                    'quantity'=>$cre,
                ]);
            }
        }
        }
        else{
            if(!is_null($request->new_quantities) and is_null($request->old_quantities))
                foreach($request->new_quantities as $cre)
                    {
                        if(!is_null($cre))
                            {
                                CompositionQuantity::create([
                                    'composition_id'=>$id,
                                    'quantity'=>$cre,
                                    ]);
                            }
                    }
        }


        Composition::where('id', $id)
            ->update($input);
        
        return redirect()->intended('drug-administration/composition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Composition::where('id', $id)->delete();
         return redirect()->intended('drug-administration/composition');
    }
//search
    public function search(Request $request) {
        
        $constraints = [           
            'en_name' => $request['english_name'],
            'ar_name' => $request['arabic_name'],
            'quantity' => $request['quantity'],
            ];
 
        $compositions = $this->doSearchingQuery($constraints);
       
       return view('drugAdministration/compositions/index', ['compositions' => $compositions, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
         $query = DB::table('compositions')
        ->leftJoin('statuses', 'compositions.status_id', '=', 'statuses.id')
        ->select('compositions.id','compositions.en_name','compositions.ar_name','compositions.quantity','statuses.en_name as status_en_name');
        $fields = array_keys($constraints);
        $index = 0;

        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( 'compositions.'.$fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }

        return $query->paginate(10);
    }

    private function validateInput($request) {
        $this->validate($request, [
        'en_name' => 'required | unique:compositions',
    ]);
    }

    /* export excel file*/
    public function compositionsExport(){
     
        return Excel::download( new CompositionsExport , 'compositions.xls');

    }

 /* import excel file*/
    public function importInterface(){
        return view('/drugAdministration/compositions/importExcel');
    }



    public function formsImport() 
    {
        //Excel::import(new ATC_ODDImport, request()->file('file'));
        Excel::import(new CompositionsImport, request()->file('file'));
        return redirect()->intended('drug-administration/composition')->with('success', 'All good!');;
    }

/*get quantities which belong to this composition*/
    public function getQuantities(Request $request)
    {
         $quantities = DB::table('composition_quantities')
         ->where('composition_quantities.composition_id','=',$request->id)
         ->pluck("quantity","id");
         return $quantities;
    }

}
