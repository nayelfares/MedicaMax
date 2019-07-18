<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use DB;
use App\Style;
use View;
class StyleController extends Controller
{
    //
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
        $styles = DB::table('styles')->get();

        $count = $styles->count();
   
        
        return view('drugAdministration/styles/index', compact('styles','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/drugAdministration/styles/create');
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
        $background_color_value = $request['style_background_color'] =="#ffffff" ? "none" :$request['style_background_color'] ;
        $input = [
            'style_name' => $request['style_name'],
            'style_text_color' => $request['style_text_color'],
            'style_background_color' => $background_color_value,
            'style_border_color' => $request['style_border_color']
        ];
        if($request['style_bold'] !== null)
            $input['style_bold'] = $request['style_bold'];
        if($request['style_italic'] !== null)
            $input['style_italic'] = $request['style_italic'];
        if($request['style_under_line'] !== null)
            $input['style_under_line'] = $request['style_under_line'];
        if($request['style_border'] !== null)
            $input['style_border'] = $request['style_border'];
        if($request['style_font_family'] !== null)
            $input['style_font_family'] = $request['style_font_family'];
        if($request['style_font_size'] !== null)
            $input['style_font_size'] = $request['style_font_size'];
        if($request['style_border_radius'] !== null)
            $input['style_border_radius'] = $request['style_border_radius'];


        
        //dd($input);
        $text ="background-color:".$background_color_value.";border-radius:".$request['style_border_radius']."px;border:".$request['style_border']." ".$request['style_border_color'].";color:".$request['style_text_color'].";font-family:".$request['style_font_family'].";font-size:".$request['style_font_size']."px;font-style:".$request['style_italic'].";font-weight:".$request['style_bold'].";padding:5px;text-decoration:".$request['style_under_line'].";";

        $input['style_text'] = $text;

        Style::create($input);

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
      
        $style = Style::findOrFail($id);
        $old_style_text = $style->style_text;

        $background_color_value = $request['style_background_color'] =="#ffffff" ? "none" :$request['style_background_color'] ;
        $input = [
            'style_name' => $request['style_name'] ,
            'style_text_color' => $request['style_text_color'] ,
            'style_background_color' => $background_color_value ,
            'style_border_color' => $request['style_border_color'] ,
        ];
        if($request['style_bold'] !== null)
            $input['style_bold'] = $request['style_bold'];
        if($request['style_italic'] !== null)
            $input['style_italic'] = $request['style_italic'];
        if($request['style_under_line'] !== null)
            $input['style_under_line'] = $request['style_under_line'];
        if($request['style_border'] !== null)
            $input['style_border'] = $request['style_border'];
        if($request['style_font_family'] !== null)
            $input['style_font_family'] = $request['style_font_family'];
        if($request['style_font_size'] !== null)
            $input['style_font_size'] = $request['style_font_size'];
        if($request['style_border_radius'] !== null)
            $input['style_border_radius'] = $request['style_border_radius'];

        $new_style_text ="background-color:".$background_color_value.";border-radius:".$request['style_border_radius']."px;border:".$request['style_border']." ".$request['style_border_color'].";color:".$request['style_text_color'].";font-family:".$request['style_font_family'].";font-size:".$request['style_font_size']."px;font-style:".$request['style_italic'].";font-weight:".$request['style_bold'].";padding:5px;text-decoration:".$request['style_under_line'].";";
        
        $input['style_text'] = $new_style_text;

        $this->validate($request, [
        'style_name' => 'required | unique:styles,style_name,'.$id.''
        ]);

        Style::where('id', $id)
            ->update($input);
        //DB::statement('call changestyle( ? ,? )',['olaa','xvxx']);
        DB::statement('call changestyle( ? ,? )',[$old_style_text,$new_style_text]);     
    }  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Style::where('id', $id)->delete();
         return redirect()->intended('drug-administration/style');
    }

    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    
    private function validateInput($request) {
        $this->validate($request, [
            'style_name' => 'required|unique:styles',
            ]);
    }



    
    public function get_styles()
    {
        $styles = DB::table('styles')->get();
        $json_styles = [];
        //'id','style_name' ,'bold','italic','under_line','text_color','','border','font_family','font_size'
        foreach ($styles as $style) {
             $json_styles[]=[
                "id" => $style->id,
                "style_name" => $style->style_name ,
                "style_bold" => $style->style_bold ,
                "style_italic" => $style->style_italic ,
                "style_under_line" => $style->style_under_line ,
                "style_text_color" => $style->style_text_color ,
                "style_background_color" => $style->style_background_color == "none" ,
                "style_font_family" => $style->style_font_family ,
                "style_font_size" =>(string) $style->style_font_size."px" ,
                "style_border" => $style->style_border ,
                "style_border_color" => $style->style_border_color ,
                "style_border_radius" =>$style->style_border_radius,
             ];   
        }
        return json_encode($json_styles);
    }

    public function get_details(Request $request)
    {
        $style = Style::find($request->id);
        //$style = DB::table('styles')->where('id','=',$request->id)->first();
        $data = [
            "id" => $style->id,
            "style_name" => $style->style_name ,
            "style_bold" => $style->style_bold ,
            "style_italic" => $style->style_italic ,
            "style_under_line" => $style->style_under_line ,
            "style_text_color" => $style->style_text_color ,
            "style_background_color" => $style->style_background_color == "none" ? "#ffffff" : $style->style_background_color,
            "style_font_family" => $style->style_font_family ,
            "style_font_size" =>$style->style_font_size ,
            "style_border" => $style->style_border ,
            "style_border_color" => $style->style_border_color ,
            "style_border_radius" =>$style->style_border_radius,
        ];
        return json_encode($data);
    }

    public function save_style(Request $request)
    {
        //return $request;

        if($request->id == null)
        {
            $this->store($request);
        }
        else
        {
            $this->update($request,$request->id);
        }
    }


}
 //replace code with tage
    