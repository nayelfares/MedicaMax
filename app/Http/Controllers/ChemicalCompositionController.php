<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChemicalComposition; 
use DB;
use App\Drug;

class ChemicalCompositionController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        
    }


 /*   public function save_chemicanlComposition($drug_id , $form_unit ,$classification_id,$amount){
        
        ChemicalComposition::create([
            'classification_id' => $classification_id,
            'form_unit' => $form_unit,
            'amount_in_unit' => $amount,
            'drug_id' => $drug_id
        ]);

    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $chemical_composition = DB::table('chemical_compositions')
        ->leftJoin('composition_quantities','chemical_compositions.composition_quantity_id','=','composition_quantities.id')
        ->leftJoin('compositions','composition_quantities.composition_id' ,'=' ,'compositions.id')
        ->select('chemical_compositions.id', 'compositions.id as composition_id', 'compositions.en_name as composition_en_name',
            'composition_quantities.id as composition_quantity_id', 'composition_quantities.quantity as composition_quantity')
        ->where('chemical_compositions.drug_id','=',$id)->get(); 
        return ($chemical_composition);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ChemicalComposition::where('id', $id)->delete();
    }
    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
   /* public function search(Request $request) {
        $constraints = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'status_id' => $request['status_id']
            ];

        $companies = $this->doSearchingQuery($constraints);
       return view('drugAdministration/companies/index', ['companies' => $companies, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = company::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }*/
    private function validateInput($request) {
     /*   $this->validate($request, [
            '' => 'required|unique:'
            ]);*/
    }
   
}

