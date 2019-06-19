<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use DB;
use App\MedicaMaxTag;
use View;
class MedicaMaxTagController extends Controller
{
    
    
    public function __construct(){
        $this->middleware('auth');
    }
    

    protected $rules =
    [
        'code' => 'required|min:3|max:3|unique:medica_max_tags'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $tags = DB::table('medica_max_tags')->get();

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
        /*
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $tag = new MedicaMaxTag();
            $tag->code = $request['code'];
            $tag->tag_text = $request['tag_text'];
            $tag->text_color = $request['text_color'];
            $tag->background_color = $request['background_color'];
            $tag->italic = $request['italic'];
            $tag->under_line = $request['under_line'];
            $tag->border = $request['border'];
            $tag->sup_text = $request['sup_text'];
            $tag->sub_text = $request['sub_text'];
            $tag->save();
            return response()->json($tag);
        }
       */
        





         $this->validateInput($request);
        
        MedicaMaxTag::create([
            'code' => $request['code'],
            'tag_text' => $request['tag_text'],
            'text_color' => $request['text_color'],
            'background_color' => $request['background_color'],
            'italic' => $request['italic']=='1' ? '1' : '0',
            'under_line' => $request['under_line']=='1' ? '1' : '0',
            'border' => $request['border']=='1' ? '1' : '0',
            'sup_text' => $request['sup_text']=='1' ? '1' : '0',
            'sub_text' => $request['sub_text']=='1' ? '1' : '0',
        ]);
        return redirect()->intended('/drug-administration/tag');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $tag = MedicaMaxTag::findOrFail($id);

        return view('tag.show', ['tag' => $tag]);
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $tag = MedicaMaxTag::findOrFail($id);
            $tag->code = $request['code'];
            $tag->tag_text = $request['tag_text'];
            $tag->text_color = $request['text_color'];
            $tag->background_color = $request['background_color'];
            $tag->italic = $request['italic'];
            $tag->under_line = $request['under_line'];
            $tag->border = $request['border'];
            $tag->sup_text = $request['sup_text'];
            $tag->sub_text = $request['sub_text'];
            $tag->save();
            return response()->json($tag);
        }
      */
        $tag = MedicaMaxTag::findOrFail($request->id);
        
        $input = [
            'code' => $request['code'],
            'tag_text' => $request['tag_text'],
            'text_color' => $request['text_color'],
            'background_color' => $request['background_color'],
            'italic' => $request['italic'],
            'under_line' => $request['under_line'],
            'border' => $request['border'],
            'sup_text' => $request['sup_text'],
            'sub_text' => $request['sub_text'],
        ];

        $this->validate($request, [
        'code' => 'required|unique:medica_max_tags,'.$request->id.''
        ]);

        MedicaMaxTag::where('id', $request->id)->update($input);
    }  
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       /* $tag = MedicaMaxTag::findOrFail($id);
        $tag->delete();

        return response()->json($tag);*/
        MedicaMaxTag::where('id', $id)->delete();
        return redirect()->intended('/drug-administration/tag');
    }

    //validation create tag : code is required and unique.
    private function validateInput($request) {
        $this->validate($request, [
            'code' => 'required|unique:medica_max_tags',
            ]);
    }

    //replace code with tage
    
        public function replace_code_with_tag($text)
        {
            
            //$text = $request->text;
            
            while(strpos($text, '**') !== false)
            {
                $sub_text   = '**';
                $pos = strpos($text, $sub_text);
                $code = substr($text,$pos+2,3);

                $tag = DB::table('medica_max_tags')->where('code','=',$code)->first();
               
                $tag_text = $tag->tag_text;
                $tag_text = "<span style='background-color:".$tag->background_color."'>".$tag_text."</span>";//background_color
                $tag_text = $tag->italic == "1" ? "<em>".$tag_text."</em>" :  $tag_text; //italic
                $tag_text = $tag->under_line == "1" ? "<u>".$tag_text."</u>" :  $tag_text; //under line
                $tag_text = $tag->sub_text == "1" ? "<sub>".$tag_text."</sub>" :  $tag_text; //
                $tag_text = $tag->sup_text == "1" ? "<sup>".$tag_text."</sup>" :  $tag_text; //italic
                $tag_text = "<span style='color:".$tag->text_color."'>".$tag_text."</span>";//

                $text = str_replace("**".$code."**", $tag_text , $text);
            }
            return $text;
        }
    

}