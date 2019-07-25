<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use DB; 
use App\Tag;
use View;

class TagController extends Controller
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
        $tags = DB::table('tags')->get();

        $count = $tags->count();
   
        
        return view('drugAdministration/tags/index', compact('tags','count'));
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

         $input = [
            'tag_code' => $request['tag_code'],
            'tag_text' => $request['tag_text'],
            'tag_text_color' => $request['tag_text_color'],
            'tag_background_color' => $request['tag_background_color'],
            'tag_border_color' => $request['tag_border_color']
        ];
        if($request['tag_bold'] !== null)
            $input['tag_bold'] = $request['tag_bold'];
        if($request['tag_italic'] !== null)
            $input['tag_italic'] = $request['tag_italic'];
        if($request['tag_under_line'] !== null)
            $input['tag_under_line'] = $request['tag_under_line'];
        if($request['tag_border'] !== null)
            $input['tag_border'] = $request['tag_border'];
        if($request['tag_font_family'] !== null)
            $input['tag_font_family'] = $request['tag_font_family'];
        if($request['tag_font_size'] !== null)
            $input['tag_font_size'] = $request['tag_font_size'];
        if($request['tag_border_radius'] !== null)
            $input['tag_border_radius'] = $request['tag_border_radius'];

        //dd($input);
        $text ="<span style='background-color:".$request['tag_background_color'].";border-radius:".$request['tag_border_radius']."px;border:".$request['tag_border']." ".$request['tag_border_color'].";color:".$request['tag_text_color'].";font-family:".$request['tag_font_family'].";font-size:".$request['tag_font_size']."px;font-style:".$request['tag_italic'].";font-weight:".$request['tag_bold'].";padding:3px;text-decoration:".$request['tag_under_line'].";'>".$request['tag_text']."</span>";

        if($request['tag_sub']  == '1')
        {
            $input['tag_sub'] = $request['tag_sub'];
            $text = "<sub>".$text."</sub>";
        }
        if($request['tag_sup']  == '1')
        {
            $input['tag_sup'] = $request['tag_sup'];
            $text = "<sup>".$text."</sup>";
        }

        $input['tag_text_for_replace'] = $text;
        //dd($input);
        Tag::create($input);
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
      
        $tag = Tag::findOrFail($id);
        $old_tag_text_for_replace = $tag->tag_text_for_replace;
           
        $input = [
            'tag_code' => $request['tag_code'],
            'tag_text' => $request['tag_text'],
            'tag_text_color' => $request['tag_text_color'],
            'tag_background_color' => $request['tag_background_color'],
            'tag_border_color' =>  $request['tag_border_color'],
        ];
        if($request['tag_bold'] !== null)
            $input['tag_bold'] = $request['tag_bold'];
        if($request['tag_italic'] !== null)
            $input['tag_italic'] = $request['tag_italic'];
        if($request['tag_under_line'] !== null)
            $input['tag_under_line'] = $request['tag_under_line'];
        if($request['tag_border'] !== null)
            $input['tag_border'] = $request['tag_border'];
        if($request['tag_font_family'] !== null)
            $input['tag_font_family'] = $request['tag_font_family'];
        if($request['tag_font_size'] !== null)
            $input['tag_font_size'] = $request['tag_font_size'];
        if($request['tag_border_radius'] !== null)
            $input['tag_border_radius'] = $request['tag_border_radius'];

        $new_tag_text_for_replace ="<span style='background-color:".$request['tag_background_color'].";border-radius:".$request['tag_border_radius']."px;border:".$request['tag_border']." ".$request['tag_border_color'].";color:".$request['tag_text_color'].";font-family:".$request['tag_font_family'].";font-size:".$request['tag_font_size']."px;font-style:".$request['tag_italic'].";font-weight:".$request['tag_bold'].";padding:3px;text-decoration:".$request['tag_under_line'].";'>".$request['tag_text']."</span>";
        
        if($request['tag_sub'] == '1')
        {
            $input['tag_sub'] = $request['tag_sub'];
            $new_tag_text_for_replace = "<sub>".$new_tag_text_for_replace."</sub>";
        }
        if($request['tag_sup']  == '1')
        {
            $input['tag_sup'] = $request['tag_sup'];
            $new_tag_text_for_replace = "<sup>".$new_tag_text_for_replace."</sup>";
        }

        $input['tag_text_for_replace'] = $new_tag_text_for_replace;

        $this->validate($request, [
        'tag_code' => 'required | unique:tags,tag_code,'.$id.''
        ]);

        Tag::where('id', $id)
            ->update($input);  


        DB::statement('call changestyle( ? ,? )',[$old_tag_text_for_replace,$new_tag_text_for_replace]);     
    } 

    /**
    SAVE TAG
    */
    public function save_tag(Request $request)
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
        Tag::where('id', $id)->delete();
         return redirect()->intended('drug-administration/tag');
    }

    /**
    Validate
    */
    private function validateInput($request) {
        $this->validate($request, [
            'tag_code' => 'required|unique:tags',
            ]);
    }

    /**
    Details Of Tag
    */
    public function get_details(Request $request)
    {
        $tag = Tag::find($request->id);
        
        $data = [
            "id" => $tag->id,
            "tag_code" => $tag->tag_code,
            "tag_text" => $tag->tag_text,
            "tag_bold" => $tag->tag_bold ,
            "tag_italic" => $tag->tag_italic ,
            "tag_under_line" => $tag->tag_under_line ,
            "tag_text_color" => $tag->tag_text_color ,
            "tag_background_color" => $tag->tag_background_color ,
            "tag_font_family" => $tag->tag_font_family ,
            "tag_font_size" =>$tag->tag_font_size ,
            "tag_border" => $tag->tag_border ,
            "tag_sub" => $tag->tag_sub ,
            "tag_sup" => $tag->tag_sup ,
            "tag_border_color" => $tag->tag_border_color,
            "tag_border_radius" => $tag->tag_border_radius,
        ];
        return json_encode($data);
    }

    /**
    Get All Tags That Stored In Database
    */
    public function get_tags()
    {
        $tags = DB::table('tags')->get();
        $json_tags = [];

        foreach ($tags as $tag) {
            $json_tags[] = [
            /*"id" => $tag->id,
            "tag_code" => $tag->tag_code,
            "tag_bold" => $tag->tag_bold ,
            "tag_italic" => $tag->tag_italic ,
            "tag_under_line" => $tag->tag_under_line ,
            "tag_text_color" => $tag->tag_text_color ,
            "tag_background_color" => $tag->tag_background_color ,
            "tag_font_family" => $tag->tag_font_family ,
            "tag_font_size" =>(string) $tag->tag_font_size."px"  ,
            "tag_border" => $tag->tag_border ,
            "tag_sub" => $tag->tag_sub ,
            "tag_sup" => $tag->tag_sup ,
            "tag_border_color" => $tag->tag_border_color,
            "tag_border_radius" => $tag->tag_border_radius,*/
            "tag_text" => $tag->tag_text,
            "tag_text_for_replace" => $tag->tag_text_for_replace,
        ];  
        }
        return json_encode($json_tags);
    }


    //replace code with tage
    
        public function replace_code_with_tag($text)
        {           
            
            while(strpos($text, '**') !== false)
            {
                $sub_text   = '**';
                $pos = strpos($text, $sub_text);
                $code = substr($text,$pos+2,3);
                if(substr($text,$pos+5,2) == '**')
                {
                    $tag = DB::table('tags')->where('tag_code','=',$code)->first();

                    $tag_text = "<span style='
                    background-color:".$tag->tag_background_color.";
                    color:".$tag->tag_text_color.";
                    font-size:".$tag->tag_font_size."px;
                    font-family:".$tag->tag_font_family.";
                    font-weight:".$tag->tag_bold.";
                    font-style:".$tag->tag_italic.";
                    border:".$tag->tag_border." ".$tag->tag_border_color.";
                    text-decoration:".$tag->tag_under_line.";
                    border-radius:".$tag->tag_border_radius."px;
                    padding:3px'>".$tag->tag_text."</span>";

                    $tag_text = $tag->tag_sub == "1" ? "<sub>".$tag_text."</sub>" :  $tag_text; 
                    $tag_text = $tag->tag_sup == "1" ? "<sup>".$tag_text."</sup>" :  $tag_text; 

                    $text = str_replace("**".$code."**", $tag_text , $text);
                }
                elseif(substr($text,$pos+5,1) == '(')
                    {
                        $len = strlen($text);
                        $old_str = substr($text,$pos,$len);
                        $new_str = $this->change_style_by_code(substr($text,$pos,$len));
                        $text = str_replace($old_str,$new_str,$text);
                    }
            }
            return $text;
        }

        public function change_style_by_code($text)
        {
            $sub_str = ')';
            $pos = strpos($text, $sub_str);
            $code = substr($text,2,3);
            $tag = DB::table('tags')->where('code','=',$code)->first();
            //$len_str_for_replace = $pos+1;
            $old_str = substr($text,0,$pos+1); 
            $len_str_for_change_style = abs(6 - $pos);
            $new_str = substr($text,6,$len_str_for_change_style);


            $new_str = "<span style='background-color:".$tag->background_color."'>".$new_str."</span>";//background_color
            $new_str = $tag->italic == "1" ? "<em>".$new_str."</em>" :  $new_str; //italic
            $new_str = $tag->under_line == "1" ? "<u>".$new_str."</u>" :  $new_str; //under line
            $new_str = $tag->sub_text == "1" ? "<sub>".$new_str."</sub>" :  $new_str; //
            $new_str = $tag->sup_text == "1" ? "<sup>".$new_str."</sup>" :  $new_str; //italic
            $new_str = "<span style='color:".$tag->text_color."'>".$new_str."</span>";//

            $text = str_replace($old_str, $new_str , $text);
            return $text;

        }
}
