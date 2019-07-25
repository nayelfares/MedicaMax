<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use DB;
use App\MultiMedia;
use View;
class MultiMediaController extends Controller
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
        $multi_media = DB::table('multi_media')->get();

        $count = $multi_media->count();
   
        
        return view('drugAdministration/multi_media/index', compact('multi_media','count'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
    	$file_name = null;
        $url = null;
        if($request->file('m_m_file')){
            $file_name = time() . '.' . $request->m_m_file->getClientOriginalName();
            if($request->file_type == "image")
            {
            	$request->m_m_file->move(public_path('images_tree/'),$file_name);
                $url = '/images_tree/'.$file_name;
                $request['description'] = $request['description']."dd";
            }
            else
            {
                if($request->file_type == "video")
                {
                	
                    $request->m_m_file->move(public_path('videos_tree/'),$file_name);
                    $url = '/videos_tree/'.$file_name;
             $request['description'] = $request['description']."ff";       
                }
                else
                {
                   
                	$request->m_m_file->move(public_path('files_tree/'),$file_name);
                    $url = '/files_tree/'.$file_name;
                     $request['description'] = $request['description']."gg"; 
                }
            }
        }
        $input = [
                        'description' => $request['description'],
                        'file_type' => $request['file_type'],
                        'path' => $url ,
                    ];
        MultiMedia::create($input);

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
      
        $multi_media = MultiMedia::findOrFail($id);
        $file_name = null;
        $url = null;
        if($request->file('m_m_file')){
            $file_name = time() . '.' . $request->m_m_file->getClientOriginalName();
            if($request->file_type == "image")
            {
                $request->m_m_file->move(public_path('/images_tree/'),$file_name);
                $url = public_path('/images_tree/').$file_name;
                $request['description'] = $request['description']."dd";
            }
            else
            {
                if($request->file_type == "video")
                {
                    
                    $request->m_m_file->move(public_path('/videos_tree/'),$file_name);
                    $url = public_path('/videos_tree/').$file_name;
             $request['description'] = $request['description']."ff";       
                }
                else
                {
                   
                    $request->m_m_file->move(public_path('/files_tree/'),$file_name);
                    $url = public_path('/files_tree/').$file_name;
                     $request['description'] = $request['description']."gg"; 
                }
            }
        }
        else{
            $url = $multi_media->path;
        }
           
        $input = [
                        'description' => $request['description'],
                        'file_type' => $request['file_type'],
                        'path' => $url ,
                    ];

        MultiMedia::where('id', $id)
            ->update($input);  
    
    } 

  	/**
    SAVE TAG
    */
    public function save_multi_media(Request $request)
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


    public function destroy($id)
    {
        $m_m_delete = MultiMedia::findOrFail($id);;
        unlink($m_m_delete->path);
        $m_m_delete->delete();
        return redirect()->intended('drug-administration/multi_media');
    }

    /**
    Details Of MultiMedia
    */
    public function get_details(Request $request)
    {

        $multi_media = MultiMedia::find($request->id);
        
        $data = [
            "id" => $multi_media->id,
            "description" => $multi_media->description,
            "file_type" => $multi_media->file_type,
            "path" => $multi_media->path ,
        ];

        return json_encode($data);
    }

    

}
