<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;
use App\DifferentialDiagnosis;


use Illuminate\Support\Facades\Input;
use App\Status;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\DifferentialDiagnosisImport;
use Log; 
use App\Http\Controllers\TagController;
use App\Http\Controllers\StyleController;
class DifferentialDiagnosisController extends Controller
{
    
    //
   public function __construct()
    {
        $this->middleware('auth');
        $this->stack = array();
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $count = DB::table('differential_diagnoses')->count();
        return view('drugAdministration/differentialDiagnosis/index', compact('count'));
    }

    /* 
    *
    *   Draw English Tree 
    *   Alaa Nasser Batha
    *   alaa.ba6ha@gmail.com
    *   +963991135289
    */
    public function draw_en_tree()
    {
         return view('/drugAdministration/differentialDiagnosis/draw_en_tree');
    }

    public function build_en_tree()
    {
        $dif_dias = DB::table('differential_diagnoses')->orderBy('code', 'asc')->get(); 
        
        $tree = [];
        foreach ($dif_dias as $dif_dia) {
            $code_width = 60;
            $ar_width = 475 - 12 * $dif_dia->level ;
            $en_width = 475 - 12 * $dif_dia->level ;
            $type = 'b';
            $tree[] = [
                "id" => (string)$dif_dia->id,
                "parent" => is_null($dif_dia->parent_id) ? "#" : (string)$dif_dia->parent_id,
                "text" => "
                    <div >
                        <label  style='font-weight: ".$dif_dia->bold.";font-style: ".$dif_dia->italic.";background-color:".$dif_dia->background_color.";background-color:".$dif_dia->background_color.";float:left;text-align: left; text-decoration:".$dif_dia->under_line.";color:".$dif_dia->text_color.";word-wrap: break-word;font-weight: ".$dif_dia->bold.";width:".$en_width."px;font-size:".$dif_dia->en_size."px;padding: 0.0ex ;margint-buttom:0.01ex;'>".$dif_dia->en_term."</label>
                        <label style='float:left; width:35px; '></label>
                        <label dir='rtl' style='font-weight: ".$dif_dia->bold.";font-style: ".$dif_dia->italic.";background-color:".$dif_dia->background_color.";background-color:".$dif_dia->background_color.";text-decoration:".$dif_dia->under_line.";color:".$dif_dia->text_color.";word-wrap: break-word;font-weight: ".$dif_dia->bold.";float:right; width:".$ar_width."px;text-align:right;font-size:".$dif_dia->ar_size."px;padding: 0.0ex ;margint-buttom:0.01ex;' >".$dif_dia->ar_term."</label>
                        
                    </div>"
            ];
        }
        return json_encode($tree);
        
    }
    

    /* export excel file*/
    public function differentialDiagnosisExport(){
     
        return Excel::download( new DiseasesExport , 'differential diagnosis.xls');

    }

     /* import excel file*/
    public function importInterface(){
        return view('/drugAdministration/differentialDiagnosis/importExcel');
    }

    public function dif_diasImport() 
    {
        Excel::import(new DifferentialDiagnosisImport, request()->file('file'));
        return view('/drugAdministration/differentialDiagnosis/importExcel');

        return redirect()->intended('/drugAdministration/differentialDiagnosis/importExcel')->with('success', 'All good!');;
    }
    /*
    *
    *   Function On The Tree
    *
    */
    public function delete_node(Request $request)
    {
        $parent = DB::table('differential_diagnoses')->where('parent_id',$request->id)->get();
        
        if(empty($parent[0]))
        {
            DifferentialDiagnosis::where('id', $request->id)->delete();
            return "yes";
        }
        else
        {
            return "no";
        }
    }


    public function view_node(Request $request)
    {       // Get Information My Disease 
            $dif_dia = DifferentialDiagnosis::find( $request->id);
            
            $code_width = 60;
            $ar_width = 475 - 12 * $dif_dia->level ;
            $en_width = 475 - 12 * $dif_dia->level ;
             
            $type = 'b';
            $result = [];
            $result=[
                "code_width" => $code_width,
                "en_width" => $en_width,
                "ar_width" => $ar_width,
                "type" => $type,
                "node" => $dif_dia,
            ];
            
            return json_encode($result);
    }

