<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

use DB;
use App\Status;
use App\Classification; 
use App\Drug;
use App\companies; 
use App\Form;
use App\Leaflet;
use App\ChemicalComposition;
use App\Picture;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ChemicalCompositionController;

use App\Exports\DrugsExport;
use App\Exports\ChemicalCompositionsExport;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\DrugsImport;
use App\Imports\ChemicalCompositionsImport;
use App\Imports\ATC_ODDImport;


class DrugController extends Controller
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
    $drugs = DB::table('drugs')
    ->leftJoin('statuses', 'drugs.status_id', '=', 'statuses.id')
    ->leftJoin('forms','drugs.form_id','=','forms.id')
    ->leftJoin('companies','drugs.company_id','=','companies.id')
    ->leftJoin('classifications','drugs.classification_id','=','classifications.id')
    ->select('drugs.id','drugs.en_name', 'drugs.ar_name' , 'companies.en_name as company_en_name',
      'classifications.en_term as classifications_en_term','forms.en_name as form_en_name','statuses.en_name as status_en_name')
    ->get();

    $count =  DB::table('drugs')->count();

    return view('drugAdministration/drugs/index', compact('drugs','count')); 
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
      
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
      
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $drug = Drug::find($id);
        // Redirect to country list if updating country wasn't existed
      if ($drug == null ) {
        return redirect()->intended('drug-administration/drug');
      }

      $status = DB::select('select * from statuses');
      $companies = DB::table('companies')->where('status_id','=','1')->orderBy('en_name', 'asc')->get();
      $forms = DB::table('forms')->where('status_id','=','1')->orderBy('en_name', 'asc')->get();
      $countries = DB::table('countries')->where('status_id','=','1')->orderBy('en_name', 'asc')->get();
      $images = DB::table('pictures')->where(([['object_id','=',$id],['class_name','=','drug']]))->get();
      $classifications = DB::table('classifications')->where('status_id','=','1')->where('classification_level','=','5')->orderBy('en_term', 'asc')->get();

      $compositions = DB::table('compositions')->where('status_id','=','1')->orderBy('en_name', 'asc')->get();
      $leaflets =DB::table('leaflets')->where('company_id','=',$drug->company_id)->get();

      $ch_co = new  ChemicalCompositionController();
      $ch_compositions = $ch_co->show($id);
      /*$temp = $ch_compositions->toArray();
      $first_composition = array_shift($temp);
      $composition_without_first = $temp ; */

      return view('drugAdministration/drugs/edit', compact('drug','status','companies', 'leaflets' ,'forms','countries','compositions' ,'classifications','ch_compositions','images'));

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
      
      $drug = Drug::findOrFail($id);
//delete image
      if(!is_null($request->pictures_deleted)){
        foreach($request->pictures_deleted as $img){
          Picture::where('title',$img)->delete();
        }
      }        
// Upload image
      if($request->hasfile('pictures'))
      {

        foreach($request->file('pictures') as $image)
        {
          $name=time() . '.' .$image->getClientOriginalName();
          $imageUrl = public_path().'/images/drug/'.$name;
               // $image->move(public_path().'/images/', $name); 
          Image::make($image)->resize(200, 200)->save($imageUrl); 
              //  $data[] = $name; 
          Picture::create([
            'title' =>  $name,
            'path' => public_path().'/images/drug/' ,
            'class_name' => 'drug',
            'object_id' => $id
          ]); 
        }
      }

        //inpute drug 

      $input = [
        'en_name' => $request['en_name'],
        'ar_name' => $request['ar_name'],
        'classification_id' => $request['classification_id'],
        'form_id' => $request['form_id'],
        'form_unit' => $request['form_unit'],
        'amount_of_form' => $request['amount_of_form'],
        'country_id' => $request['country_id'],
        'company_id' => $request['company_id'],
        'leaflet_id' => $request['leaflet_id'],
        'pharma_price' => $request['pharma_price'],
        'lay_price' => $request['lay_price'],
        'barcodes' => $request['barcodes'],
        'status_id' => $request['status_id']
      ];
        //validate impute drug
      $this->validate($request, [
        'en_name' => 'required | unique:drugs,en_name,'.$id.''
      ]);

      Drug::where('id', $id)->update($input);
