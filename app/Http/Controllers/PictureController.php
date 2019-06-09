<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use Redirect;
use Validator;
use DB;

use Intervention\Image\Facades\Image;

class PictureController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'image_input' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_input')) {
            $image = $request->file('image_input');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/drug/');
            $image->move($destinationPath, $name);
            
            $picture = new Picture();
            $picture->title = $name;
            $picture->path = $destinationPath;
            $picture->class_name = 'drug';
            $picture->object_id = 1;
            $picture->save();
            $path = \URL::to('images/drug/'.$name);
            return json_encode([
                'id'=>$picture->id,
                'path'=>$path
            ]);
        }
        return 'ok';

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    } 

    public function update_image($id_image, $id_object,$class_name)
    {
        $input = [
            'class_name' => $class_name,
            'object_id' => $id_object,
        ];
        Picture::where('id', $id_image)->update($input);

    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }
    
    public function deleteImage(Request $request)
    {
        Picture::where('title',$request->title)->delete();
    }
}