    public function search (Request $request)
    {
        $dif_dias = DB::table('differential_diagnoses')
                    ->where('en_term', 'like', "%".$request['condition']."%")
                    ->orWhere('ar_term', 'like', "%".$request['condition']."%")
                    ->orWhere('s_ar_term', 'like', "%".$request['condition']."%")
                    ->orwhere('code', 'like', "%".$request['condition']."%")
                    ->orwhere('parent_code', 'like', "%".$request['condition']."%")
                    ->get();
        $count = $dif_dias->count();
        


        $search_str = $request['condition'];
        $new_str = '<span style="color:#ff0000"><strong><span style="background-color:#000000">'.$search_str.'</span></strong></span>';
        $tree = [];
        foreach ($dif_dias as $dif_dia) {
            $code = strpos($dif_dia->code, $search_str) !== false ? str_replace($search_str , $new_str  , $dif_dia->code) : $dif_dia->code;
            $parent_code = strpos($dif_dia->parent_code, $search_str) !== false ? str_replace($search_str , $new_str  , $dif_dia->parent_code) : $dif_dia->parent_code;
            $en_term = strpos($dif_dia->en_term, $search_str) !== false ? str_replace($search_str , $new_str  , $dif_dia->en_term) : $dif_dia->en_term;
            

            if(strpos($dif_dia->ar_term, $search_str) !== false || strpos($dif_dia->s_ar_term, $search_str) !== false)
            {
                $re = '/\w|\s/um';
                $i=0;
                $cc ="xx : " ;
                
                while($i <= strlen($dif_dia->ar_term))
                {
                    
                    preg_match_all($re, substr($dif_dia->ar_term,$i,1) , $matches, PREG_SET_ORDER, 0);
                    
                    if (!empty($matches)) {
                        
                        $cc =$cc." (".$i.' , '.$matches[0].' ) ,';
                    }
                    $i++;
                }
                return $cc;
                  


                
                $start_pos = strpos($dif_dia->s_ar_term,$search_str);
                $len_search_str = strlen($search_str);
                $len_ar_term = strlen($dif_dia->ar_term);
                $ar_term = substr($dif_dia->ar_term,0,$start_pos).'<span style="color:#ff0000"><strong><span style="background-color:#000000">'.substr($dif_dia->ar_term,$start_pos,$len_search_str).'</span></strong></span>'.substr($dif_dia->ar_term,$start_pos+$len_search_str,$len_ar_term);
            }
            else{
                $ar_term = $dif_dia->ar_term;
            }
            $tree[] = [
                "id" => (string)$dif_dia->id,
                "code" => $code ,
                "parent_code" => $parent_code,
                "en_term" => $en_term,
                "ar_term" => $ar_term,
                "text_color" => (string)$dif_dia->text_color,
                "background_color" => (string)$dif_dia->background_color,
                "bold" =>  (string)$dif_dia->bold,
                "italic" =>  (string)$dif_dia->italic,
                "under_line" => (string)$dif_dia->under_line,
            ];
        }
        $result = [];
        $result[]=[
            "tree" => $tree,
            "count" => $count,
        ];
        return json_encode($result);
    }

