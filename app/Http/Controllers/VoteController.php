<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Vote as VoteCollection;
use App\Http\Resources\VoteResource;
use App\Vote;
use App\Artwork;
use App\Http\Requests\VoteRequest;

class VoteController extends Controller
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
    public function index($artwork_id)
    {
        $votes = Vote::where('artwork_id', $artwork_id)->paginate(15);
        return VoteCollection::collection($votes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoteRequest $request, $artwork_id)
    {

        $user_id = Auth()->id();
        if(Vote::where(['artwork_id' => $artwork_id,'user_id' => $user_id ])->count() >= 1){
            
            $vote = Vote::where([
            'artwork_id' => $artwork_id,
            'user_id' => Auth()->id()
            ])->first();

        $vote_id = $vote->id;

            return response()->json([
                "data" => [
                "message" => "You are not allowed to revote",
                "vote_id" => $vote_id
                ]
                ], 403);
        }
        $request['artwork_id'] = $artwork_id;

        $user = Auth()->user();
        $create_vote = new Vote($request->all());
        $created_vote = $user->votes()->save($create_vote);

        if($created_vote){

            return response()->json([
                "data" => new VoteResource($created_vote)
                ], 201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Vote $vote)
    {
        return new VoteResource($vote);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoteRequest $request, $id, Vote $vote)
    {   
        //check if user is authenticated to make this action
        if(Auth()->id() != $vote->user_id){
            return response()->json([
                "data" => [
                "message"=> "You are not authorized for this action!",
                "reason" => "You are not the owner of the vote you intend to update"
                ]
                ], 403);
        }else{

        $vote->update($request->all());
        return $vote;
        return response()->json([
            "data" => new VoteResource($updated_vote)
            ], 201);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Vote $vote)
    {
        if(Auth()->id() != $vote->user_id){
            return response()->json([
                "data" => [
                "message"=> "You are not authorized for this action!",
                "reason" => "You are not the owner of the vote you intend to delete"
                ]
                ], 403);
        }else{

         $vote->delete();
        return response()->json([
            "data" => [
            "message" => "Vote Deleted!"
            ]
            ], 200);

        }
    }
}
