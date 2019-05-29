<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;
use App\Artwork;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index(Artwork $artwork)
    {
       return response()->json([
       	"data" => [
       	"files" => $artwork->uploads
       	]
       	], 200);
    } 

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Artwork $artwork)
    {
    	  if(Auth()->id() != $artwork->user_id){

    		return response()->json([
    			"data" => [
    			"message" => "You are not authorized for this action!",
    			"reason" => "You are not the owner of the artworks you intend to upload files for"
    			]
    			], 403);
    	}else{
    	$user_id = Auth()->id(); 

    	//returns file name by default
    	 $path = $request->file('upload')->store('/');

    	 $upload = new Upload;
    	 $upload->file_name = $path;
    	 $upload->artwork_id = $artwork->id;
    	 $upload->save();

    	 return response()->json([
    	 	"data" => "Your file has been uploaded",
    	 	"url" => $path
    	 	], 201);

    }


  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artwork $artwork, Upload $upload)
    {
    	if(Auth()->id() != $artwork->user_id){

    		return response()->json([
    			"data" => [
    			"message" => "You are not authorized for this action!",
    			"reason" => "You are not the owner of the file you intend to delete"
    			]
    			], 403);
    	}else{

    		$delete = Storage::delete($upload->file_name);
    		$delete_file =  $upload->delete();
    		if($delete && $delete_file){

    			return response()->json([
    				"data" => [
    				"message" => "Your uploaded file has been deleted!"
    				]
    				], 200);
    		}
    	}
    }
    
}
