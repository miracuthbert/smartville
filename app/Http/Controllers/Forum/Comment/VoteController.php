<?php

namespace App\Http\Controllers\Forum\Comment;

use App\Models\Site\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoteController extends Controller
{
    /**
     * VoteController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update or Create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request, $id)
    {
        $comment = Comment::find($id);
        $forum = $comment->forum;

        $vote = $request->input('vote');
        $user = $request->user();

        $msg = $vote == 1 ? 'Comment marked as helpful' : 'Comment marked as unhelpful';

        $save = $comment->votes()->updateOrCreate([
            'user_id' => $user->id,
            'voteable_id' => $comment->id,
            'voteable_type' => Comment::class,
        ], [
            'vote' => $vote
        ]);

        if ($save) {
            $likes = $comment->votesLike->count();
            $dislikes = $comment->votesDislike->count();

            return response()->json([
                'status' => 1,
                'likes' => $likes,
                'dislikes' => $dislikes,
                'message' => $msg,
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Failed polling your vote. Try again!',
        ]);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
