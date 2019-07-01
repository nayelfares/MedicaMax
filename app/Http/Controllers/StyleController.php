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
  		//dd($request);
        $this->validateInput($request);

         $input = [
            'style_name' => $request['style_name'],
            'style_text_color' => $request['style_text_color'],
            'style_background_color' => $request['style_background_color']
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
      	//dd($input);
		Style::create($input);





        return redirect()->intended('/drug-administration/style');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $style = Style::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($style == null ) {
            return redirect()->intended('drug-administration/style');
        }
        return view('drugAdministration/styles/edit', ['style' => $style ]);
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
        $input = [
            'style_name' => $request['style_name'],
            'text_color' => $request['text_color'],
            'background_color' => $request['background_color'],
            'italic' => $request['italic'],
            'under_line' => $request['under_line'],
            'bold' => $request['bold'],
            'border' => $request['border'],
            'font_family' => $request['font_family'],
            'font_size' => $request['font_size'],
        ];
        $this->validate($request, [
        'style_name' => 'required | unique:styles,en_name,'.$id.''
        ]);

        Style::where('id', $id)
            ->update($input);
        
        return redirect()->intended('drug-administration/style');
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
         	 	"style_background_color" => $style->style_background_color ,
         	 	"style_font_family" => $style->style_font_family ,
         	 	"style_font_size" =>(string) $style->style_font_size."px" ,
         	 	"style_border" => $style->style_border ,
         	 ];   
        }
        return json_encode($json_styles);
    }
}
