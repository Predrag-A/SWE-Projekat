<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{

    /*
     * Sprecava pristup korisnicima koji nisu prijavljeni. 
     * Ako nekom pogledu treba da se dozvoli pristup:
     * $this->middleware('auth', ['except' => ['index', 'show']]);
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Vraca sve komentare
        $comments = Comment::with('user')->orderByDesc('created_at')->get();
        return response($comments, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $comments = Comment::with('user')->where('event_id', $id)->orderByDesc('created_at')->get();
        return response($comments, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string',
            'eventid'=> 'required'
        ]);

        $comment = new Comment;
        
        $comment->user_id = auth()->user()->id;
        $comment->content = $request->input('content');
        $comment->event_id = $request->input('eventid');
        
        $comment->save();
        
        $comment->load('user');

        return response($comment, 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'content' => 'required|string',
        ]);
        
        
        $comment = Comment::find($id);

        $comment->content = $request->input('content');        
        $comment->save();
        
        $comment->load('user');

        return response($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        $comment->delete();

        return response(null, 204);
    }
}