    public function save_node(Request $request)
    {

        
        $tag_controller = new TagController();
        $style_controller = new StyleController();

        //note
        $en_note = $tag_controller->replace_code_with_tag($request->en_note);
        $ar_note=$tag_controller->replace_code_with_tag($request->ar_note);
        //term    
        $en_term = $tag_controller->replace_code_with_tag($request->en_term);
        $ar_term = $tag_controller->replace_code_with_tag($request->ar_term);

        /*$en_term = $style_controller->replace_to_style($request->en_term);
        $ar_term = $style_controller->replace_to_style($request->ar_term);*/
        //$en_term=  str_replace("two","#f0f3b8",$en_term);
        //$ar_term=  str_replace("two","#f0f3b8",$ar_term); 
      
        if(is_null($request->id))
        {

            $this->validate($request, [
                'code' => 'required|unique:differential_diagnoses',
                'en_term' => 'required'
                ]);
            
            //get parent code
            $level = 1;
            $parent_dif_dia = DifferentialDiagnosis::find($request->parent_id);

            if(is_null($parent_dif_dia))
            {
                $parent_code=null;   
            }
            else
            {
                $parent_code=$parent_dif_dia->code;
                $level =  $parent_dif_dia->level + 1 ;      
            }
            
            //simple arabic term
            $re = '/\w|\s/um';
            preg_match_all($re, $ar_term , $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }
            
            $dif_dia_id = DifferentialDiagnosis::create([
                'code' => $request->code,
                'parent_id' => $parent_dif_dia->id,
                'parent_code' => $parent_dif_dia->code,
                'en_term' => $en_term ,
                'ar_term' => $ar_term ,
                's_ar_term' =>$s_ar_term,
                'en_note' => $en_note,
                'ar_note' => $ar_note,
                'status_id' => 1,
                'level'=>$level,
                'bold' => $request->bold,
                'italic' => $request->italic,
                'text_color' =>$request->color_text,
                'background_color' => $request->color_background,
                'under_line' =>$request->under_line,
                'ar_size' => $request->ar_size,
                'en_size' => $request->en_size,
                'show_code' => "0",
            ])->id;

            $code_width = 60;
            $ar_width = 475 - 12 * $level ;
            $en_width = 475 - 12 * $level ;
            $type = 'b';

            $node[] = [
                "id"=>$dif_dia_id,
                "code_width" => $code_width,
                "ar_width"=>$ar_width,
                "en_width"=>$en_width ,
                "parent_id" =>$parent_dif_dia->id,
                "type"=>$type,
                "en_term" => $en_term,
                "ar_term" => $ar_term,
                "en_note" => $en_note ==""?" ":$en_note,
                "ar_note" => $ar_note==""?" ":$ar_note,
            ];
            return json_encode($node);
        }
        else{

            $my_dif_dia = DifferentialDiagnosis::find($request->id);
            

            //get simle arab term for this disease
            $re = '/\w|\s/um';
            preg_match_all($re, $ar_term , $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }

            $type='b';
            $show_code = 0;

            $new_parent = 0 ;
            $level = $my_dif_dia->level;
            
            $request->parent_code = ($request->parent_code=='null' ? '' : $request->parent_code);
            
            $input = [];
            $new_parent_id = NULL;
            if($request->parent_code != $my_dif_dia->parent_code)
            {
                
                if($request->parent_code != ''){
                    $parent = DB::table('differential_diagnoses')
                            ->where('code','=',$request->parent_code)
                            ->get();
                    $level = $parent[0]->level + 1;
                    $new_parent_id = $parent[0]->id;
                    $input = [
                    'code' => $request->code,  
                    'parent_id' => $new_parent_id,
                    'parent_code' => $parent[0]->code,        
                    'en_term' => $en_term ,
                    'ar_term' => $ar_term ,
                    's_ar_term' => $s_ar_term,
                    'en_note' => $en_note,
                    'ar_note' => $ar_note,
                    'bold' => $request->copy_style == "true" ? $request->bold : $my_dif_dia->bold,
                    'italic' =>$request->copy_style == "true" ? $request->italic : $my_dif_dia->italic,
                    'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_dif_dia->text_color,
                    'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_dif_dia->background_color,
                    'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_dif_dia->under_line,
                    'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_dif_dia->ar_size,
                    'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_dif_dia->en_size,

                    'show_code' => $show_code,
                    'level' => $level,
                ];
                }
                else
                {

                    $input = [
                    'code' => $request->code,  
                    'parent_id' => $new_parent_id,
                    'parent_code' => NULL,        
                    'en_term' => $en_term ,
                    'ar_term' => $ar_term ,
                    's_ar_term' => $s_ar_term,
                    'en_note' => $en_note,
                    'ar_note' => $ar_note,
                    
                    'bold' => $request->copy_style == "true" ? $request->bold : $my_dif_dia->bold,
                    'italic' =>$request->copy_style == "true" ? $request->italic : $my_dif_dia->italic,
                    'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_dif_dia->text_color,
                    'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_dif_dia->background_color,
                    'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_dif_dia->under_line,
                    'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_dif_dia->ar_size,
                    'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_dif_dia->en_size,
                    'show_code' => $show_code,
                    'level' => 1,
                ];
                }
            }
            else
            {

                $input = [
                    'code' => $request->code,          
                    'en_term' => $en_term ,
                    'ar_term' => $ar_term ,
                    's_ar_term' => $s_ar_term,
                    'en_note' => $en_note,
                    'ar_note' => $ar_note,

                    'bold' => $request->copy_style == "true" ? $request->bold : $my_dif_dia->bold,
                    'italic' =>$request->copy_style == "true" ? $request->italic : $my_dif_dia->italic,
                    'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_dif_dia->text_color,
                    'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_dif_dia->background_color,
                    'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_dif_dia->under_line,
                    'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_dif_dia->ar_size,
                    'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_dif_dia->en_size,
                    'show_code' => $show_code
                ];     

            }    
           // return $input;         
            DB::table('differential_diagnoses')->where('id',$request->id)->update($input);
            
            $code_width = 60;
            $ar_width = 475 - 12 * $level ;
            $en_width = 475 - 12 * $level ;
            $node = [];
            $node [] = [
                "code_width" =>$code_width,
                "ar_width"   =>$ar_width,
                "en_width"   =>$en_width,
                "type"       =>$type, 
                "parent_id"  => $new_parent_id == NULL? $request->parent_id : $new_parent_id,
                "id"         =>$my_dif_dia->id,
                    
                'bold' => $request->copy_style == "true" ? $request->bold : $my_dif_dia->bold,
                'italic' =>$request->copy_style == "true" ? $request->italic : $my_dif_dia->italic,
                'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_dif_dia->text_color,
                'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_dif_dia->background_color,
                'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_dif_dia->under_line,
                'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_dif_dia->ar_size,
                'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_dif_dia->en_size,

                "en_term" => $en_term,
                "ar_term" => $ar_term,
                "en_note" => $en_note,
                "ar_note" => $ar_note,
            ];

            return json_encode($node);
        }
    }


