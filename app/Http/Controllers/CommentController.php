<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artwork;
use App\Comment;
use App\Http\Resources\Comment as CommentCollection;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
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
    public function index($artwork_id)
    {
        $comments = Comment::where('artwork_id', $artwork_id)->paginate();
        return CommentCollection::collection($comments);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Artwork $artwork)
    {
        $request['user_id'] = Auth()->id();

        $comment = new Comment($request->all());

        $create_comment = $artwork->comments()->save($comment);
        return response()->json([
            "data" => new CommentResource($create_comment)
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
       return new CommentResource($comment);
    }

 public function update(CommentRequest $request, $id, Comment $comment)
    {
                //check if user is authorized for this action
        if(Auth()->id() != $comment->user_id){

            return response()->json([
                "data" => [
                "message" => "You are not authorized for this action!",
                "reason" => "You are not the owner of the comment you intend to update"
                ]
                ], 403);
        }else{

                $comment->update($request->all());

                return response()->json([
                    "data" => new CommentResource($comment)
                    ], 201);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artwork $artwork, Comment $comment)
    {
               if(Auth()->id() != $comment->user_id){

            return response()->json([
                "data" => [
                "message" => "You are not authorized for this action!"
                ]
                ], 403);
        }else{

            $comment->delete();

            return response()->json([
                "data" => [
                "message" => "Your comment has been deleted!",
                "reason" => "You are not the owner of the comment you intend to delete"
                ]
                ], 200);
    }
}
}
