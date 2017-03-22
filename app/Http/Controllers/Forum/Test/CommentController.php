<?php

namespace App\Http\Controllers\Forum\Test;

use App\Models\Forum\ForumTopic;
use App\Models\Site\Comment;
use App\Models\Site\Vote;
use App\Notifications\ForumCommentNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
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
        $this->validate($request, [
            'topic' => 'required|exists:forum_topics,id',
            'comment' => 'required',
        ]);

        //catch input
        $comment = $request->input('comment');
        $topic = $request->input('topic');
        $user = $request->user();

        //data
        $data = array();

        //uploads
        $uploads = $request->input('file');

        //get topic
        $forum = ForumTopic::find($topic);

        //query comment
        $_comment = new Comment();
        $_comment->user_id = $user->id;
        $_comment->body = $comment;

        //save
        if ($forum->comments()->save($_comment)) {

            //queue notification
            $when = Carbon::now()->addMinutes(1);

            //notify forum owner
            $_user = $_comment->forum->user;
            $_user->notify((new ForumCommentNotification($forum, $_comment, $_user))->delay($when));

            return redirect()->back()
                ->with('success', 'Comment added successfully.');
        }
        //error
        return redirect()->back()
            ->with('error', 'Failed adding comment. Try again')
            ->withInput();
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
     * Store or update the specified resource vote in storage.
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