    public function term_replace(Request $request)
    {

        $en_dif_dias = DB::table('differential_diagnoses')
                    ->where('en_term', 'like', "%".$request->from."%")
                    ->get();

        foreach ($en_dif_dias as $en_dif_dia)
        {
            $en_term = str_replace($request->from, $request->to, $en_dif_dia->en_term);
            $input = [
                "en_term" => $en_term
            ];
            DB::table('differential_diagnoses')->where('id', $en_dif_dia->id)->update($input);
        }

        $ar_dif_dias = DB::table('differential_diagnoses')
                    ->Where('ar_term', 'like', "%".$request->from."%")
                    ->get();
        foreach ($ar_dif_dias as $ar_dif_dia)
        {
            $ar_term = str_replace($request->from, $request->to, $ar_dif_dia->ar_term);
            $re = '/\w|\s/um';
            preg_match_all($re, $ar_term, $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }
            $input = [
                "ar_term" => $ar_term,
                "s_ar_term" => $s_ar_term
            ];
            DB::table('differential_diagnoses')->where('id', $ar_dif_dia->id)->update($input);   
        }
    }

    public function get_parent_codes(){
        // Get All Diesease without My dif_dia to change parent
        $dif_dias = DB::table('differential_diagnoses')->orderBy('code')->pluck("code","code");
        return json_encode($dif_dias);
    }
    

}
