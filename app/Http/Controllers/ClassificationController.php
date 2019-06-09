<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Status;
use App\Classification; 
use App\Exports\ClassificationsExport;
use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\ClassificationsImport;
use App\Imports\ATC_ODDImport;
use Log;

class ClassificationController extends Controller
{
protected static $stack_tree= array();
public static  $index = 0;
public static  $parent_index = 0;
public static  $level_cls = 0;

//stack
  public function push($item) {
        // prepend item to the start of the array
        array_unshift(self::$stack_tree, $item);
        
    }

    public function pop() {
        return array_shift(self::$stack_tree);    
    }
    public function top() {
        return current(self::$stack_tree);
    }
    //end stack




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
        
        $count = DB::table('classifications')->count();
        return view('drugAdministration/classifications/index', compact('count'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = DB::select('select * from statuses');
        $classifications = DB::table('classifications')->where('status_id','<>',2)->orderBy('en_term')->get();
        return view('/drugAdministration/classifications/create',compact('status','classifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        //validation
         $this->validateInput($request);
        //get parent code
        $parent_classification = Classification::find($request['parent_id']);
        if(is_null($parent_classification))
            $parent_code=null;
        else
            $parent_code=$parent_classification->code;       
     //   try {
       // dd($request['parent_id']);
            $classification_id = Classification::create([
            'code' => $request['code'],
            'parent_id' => $request['parent_id'],
            'parent_code' => $parent_code,
            'en_term' => $request['en_term'],
            'ar_term' => $request['ar_term'],
            'note' => $request['note'],
            'status_id' => $request['status_id'],
            'classification_level'=>$request['classification_level']
            ])->id;
        return redirect()->intended('/drug-administration/classification');
    //     }
 /*   } catch (Exception $e) {
        report($e);

        return false;
    }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classification = DB::table('classifications')
        ->leftjoin('classifications as parent','classifications.parent_id','=','parent.id')
        ->leftjoin('statuses', 'classifications.status_id', '=', 'statuses.id')
        ->select('classifications.*','parent.en_term as parent_en_term','statuses.en_name as status_en_name')
        ->where('classifications.id','=',$id)->first();


        
     

        return view('/drugAdministration/classifications/show',compact('classification'));
    }
 
    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classification = Classification::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($classification == null ) {
            return redirect()->intended('drug-administration/classifications');
        }
        $status = DB::select('select * from statuses');
        $classifications = DB::table('classifications')->where('status_id','<>',2)->where('id','<>',$id)->get();
        

     

        return view('/drugAdministration/classifications/edit',compact('status','classifications','classification'));
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
        
        $classification = Classification::findOrFail($id);
        //Geo_Postal_us::where('postal', $postal)->firstOrFail();
        //get parent code
        $parent_classification = Classification::find($request['parent_id']);
        if(is_null($parent_classification))
            $parent_code=null;
        else
            $parent_code=$parent_classification->code;
        //set inpute
        $input = [
            'code' => $request['code'],
            'parent_code' => $parent_code,
            'parent_id' => $request['parent_id'],
            'en_term' => $request['en_term'],
            'ar_term' => $request['ar_term'],
            'note' => $request['note'],
            'status_id' => $request['status_id'],
            'classification_level'=>$request['classification_level']
        ];
        $this->validate($request, [
        'code' => 'required | unique:drugs,en_name,'.$id.'',
        'en_term' => 'required | unique:drugs,en_name,'.$id.''
        ]);
        Classification::where('id', $id)
            ->update($input);



        
        return redirect()->intended('drug-administration/classification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classification::where('id', $id)->delete();
         return redirect()->intended('drug-administration/classification');
    }
    

    private function validateInput($request) {
        $this->validate($request, [
            'code' => 'required|unique:classifications',
            'en_term' => 'required|unique:classifications'
            ]);
    }



    /* export excel file*/
    public function classificationsExport(){
     
        return Excel::download( new ClassificationsExport , 'classifications.xls');

    }

    /* import excel file*/
    public function importInterface(){
        return view('/drugAdministration/classifications/importExcel');
    }



    public function classificationsImport() 
    {
        //Excel::import(new ATC_ODDImport, request()->file('file'));
        Excel::import(new ClassificationsImport, request()->file('file'));
        return redirect()->intended('drug-administration/classification')->with('success', 'All good!');;
    }





//////////////////////////////////////DRAW TREE////////////////////////////////////////////////////////    
///////////////////draw 3
    public function draw_tree3()
    {

      //  return view('/drugAdministration/classifications/draw_tree3_ex');
         return view('/drugAdministration/classifications/draw_tree3');
    }
    /**
     * get classifications as tree
     */
        public function build_tree()
    {
        $classifications = DB::table('classifications')->get();
        $tree = [];
        foreach ($classifications as $classification) {
            $code_wdith_ = 40 + 10 * $classification->classification_level;
            //$ar_wdith_ = 450 - 22 * $classification->classification_level - $code_wdith_;
            $ar_wdith_ = 500 - 22 * $classification->classification_level - 1.15 * $code_wdith_;
            $tree[] = [
                "id" => (string)$classification->id,
                "parent" =>is_null($classification->parent_id)? "#" : (string)$classification->parent_id,
                "text" => "<label style=' float:left;width:".$code_wdith_."px;font-size:16px;padding: 0.0ex ;color:Tomato;'>".$classification->code."</label>
                <label  style='width:500px;font-size:16px;padding: 0.0ex ;margint-buttom:0.01ex;color:DodgerBlue;'>".$classification->en_term."</label> 
                <label style='float:right;width:".$ar_wdith_."px;direction:rtl;text-align:right;font-size:18px;padding: 0.0ex ;margint-buttom:0.01ex;color:MediumSeaGreen;'>".$classification->ar_term."</label>"
            ];
        }//position: absolute;
        //padding-left:20ex;
        return json_encode($tree);
    }

///////////////////draw 3 Arabic
public function draw_tree3_ar()
{
     return view('/drugAdministration/classifications/draw_tree3_ar');
}
/**
 * get classifications as tree
 */
public function build_tree_ar()
{
    $classifications = DB::table('classifications')->get();
    $tree = [];
    foreach ($classifications as $classification) {
        $code_wdith_ = 40 + 10 * $classification->classification_level;
        if($classification->classification_level == 1){
            $width_ = 460.25; 
        }
        elseif($classification->classification_level==2)
        {
            $width_ = 443.5;

        }
        elseif($classification->classification_level==3)
        {
            $width_ = 426.75;
        }
        elseif($classification->classification_level==4)
        {
            $width_ = 410;
        }
        elseif($classification->classification_level==5)
        {
            $width_ = 393.25;
        }
        //$en_wdith_ = 500 - 22 * $classification->classification_level - 1.15 * $code_wdith_;
        $tree[] = [
            "id" => (string)$classification->id,
            "parent" => is_null($classification->parent_id) ? "#" : (string)$classification->parent_id,
            "text" => "<div  style='font-weight: ".$classification->bold.";font-style: ".$classification->italic."; color:".$classification->text_color.";background-color:".$classification->background_color.";'><label  style='word-wrap: break-word;text-decoration:".$classification->under_line.";font-weight: ".$classification->bold.";float:right; width:".$code_wdith_."px;font-size:".$classification->en_size."px;padding: 0.0ex ;' >".$classification->code."</label>
            <label style='word-wrap: break-word;text-decoration:".$classification->under_line.";font-weight: ".$classification->bold.";float:right; width:".$width_."px; direction:rtl;text-align:right;font-size:".$classification->ar_size."px;padding: 0.0ex ;margint-buttom:0.01ex;' >".$classification->ar_term."</label>
            <label dir='ltr'  style='text-align: left; word-wrap: break-word;text-decoration:".$classification->under_line.";font-weight: ".$classification->bold.";width:".$width_."px;font-size:".$classification->en_size."px;padding: 0.0ex ;margint-buttom:0.01ex;'>".$classification->en_term."</label></div>"
        ];
    }
    return json_encode($tree);
}
//////////////////////// CRUD CLASSIFICATION AJAX  |||||||||||||||||||||||||||||||||||||||||||||||||||
    public function search_(Request $request)
    {
        $classifications = DB::table('classifications')
                    ->where('en_term', 'like', "%".$request['condition']."%")
                    ->orWhere('ar_term', 'like', "%".$request['condition']."%")
                    ->orWhere('s_ar_term', 'like', "%".$request['condition']."%")
                    ->orwhere('code', 'like', "%".$request['condition']."%")
                    ->get();

        $tree = [];
        foreach ($classifications as $classification) {
            $tree[] = [
                "id" => (string)$classification->id,
                "code" => (string)$classification->code,
                "en_term" => (string)$classification->en_term,
                "ar_term" => (string)$classification->ar_term,
            ];
        }
        return json_encode($tree);
    }

  
    public function delete_node(Request $request)
    {
        $parent = DB::table('classifications')->where('parent_id',$request->id)->get();
        
        if(empty($parent[0]))
        {
            Classification::where('id', $request->id)->delete();
            return "yes";
        }
        else
        {
            return "no";
        }

    }

    public function view_node(Request $request)
    {

            $cla = Classification::find($request->id);
            $cla->en_term = str_replace("</sup>", "**", $cla->en_term);
            $cla->en_term = str_replace("<sup>", "**", $cla->en_term);
            $cla->ar_term = str_replace("</sup>", "**", $cla->ar_term);
            $cla->ar_term = str_replace("<sup>", "**", $cla->ar_term);
            return $cla;
    }

    public function save_node(Request $request)
    {
        //return $request;
          /*  $request->id == null ? store($request) : update($request,$request->id);*/
        if(is_null($request->id))
        {
            $this->validate($request, [
                'code' => 'required|unique:classifications',
                'en_term' => 'required'
                ]);
            //get parent code
            $level = 1;
            $parent_classification = Classification::find($request->parent_id);
            
            if(is_null($parent_classification))
                $parent_code=null;
                
            else
            {
                $parent_code=$parent_classification->code;
                $level =  $parent_classification->classification_level + 1 ;      
            }

                //note
                $detail=$request->note;
 
                $dom = new \domdocument();
                $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
 
                $images = $dom->getelementsbytagname('img');
 
                foreach($images as $k => $img){
                    $data = $img->getattribute('src');

                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
 
                    $data = base64_decode($data);
                    $image_name= time().$k.'.png';
                    $path = public_path() .'/'. $image_name;
 
                    file_put_contents($path, $data);
 
                    $img->removeattribute('src');
                    $img->setattribute('src', $image_name);
                }
                $detail = $dom->savehtml();
                //ar_note
                $ar_detail=$request->ar_note;
 
                $ar_dom = new \domdocument();
                $ar_dom->loadHtml($ar_detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
 
                $ar_images = $ar_dom->getelementsbytagname('img');
 
                foreach($ar_images as $ar_k => $ar_img){
                    $ar_data = $ar_img->getattribute('src');

                    list($ar_type, $ar_data) = explode(';', $ar_data);
                    list(, $ar_data)      = explode(',', $ar_data);
 
                    $ar_data = base64_decode($ar_data);
                    $ar_image_name= time().$ar_k.'.png';
                    $ar_path = public_path() .'/'. $ar_image_name;
 
                    file_put_contents($ar_path, $ar_data);
 
                    $ar_img->removeattribute('src');
                    $ar_img->setattribute('src', $ar_image_name);
                }
                $ar_detail = $ar_dom->savehtml();
                //simple arabic term
                $re = '/\w|\s/um';
                preg_match_all($re, $request->ar_term, $matches, PREG_SET_ORDER, 0);
                $s_ar_term ='';
                foreach ($matches as $matche) 
                {
                    $s_ar_term=$s_ar_term.$matche[0];
                }           
                
                $classification_id = Classification::create([
                    'code' => $request->code,
                    'parent_id' => $parent_classification->id,
                    'parent_code' => $parent_classification->code,
                    'en_term' => $request->en_term,
                    'ar_term' => $request->ar_term,
                    's_ar_term' =>$s_ar_term,
                    'note' => $detail,
                    'ar_note' => $ar_detail,
                    'status_id' => 1,
                    'classification_level'=>$level,
                    'bold' => $request->bold,
                    'italic' => $request->italic,
                    'text_color' =>$request->color_text,
                    'background_color' => $request->color_background,
                    'under_line' =>$request->under_line,
                    'ar_size' => $request->ar_size,
                    'en_size' => $request->en_size,
                ])->id;
                $code_wdith_ = 40 + 10 * $level;
                if($level == 1){
                    $width_ = 460.25; 
                }
                elseif($level==2)
                {
                    $width_ = 443.5;
                }
                elseif($level==3)
                {
                    $width_ = 426.75;
                }
                elseif($level==4)
                {
                    $width_ = 410;
                }
                elseif($level==5)
                {
                    $width_ = 393.25;
                }
                $node[] = [
                    "id"=>$classification_id,"code_width" => $code_wdith_,"width"=>$width_ ,"parent_id" =>$parent_classification->id
                ];
                return json_encode($node);
        }
        else{  
            $classification = Classification::find($request->id);
            //simple arabic term for all

            if(is_null($classification->s_ar_term) || empty($classification->s_ar_term))
            {
                
                //$this->simple_arabic_term_for_all($request->id);
                $re = '/\w|\s/um';
                $classifications = DB::table("classifications")->get();
                foreach ($classifications as $classification) 
                {
                    preg_match_all($re, $classification->ar_term, $matches, PREG_SET_ORDER, 0);
                    $s_ar_term ='';
                    foreach ($matches as $matche) 
                    {
                        $s_ar_term=$s_ar_term.$matche[0];
                    }
                    $input=[
                        's_ar_term' => $s_ar_term,
                    ]; 
                   
                    Classification::where('id', $classification->id)->update($input);  
                }         
            }
            //get simle arab term for this classification
            $re = '/\w|\s/um';
            preg_match_all($re, $request->ar_term, $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }
            $input = [
                'code' => $request->code,          
                'en_term' => $request->en_term,
                'ar_term' => $request->ar_term,
                's_ar_term' => $s_ar_term,
                'note' => $request->note,
                'ar_note' => $request->ar_note,
                'bold' => $request->bold,
                'italic' => $request->italic,
                'text_color' =>$request->color_text,
                'background_color' => $request->color_background,
                'under_line' =>$request->under_line,
                'ar_size' => $request->ar_size,
                'en_size' => $request->en_size,
            ];
            $this->validate($request, [
                'code' => 'required | unique:drugs,en_name,'.$request->id.'',
                'en_term' => 'required'
            //    'en_term' => 'required | unique:drugs,en_name,'.$request->id.''
            ]);
            Classification::where('id', $request->id)->update($input);
            $code_wdith_ = 40 + 10 * $classification->classification_level;
            if($classification->classification_level == 1){
                    $wdith_ = 460.25; 
                }
                elseif($classification->classification_level==2)
                {
                    $wdith_ = 443.5;
                }
                elseif($classification->classification_level==3)
                {
                    $wdith_ = 426.75;
                }
                elseif($classification->classification_level==4)
                {
                    $wdith_ = 410;
                }
                elseif($classification->classification_level==5)
                {
                    $wdith_ = 393.25;
                }
            $node_dimension[] = ["code_width" => $code_wdith_,"width"=>$wdith_ ];
            return json_encode($node_dimension);
        }
    }


    public function update_parent(Request $request){
        $parent_classification = Classification::find($request->parent_id);;
        $input = [
            'parent_code' =>  $parent_classification->code,
            'parent_id' => $parent_classification->id,
            ];
        Classification::where('id', $request->id)->update($input);
    }


    public function term_replace(Request $request)
    {

        $en_classifications = DB::table('classifications')
                    ->where('en_term', 'like', "%".$request->from."%")
                    ->get();
        foreach ($en_classifications as $en_classification)
        {
            $en_term = str_replace($request->from, $request->to, $en_classification->en_term);
            $inpute = ["en_term" => $en_term];
            Classification::where('id', $en_classification->id)->update($inpute);
        }

        $ar_classifications = DB::table('classifications')
                    ->orWhere('ar_term', 'like', "%".$request->from."%")
                    ->get();
        foreach ($ar_classifications as $ar_classification)
        {
            $ar_term = str_replace($request->from, $request->to, $ar_classification->ar_term);
            $re = '/\w|\s/um';
            preg_match_all($re, $ar_term, $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }
            $inpute = [
                "ar_term" => $ar_term,
                "s_ar_term" => $s_ar_term
            ];
            Classification::where('id', $ar_classification->id)->update($inpute);   
        }
    }

//the end
    
    public function indexing_dfs($cla,$index)
    {
        
        if((self::$level_cls < (Integer)$cla->classification_level) && (self::$level_cls < 5) )
        {
            self::$level_cls = (Integer)$cla->classification_level;
            self::$parent_index = self::$index ;
            $this->push(self::$parent_index);
            
        }
        else
        {
            if( self::$level_cls > (Integer)$cla->classification_level )
            {
                //dd((Integer)$cla->classification_level);
                for ($i = 0;$i < self::$level_cls - (Integer)$cla->classification_level ; $i++) {
                    $a = $this->pop();
                }
                self::$level_cls = (Integer)$cla->classification_level;
                   
            }
        }
        self::$index = self::$index + 1 ;
        $input = [
            //    'visited' => 1,
                'index' => self::$index ,
                'parent_index' => $this->top()
            ];  

        Classification::where('id', $cla->id)->update($input);
        
        $classifications = DB::table('classifications')->where('parent_id','=',$cla->id)->orderBy('code', 'ASC')->get();
        foreach ($classifications as $classification) { 
           //if($classification->visited ==0 )
            //    {
                    $this->indexing_dfs($classification,self::$index);
            //    }
            }  
    }


    public function re_indexing()
    {
        $classifications = DB::table('classifications')->where('parent_id','=',null)->orderBy('code', 'ASC')->get();
        //dd( $classifications);
        $root = 0 ;
        foreach ($classifications as $classification) {
            //$this->push($root);
            $this->indexing_dfs($classification,self::$index);
        }
        
    } 














/*
///////////////////draw1
 public function treeView(){       
        $classifications = Classification::where('parent_code', '=', null)->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($classifications as $classification) {
             $tree .='<li class="tree-view closed"<a class="tree-name">[ '.$classification->code.' ] '.$classification->en_term.'  '.$classification->ar_term.'</a>';
             if(count($classification->childs)) {
                $tree .=$this->childView($classification);
            }
        }
        $tree .='<ul>';
        // return $tree;
        return view('/drugAdministration/classifications/draw',compact('tree'));
    }
    
    public function childView($classification){                 
            $html ='<ul>';
            foreach ($classification->childs as $arr) {
                if(count($arr->childs)){
                $html .='<li class="tree-view closed"><a class="tree-name">[ '.$arr->code.' ] '.$arr->en_term.'  '.$arr->ar_term.'</a>';                  
                        $html.= $this->childView($arr);
                    }else{
                        $html .='<li class="tree-view"><a class="tree-name">[ '.$arr->code.' ] '.$arr->en_term.'  '.$arr->ar_term.'</a>';                                 
                        $html .="</li>";
                    }                      
            }       
            $html .="</ul>";
            return $html;
    } 
///////////////////draw2
    public function draw_tree()
    {
        $classifications = Classification::where('parent_code', '=', null)->get();
        $tree='<ul id="browser" class="filetree">';
        foreach ($classifications as $classification) {
             $tree .='<li class="tree-view closed"<a class="tree-name">[ '.$classification->code.' ] '.$classification->en_term.'  '.$classification->ar_term.'</a>';
             if(count($classification->childs)) {
                $tree .=$this->childView_tree($classification);
            }
        }
        $tree .='<ul>';
        // return $tree;
         return view('/drugAdministration/classifications/draw_tree',compact('tree'));

    }
    public function childView_tree($classification){                 
            $html ='<ul>';
            foreach ($classification->childs as $arr) {
                if(count($arr->childs)){
                $html .='<li class="tree-view closed"><a class="tree-name">[ '.$arr->code.' ] '.$arr->en_term.'  '.$arr->ar_term.'</a>';                  
                        $html.= $this->childView_tree($arr);
                    }else{
                        $html .='<li class="tree-view"><a class="tree-name">[ '.$arr->code.' ] '.$arr->en_term.'  '.$arr->ar_term.'</a>';                                 
                        $html .="</li>";
                    }                      
            }
            $html .="</ul>";
            return $html;
    }

*/
}