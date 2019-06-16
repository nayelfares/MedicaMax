<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Status;
use App\Disease; 
use App\Exports\DiseasesExport;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\DiseasesImport;
use App\Imports\ATC_ODDImport;
use Log; 

class DiseaseController extends Controller
{
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
        $count = DB::table('diseases')->count();
        return view('drugAdministration/diseases/index', compact('count'));
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
         return view('/drugAdministration/diseases/draw_en_tree');
    }

    public function build_diseases_tree_en($id)
    {
        $parent_id = ( $id == 0 ? null : $id ); 
        $diseases = DB::table('diseases')->where('parent_id','=',$parent_id)->get(); 
        
        $tree = [];
        foreach ($diseases as $disease) {
            $disease->code = str_replace("!!","",$disease->code);
            $code_width = 175;
            $ar_width = 525 - 12 * $disease->diseases_level ;
            $en_width = 675 - 12 * $disease->diseases_level ;
            if(strpos($disease->code,'^')!== false)
            {
                if(substr($disease->code, -3, 1) == '^'){
                    $code_width = 150;
                    $en_width = 700 - 12 * $disease->diseases_level ;
                }
                if(substr($disease->code, -5, 1) == '^')
                {
                    $code_width = 125;
                    $en_width = 725 - 12 * $disease->diseases_level ;
                }else
                if(substr($disease->code, -7, 1) == '^')
                {
                    $code_width = 100;
                    $en_width = 750 - 12 * $disease->diseases_level ;
                }                
            }
            if($disease->show_code == 1)
                $type = 'a';
            else 
                $type = 'b';
            $tree[] = [
                "id" => (string)$disease->id,
                "children" => $disease->has_child == 1 ? true : false,
                "parent" => is_null($disease->parent_id) ? "#" : (string)$disease->parent_id,
                "text" => "
                    <div >
                        <label class=".$type." style='font-weight: ".$disease->bold.";font-style: ".$disease->italic.";background-color:".$disease->background_color.";background-color:".$disease->background_color.";text-decoration:".$disease->under_line.";color:".$disease->text_color.";word-wrap: break-word;font-weight: ".$disease->bold.";float:left; width:".$code_width."px;font-size:".$disease->en_size."px;padding: 0.0ex ;' >".$disease->code."</label>
                        <label  style='font-weight: ".$disease->bold.";font-style: ".$disease->italic.";background-color:".$disease->background_color.";background-color:".$disease->background_color.";text-align: left; text-decoration:".$disease->under_line.";color:".$disease->text_color.";word-wrap: break-word;font-weight: ".$disease->bold.";width:".$en_width."px;font-size:".$disease->en_size."px;padding: 0.0ex ;margint-buttom:0.01ex;'>".$disease->en_term."</label>
                        <label dir='rtl' style='font-weight: ".$disease->bold.";font-style: ".$disease->italic.";background-color:".$disease->background_color.";background-color:".$disease->background_color.";text-decoration:".$disease->under_line.";color:".$disease->text_color.";word-wrap: break-word;font-weight: ".$disease->bold.";float:right; width:".$ar_width."px;text-align:right;font-size:".$disease->ar_size."px;padding: 0.0ex ;margint-buttom:0.01ex;' >".$disease->ar_term."</label>
                    </div>"
            ];
        }
        return json_encode($tree);
    }
    /* export excel file*/
    public function diseasesExport(){     
        return Excel::download( new DiseasesExport , 'diseases.xls');
    }

     /* import excel file*/
    public function importInterface(){
        return view('/drugAdministration/diseases/importExcel');
    }

    public function diseasesImport() 
    {
        Excel::import(new DiseasesImport, request()->file('file'));
        return redirect()->intended('drug-administration/disease')->with('success', 'All good!');;
    }
    /*
    *   Delete Node
    */
    public function delete_disease_node(Request $request)
    {
        $parent = DB::table('diseases')->where('parent_id',$request->id)->get();
        
        if(empty($parent[0]))
        {
            Disease::where('id', $request->id)->delete();
            return "yes";
        }
        else
        {
            return "no";
        }
    }
    /*
    *   View Node
    */
    public function disease_view_node(Request $request)
    {       // Get Information My Disease 
            $dis = Disease::find( $request->id);
                      
            $code_width = 175;
            $ar_width = 525 - 12 * $dis->diseases_level ;
            $en_width = 675 - 12 * $dis->diseases_level ;
            if(strpos($dis->code,'^')!== false)
            {
                if(substr($dis->code, -3, 1) == '^'){
                    $code_width = 150;
                    $en_width = 700 - 12 * $dis->diseases_level ;
                }
                if(substr($dis->code, -5, 1) == '^')
                {
                    $code_width = 125;
                    $en_width = 725 - 12 * $dis->diseases_level ;
                }else
                if(substr($dis->code, -7, 1) == '^')
                {
                    $code_width = 100;
                    $en_width = 750 - 12 * $dis->diseases_level ;
                }                
            }
             
            if($dis->show_code == 1)
                $type = 'a';
            else
                $type = 'b';
            $result = [];
            if($request->parents_code == 1)
                $result=[
                    "code_width" => $code_width,
                    "en_width" => $en_width,
                    "ar_width" => $ar_width,
                    "type" => $type,
                    "node" => $dis
                ];
            else
                $result=[
                    "code_width" => $code_width,
                    "en_width" => $en_width,
                    "ar_width" => $ar_width,
                    "type" => $type,
                    "node" => $dis,
                ];
            
            return json_encode($result);
    }
    /*
    *   Search Node in code || parent code || ar term || en_term
    */

    public function disease_search (Request $request)
    {
        $diseases = DB::table('diseases')
                    ->where('en_term', 'like', "%".$request['condition']."%")
                    ->orWhere('s_ar_term', 'like', "%".$request['condition']."%")
                    ->orwhere('code', 'like', "%".$request['condition']."%")
                    ->orwhere('parent_code', 'like', "%".$request['condition']."%")
                    ->get();
        $count = $diseases->count();
        $tree = [];
        foreach ($diseases as $disease) {
            $disease->code = str_replace("!!","",$disease->code);
            $tree[] = [
                "id" => (string)$disease->id,
                "code" => (string)$disease->code ,
                "parent_code" => (string)$disease->parent_code,
                "en_term" => (string)$disease->en_term,
                "ar_term" => (string)$disease->ar_term,
                "text_color" => (string)$disease->text_color,
                "background_color" => (string)$disease->background_color,
                "bold" =>  (string)$disease->bold,
                "italic" =>  (string)$disease->italic,
                "under_line" => (string)$disease->under_line,
            ];
        }
        $result = [];
        $result[]=[
            "tree" => $tree,
            "count" => $count,
        ];
        return json_encode($result);
    }
    

    /*
    *   Save & Create Node
    */
    public function disease_node_save(Request $request)
    {

        //Create
        if(is_null($request->id))
        {
            $this->validate($request, [
                'code' => 'required|unique:diseases',
                'en_term' => 'required'
                ]);
            //get parent code
            $level = 1;
            $parent_disease = Disease::find($request->parent_id);
            if(is_null($parent_disease))
            {
                $parent_code=null;   
            }
            else
            {
                $parent_code=$parent_disease->code;
                $level =  $parent_disease->diseases_level + 1 ;      
            }
            //note
            $detail=$request->en_note;
            //ar_note
            $ar_detail=$request->ar_note;
            
            //simple arabic term
            $re = '/\w|\s/um';
            preg_match_all($re, $request->ar_term, $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }
            $code_contain_shapo =  strrpos($request->code,'^');    
            $show_code = ($code_contain_shapo == false ? 1 : 0);        
            $disease_id = Disease::create([
                'code' => $request->code,
                'parent_id' => $parent_disease->id,
                'parent_code' => $parent_disease->code,
                'en_term' => $request->en_term,
                'ar_term' => $request->ar_term,
                's_ar_term' =>$s_ar_term,
                'note' => $detail,
                'ar_note' => $ar_detail,
                'status_id' => 1,
                'diseases_level'=>$level,
                'bold' => $request->bold,
                'italic' => $request->italic,
                'text_color' =>$request->color_text,
                'background_color' => $request->color_background,
                'under_line' =>$request->under_line,
                'ar_size' => $request->ar_size,
                'en_size' => $request->en_size,
                'show_code' => $show_code,
                'has_child' => false,
            ])->id;
            if($parent_disease->has_child == false){
                $update_array = [];
                $update_array = [
                    'has_child' => true,
                ];
                DB::table('diseases')->where('id',$request->parent_id)->update($update_array);
            }
            $code_width = 175;
            $ar_width = 525 - 12 * $level ;
            $en_width = 675 - 12 * $level ;
            if(strpos($request->code,'^')!== false)
            {
                if(substr($request->code, -3, 1) == '^'){
                    $code_width = 150;
                    $en_width = 700 - 12 * $level ;
                }
                if(substr($request->code, -5, 1) == '^')
                {
                    $code_width = 125;
                    $en_width = 725 - 12 * $level ;
                }else
                if(substr($request->code, -7, 1) == '^')
                {
                    $code_width = 100;
                    $en_width = 750 - 12 * $level ;
                }                
            }
            if($show_code == 1)
                $type = 'a';
            else
                $type = 'b';

            $node[] = [
                "id"=>$disease_id,
                "code_width" => $code_width,
                "ar_width"=>$ar_width,
                "en_width"=>$en_width ,
                "parent_id" =>$parent_disease->id,
                "type"=>$type
            ];
            return json_encode($node);
        }
        else{
            $my_disease = Disease::find($request->id);
            
            //note
            $en_detail=$request->en_note;
            //ar_note
            $ar_detail=$request->ar_note;

            //get simle arab term for this disease
            $re = '/\w|\s/um';
            preg_match_all($re, $request->ar_term, $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }    
            
            $type='b';
            $show_code = "0";
            if(strpos($request->code, '^')  === false)
            {
                $type = 'a';
                $show_code = "1";
            }
            $new_parent = 0 ;
            $level = $my_disease->diseases_level;

            $request->parent_code = ($request->parent_code=='null' ? '' : $request->parent_code);
            
            $input = [];
            $new_parent_id = NULL;
            if($request->parent_code != $my_disease->parent_code)
            {
                
                if($request->parent_code != ''){
                    $parent = DB::table('diseases')
                            ->where('code','=',$request->parent_code)
                            ->get();
                    $level = $parent[0]->diseases_level + 1;
                    $new_parent_id = $parent[0]->id;
                    $input = [
                    'code' => $request->code,  
                    'parent_id' => $parent[0]->id,
                    'parent_code' => $parent[0]->code,        
                    'en_term' => $request->en_term,
                    'ar_term' => $request->ar_term,
                    's_ar_term' => $s_ar_term,
                    'note' => $en_detail,
                    'ar_note' => $ar_detail,
                    'bold' => $request->copy_style == "true" ? $request->bold : $my_disease->bold,
                    'italic' =>$request->copy_style == "true" ? $request->italic : $my_disease->italic,
                    'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_disease->text_color,
                    'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_disease->background_color,
                    'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_disease->under_line,
                    'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_disease->ar_size,
                    'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_disease->en_size,
                    'show_code' => $show_code,
                    'diseases_level' => $level,
                ];
                }
                else
                {
                    $input = [
                    'code' => $request->code,  
                    'parent_id' => $new_parent_id,
                    'parent_code' => NULL,        
                    'en_term' => $request->en_term,
                    'ar_term' => $request->ar_term,
                    's_ar_term' => $s_ar_term,
                    'note' => $en_detail,
                    'ar_note' => $ar_detail,
                    'bold' => $request->copy_style == "true" ? $request->bold : $my_disease->bold,
                    'italic' =>$request->copy_style == "true" ? $request->italic : $my_disease->italic,
                    'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_disease->text_color,
                    'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_disease->background_color,
                    'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_disease->under_line,
                    'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_disease->ar_size,
                    'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_disease->en_size,
                    'show_code' => $show_code,
                    'diseases_level' => 1,
                ];
                }
            }
            else
            {
                $input = [
                    'code' => $request->code,          
                    'en_term' => $request->en_term,
                    'ar_term' => $request->ar_term,
                    's_ar_term' => $s_ar_term,
                    'note' => $en_detail,
                    'ar_note' => $ar_detail,
                    'bold' => $request->copy_style == "true" ? $request->bold : $my_disease->bold,
                    'italic' =>$request->copy_style == "true" ? $request->italic : $my_disease->italic,
                    'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_disease->text_color,
                    'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_disease->background_color,
                    'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_disease->under_line,
                    'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_disease->ar_size,
                    'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_disease->en_size,
                    'show_code' => $show_code
                ];                
            } 
            
            /*$this->validate($request, [
                'code' => 'required | unique:diseases,code,'.$request->id.'',
                'en_term' => 'required'
            ]);*/
        

            DB::table('diseases')->where('id',$request->id)->update($input);
            $code_width = 175;
            $ar_width = 525 - 12 * $level ;
            $en_width = 675 - 12 * $level ;
            if(strpos($request->code,'^')!== false)
            {
                if(substr($request->code, -3, 1) == '^'){
                    $code_width = 150;
                    $en_width = 700 - 12 * $level ;
                }
                if(substr($request->code, -5, 1) == '^')
                {
                    $code_width = 125;
                    $en_width = 725 - 12 * $level ;
                }else
                if(substr($request->code, -7, 1) == '^')
                {
                    $code_width = 100;
                    $en_width = 750 - 12 * $level ;
                }                
            }
            
            $node = [];
            $node [] = [
                "code_width" =>$code_width,
                "ar_width"   =>$ar_width,
                "en_width"   =>$en_width,
                "type"       =>$type, 
                "parent_id"  => $new_parent_id == NULL? $request->parent_id : $new_parent_id,
                "id"         =>$my_disease->id,
                'bold' => $request->copy_style == "true" ? $request->bold : $my_disease->bold,
                'italic' =>$request->copy_style == "true" ? $request->italic : $my_disease->italic,
                'text_color' =>$request->copy_style == "true" ? $request->color_text : $my_disease->text_color,
                'background_color' =>$request->copy_style == "true" ? $request->color_background : $my_disease->background_color,
                'under_line' =>$request->copy_style == "true" ? $request->under_line : $my_disease->under_line,
                'ar_size' =>$request->copy_style == "true" ? $request->ar_size : $my_disease->ar_size,
                'en_size' =>$request->copy_style == "true" ? $request->en_size : $my_disease->en_size,
            ];
            return json_encode($node);
        }
    }

    public function disease_term_replace(Request $request)
    {

        $en_diseases = DB::table('diseases')
                    ->where('en_term', 'like', "%".$request->from."%")
                    ->get();

        foreach ($en_diseases as $en_disease)
        {

            $en_term = str_replace($request->from, $request->to, $en_disease->en_term);
            $input = ["en_term" => $en_term];
            DB::table('diseases')->where('id', $en_disease->id)->update($input);
        }

        $ar_diseases = DB::table('diseases')
                    ->Where('ar_term', 'like', "%".$request->from."%")
                    ->get();
        foreach ($ar_diseases as $ar_disease)
        {
            $ar_term = str_replace($request->from, $request->to, $ar_disease->ar_term);
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
            DB::table('diseases')->where('id', $ar_disease->id)->update($input);   
        }
    }

    public function get_parent_codes(){
        // Get All Diesease without My Disease to change parent
        $diseases = DB::table('diseases')->orderBy('code')->pluck("code","code");
        return json_encode($diseases);
    }

    
    public function get_parents_id($id){
         $node = DB::table('diseases')->where('id','=',$id)->select("id","parent_id")->first();
        if(is_null($node)){
            return null;
        }
        else{
            array_unshift($this->stack, $node);
            if(!is_null($node->parent_id))
            {
                $this->get_parents_id($node->parent_id);
            }
        }       
        return $this->stack;
    }

    public function get_all_parents_for_node(Request $request){
        $nodes = $this->get_parents_id($request->id);
        $result = [];
        foreach ($nodes as $node) {
           $result[] = [$node->id]; 
        }
        return $result;
    }
//create s_ar_term
    public function create_simple_ar_term_to_nodes(){
        $diseases = DB::table('diseases')->select("ar_term","s_ar_term","id")->get();
        $re = '/\w|\s/um';
        foreach ($diseases as $my_disease) {
            if(is_null($my_disease->s_ar_term) || empty($my_disease->s_ar_term) || $my_disease->s_ar_term == "")
            {
                //$this->simple_arabic_term_for_all($request->id);
                
                    preg_match_all($re, $my_disease->ar_term, $matches, PREG_SET_ORDER, 0);
                    $s_ar_term ='';
                    foreach ($matches as $matche) 
                    {
                        $s_ar_term=$s_ar_term.$matche[0];
                    }
                    $input=[
                        's_ar_term' => $s_ar_term,
                    ]; 
                    Disease::where('id', $my_disease->id)->update($input);              
            }
        }
        return "ok";
    }

}
