<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use DB; 
use App\Dictionary;
use View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DictionayImport;
use App\Exports\DictionayExport;
class DictionaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $dictionaries = DB::table('dictionaries')->get();

        $count = $dictionaries->count();
   
        
        return view('drugAdministration/dictionaries/index', compact('dictionaries','count'));
    } 

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validateInput($request);
        
        //simple arabic term
        $re = '/\w|\s/um';
        $ar_row = $request['arabicTextRaw'];
        preg_match_all($re, $ar_row , $matches, PREG_SET_ORDER, 0);
        $ar__text_row ='';
        foreach ($matches as $matche) 
        {
            $ar__text_row=$ar__text_row.$matche[0];
        }

        $input = [
            'arabicText' => $request['arabicText'],
            'englishText' => $request['englishText'],
            'arabicTextRaw' => $ar__text_row,
            'englishTextRaw' => $request['englishTextRaw'],
            'status' => $request['status'],
			'dictionary_id' => $request['dictionary_id'],
        ]; 
             	//dd($input);
		Dictionary::create($input);
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
      
        $dic = Dictionary::findOrFail($id);
        //simple arabic term
        $re = '/\w|\s/um';
        $ar_row = $request['arabicTextRaw'];
        preg_match_all($re, $ar_row , $matches, PREG_SET_ORDER, 0);
        $ar__text_row ='';
        foreach ($matches as $matche) 
        {
            $ar__text_row=$ar__text_row.$matche[0];
        }

        $input = [
            'arabicText' => $request['arabicText'],
            'englishText' => $request['englishText'],
            'arabicTextRaw' => $ar__text_row,
            'englishTextRaw' => $request['englishTextRaw'],
            'status' => $request['status'],
            'dictionary_id' => $request['dictionary_id'],
        ]; 

        /*$this->validate($request, [
        'tag_code' => 'required | unique:tags,tag_code,'.$id.''
        ]);
		*/
        Dictionary::where('id', $id)
            ->update($input);  
    
    } 
    /**
    SAVE Dictionary
    */
    public function save_dictionary(Request $request)
    {
       

        if($request->id == null)
        {
            $this->store($request);
        }
        else
        {
            $this->update($request,$request->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dictionary::where('id', $id)->delete();
         return redirect()->intended('drug-administration/dictionary');
    }
    /**
    Details Of Dictionary
    */
    public function get_details(Request $request)
    {
        $dic = Dictionary::find($request->id);
        
        $data = [
            "id" => $dic->id,
            'arabicText' => $dic->arabicText,
            'englishText' => $dic->englishText,
            'arabicTextRaw' => $dic->arabicTextRaw,
            'englishTextRaw' => $dic->englishTextRaw,
            'status' => $dic->status,
			'dictionary_id' => $dic->dictionary_id,
        ];
        return json_encode($data);
    }


    public function search(Request $request)
    {
        $words = "";
        if($request->search_type == "All")
            $words = DB::table('dictionaries')
                            ->where('arabicTextRaw','like','%'.$request->search_word.'%')
                            ->orwhere('englishTextRaw','like','%'.$request->search_word.'%')
                            ->get();
        else 
            if($request->search_type == "Beginning")
                $words = DB::table('dictionaries')
                            ->where('arabicTextRaw','like',$request->search_word.'%')
                            ->orwhere('englishTextRaw','like',$request->search_word.'%')
                            ->get();
            else
                $words = DB::table('dictionaries')
                            ->where('arabicTextRaw','like','%'.$request->search_word)
                            ->orwhere('englishTextRaw','like','%'.$request->search_word)
                            ->get();
        return $word;
    }


    /*
    	Export
    */
    public function export_dictionary() 
    {
        return Excel::download(new DictionayExport, 'dictionary.xlsx');
    }
    /*
    Importer
    */
    /* import excel file*/
    public function importInterface(){
        return view('/drugAdministration/dictionaries/importExcel');
    }



    public function import_dictionary() 
    {
        
        Excel::import(new DictionayImport, request()->file('file'));
        return redirect()->intended('drug-administration/dictionaries')->with('success', 'All good!');;
    }
}
