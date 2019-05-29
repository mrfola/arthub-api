<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtworkRequest;
use App\Artwork;
use App\Http\Resources\Artwork as ArtworkCollection;
use App\Http\Resources\ArtworkResource;
use App\User;
class ArtworkController extends Controller
{
    public function __construct()
    {
     return $this->middleware('auth:api')->except('index', 'show');
 }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $artworks = Artwork::where('user_id', $user_id)->paginate();
        return ArtworkCollection::collection($artworks);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtworkRequest $request)
    {
       $user = Auth()->user(); //get the logged in user
       $artwork = new Artwork ($request->all());
       $save_artwork = $user->artworks()->save($artwork);
       return response()->json([

        "data" => new ArtworkResource($save_artwork)

        ], 201); 
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Artwork $artwork)
    {
        return new ArtworkResource($artwork);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtworkRequest $request, Artwork $artwork)
    {
        $user_id = Auth()->id();

        if($user_id != $artwork->user_id){ //if the user is not permited to update
           return response()->json([
            "data" => [
            "message" => "You are not authorized for this action!",
            "reason" => "You are not the owner of the artwork you intend to create"
            ]
            ], 403); 
       }else{

        $user = Auth()->user(); //get the logged in user
        $artwork->update($request->all());
        return response()->json([

            "data" => new ArtworkResource($artwork)

            ], 201); 
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artwork $artwork)
    {
        $user_id = Auth()->id();

        if($user_id != $artwork->user_id){ //if the user is not permited to delete
           return response()->json([
            "data" => [
            "message" => "You are not authorized for this action!",
            "reason" => "You are not the owner of the artwork you intend to delete"
            ]
            ], 403); 
       }else{

        $artwork->delete();
        return response()->json([

            "data" => [
            "message" => "Artwork Deleted!"
            ]
            ], 201); 

    }

}
}