//inpute chemical composition
        //delete old chemicalcomposiotion
      //ChemicalComposition::where('drug_id', $id)->delete();

        $new_ch_compositions =$request->new_ch_compositions;
        if($request->old_ch_compositions != null)
        {
          $deletes = array_diff($old_ch_compositions, $new_ch_compositions);
          foreach($deletes as $del)
          {
            ChemicalComposition::where('id', $del)->delete();
          }
        }
     
        $compositions = $request->compositions;
        foreach ($request->quantity_id as $quantity_id) {
          if(is_null($quantity_id)){
           break; 
         }
         else{
          $first_composition = array_shift($compositions);
          $ch_co = new  ChemicalComposition();
                  //$ch_co->classification_id = (int) array_shift($classifications);
          $ch_co->drug_id = $id; 
          $ch_co->composition_quantity_id = $quantity_id;
          $ch_co->composition_id = $first_composition;
          $ch_co->save();
        }
      }


      return redirect()->intended('drug-administration/drug');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
 
   }




//////////////////////////////////////////////////////////////


        private function validateInput($request) {
          $this->validate($request, [
            'en_name' => 'required | unique:drugs',
           // 'pictures.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);
        }
 
        public function getClassifications()
        {
          $classifications = DB::table('classifications')->where('status_id','=','1')->where('classification_level','=','5')->pluck("en_term","id");
          return $classifications;
        }

        public function getForms()
        {
          $forms = DB::table("forms")->where('status_id','=','1')->pluck("en_name","id");
          return $forms;
        }

        public function getCompanies()
        {
          $companies = DB::table("companies")->where('status_id','=','1')->pluck("en_name","id");
          return $companies;
        }

        public function getLeaflets(Request $request)
        {

          $leaflets = DB::table("leaflets")->where("company_id",'=',$request->company_id)->pluck("name","id");
          return $leaflets;
        }

        public function getLeafletsByDrug(Request $request)
        {
          $drug = Drug::find($request->drug_id);
          $leaflets = DB::table("leaflets")->where("company_id",'=',$drug->company_id)->pluck("name","id");
          return $leaflets;
        }

        public function getStatuses(Request $request)
        {

          $statuses = DB::table("statuses")->pluck("en_name","id");
          return $statuses;
        }

        public function getFormUnit(Request $request)
        {
          $form_unit = DB::table("forms")
          ->where("id",$request->id)->get();
          return $form_unit;
          return response()->json($form_unit);
        }

        public function getCompositions()
        {
          $compositions = DB::table("compositions")->where('status_id','=','1')->pluck("en_name","id");
          return $compositions;
        }

        

        public function getDetailsLeaflet(Request $request)
        {
         $leaflet = Leaflet::find($request->id);
         return $leaflet;
       }

       public function getImages(Request $request)
       {
          $images = DB::table("pictures ")->where('object_id','=',$request->drug_id)->where('class_name','=','drug');
          $photos = [];
          foreach ($image as $image) {
            $photos[] = [
              "id" => $image->id,
              "path" => \URL::to('images/drug/'.$image->title)
            ];
          }
          return json_encode($photos);
       }

       public function submit_drug(Request $request)
       {
         
        if($request->id == 0)
        { 
          $this->validateInput($request);
          $drug_id =  Drug::create([
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'classification_id' => $request['classification_id'],
            'form_id' => $request['form_id'],
            'form_unit' => $request['form_unit'],
            'amount_of_form' => $request['amount_of_form'],
            'country_id' => $request['country_id'],
            'company_id' => $request['company_id'],
            'leaflet_id' => $request['leaflet_id'],
            'pharma_price' => $request['pharma_price'],
            'lay_price' => $request['lay_price'],
            'barcodes' => $request['barcodes'],
            'status_id' => $request['status_id']
          ])->id;
          //create chemical composition
          $quantities = $request['quantities'];
          foreach ($request['compositions'] as $composition_id) {
              $quantity = array_shift($quantities);
              $ch_co_id = ChemicalComposition::create([
                 'drug_id' => $drug_id,
                 'composition_id' => $composition_id,
                 'composition_quantity_id' => $quantity
              ])->id;
          }
          //update imags
          $p = new PictureController();
          foreach ($request['upload_imags'] as $image_id) {
             $p->update_image($image_id , $drug_id, 'drug' ) ;
          }
         
        }
        else{
          //update($request, $request->id);
          $drug = Drug::findOrFail($request->id);
          
        //inpute drug 

          $input = [
            'en_name' => $request['en_name'],
            'ar_name' => $request['ar_name'],
            'classification_id' => $request['classification_id'],
            'form_id' => $request['form_id'],
            'form_unit' => $request['form_unit'],
            'amount_of_form' => $request['amount_of_form'],
            'country_id' => $request['country_id'],
            'company_id' => $request['company_id'],
            'leaflet_id' => $request['leaflet_id'],
            'pharma_price' => $request['pharma_price'],
            'lay_price' => $request['lay_price'],
            'barcodes' => $request['barcodes'],
            'status_id' => $request['status_id'],
          ]; 
          //validate impute drug
          /*$this->validate($request, [
            'en_name' => 'required | unique:drugs,en_name,'.$request->id.''
          ]);*/
         
          Drug::where('id', $request->id)->update($input);

         
        }
       }
/////////////////EDIT DRUG
        public function get_drug_detailes(Request $request)
        {
          $drug = Drug::find($request->id); 
          if ($drug == null ) {
            return "does not exist ,pleas reload this page";
          }
          $company = DB::table("companies")->where("id","=",$drug->company_id)->get();
          $classification = DB::table("classifications")->where("id","=",$drug->classification_id)->get(); 
          $form = DB::table("forms")->where("id","=",$drug->form_id)->get(); 
          $leaflet = DB::table("leaflets")->where("id","=",$drug->leaflet_id)->get(); 
          //$country = DB::table("countries")->where("id","=",$drug->country_id)->get(); 
          $status = DB::table("statuses")->where("id","=",$drug->status_id)->get();    
          
          $classification_en_term = "" ;
          $company_en_name = "";
          $form_en_name = "";
          $leaflet_name = "" ;
          //$country_en_name = null;
          $status_en_name = "" ;

          
          if(count($classification) > 0)
                $classification_en_term = $classification[0]->en_term;
          if(count($form)  > 0)
                  $form_en_name = $form[0]->en_name;
          if(count($company) > 0)
                  $company_en_name = $company[0]->en_name;
          if(count($leaflet)>0)
                  $leaflet_name = $leaflet[0]->name;
          /*if(count($country == null))
                  $country_en_name = $country[0]->en_name;*/ 
          if(count($status)>0)
                  $status_en_name = $status[0]->en_name;    
          
          return json_encode([
                'id' => $drug->id,
                'en_name'=>$drug->en_name,
                'ar_name'=>$drug->ar_name,
                'classification_id' => $drug->classification_id,
                'classification_en_term' =>$classification_en_term,
                'form_id' => $drug->form_id,
                'form_en_name' => $form_en_name,
                'form_unit' => $drug->form_unit,
                'amount_of_form' =>$drug->amount_of_form,
                'country_id' =>$drug->country_id ,
                'company_id'=>$drug->company_id,
                'company_en_name' => $company_en_name,
                'leaflet_id' => $drug->leaflet_id,
                'leaflet_name' => $leaflet_name,
                'barcodes' => $drug->barcodes,
                'pharma_price' => $drug->pharma_price,
                'lay_price' => $drug->lay_price,
                'status_id' => $drug->status_id,
                'status_en_name' => $status_en_name,
            ]);
        }       
/////////////////DELETE DRUG
       public function delete_drug(Request $request)
       {
            Drug::where('id', $request->id)->delete();
       }


       /* export excel file*/
       public function drugsExport(){

        return Excel::download( new DrugsExport , 'drugs.xls');

      }

      /* import excel file*/
      public function importInterface(){
        return view('/drugAdministration/drugs/importExcelDrugs');
      }



      public function drugsImport() 
      {
        //Excel::import(new ATC_ODDImport, request()->file('file'));
        Excel::import(new DrugsImport, request()->file('file'));
        return redirect()->intended('drug-administration/drug')->with('success', 'All good!');
      }

      /* export excel file*/
      public function chemical_compositionsExport(){

        return Excel::download( new ChemicalCompositionsExport , 'chemical_compositions.xls');

      }

      /* import excel file*/
      public function importInterface_ch_co(){
        return view('/drugAdministration/drugs/importExcel_co_ch');
      }



      public function chemical_compositionsImport() 
      {
        //Excel::import(new ATC_ODDImport, request()->file('file'));
        Excel::import(new ChemicalCompositionsImport, request()->file('file'));
        return redirect()->intended('drug-administration/drug')->with('success', 'All good!');
      }

    }
