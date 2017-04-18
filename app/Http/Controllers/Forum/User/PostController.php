<?php

namespace App\Http\Controllers\Forum\User;

use App\Http\Requests\Forum\StoreForumPostRequest;
use App\Models\Forum\ForumTopic;
use App\Models\Site\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param ForumTopic $topics
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ForumTopic $topics)
    {
        $id = $request->author;
        $sort = 'user';

        $user = User::find($id);

        $topics = $topics::withCount('comments')->where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(15);

        //get tags
        $tags = Tag::where('taggable_type', ForumTopic::class)->select('name')->distinct()->latest()->paginate(5);

        return view('v1.forum.user.index')
            ->with('topics', $topics)
            ->with('sort', $sort)
            ->with('user', $user)
            ->with('tags', $tags);
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

        //get topic
        $topic = ForumTopic::withCount('comments')->where('id', $id)->first();

        //tags
        $_tags = $topic->tags;

        //get tags
        $tags = Tag::where('taggable_type', ForumTopic::class)->select('name')->distinct()->latest()->paginate(5);

        //comments
        $comments = $topic->comments()->latest()->get();

        return view('v1.forum.user.edit')
            ->with('topic', $topic)
            ->with('_tags', $_tags)
            ->with('tags', $tags)
            ->with('comments', $comments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreForumPostRequest $request, $id)
    {

        $z = 0;
        $uploadSuccess = 0;
        $tagSuccess = 0;
        $success = array();
        $upload = array();
        $data = array();
        $uploads = $request->file('file');
        $user = $request->user();

        //level
        $is_support = $request->input('answer_from_support') == null ? 0 : $request->input('answer_from_support');
        $is_community = $request->input('answer_from_community') == null ? 0 : $request->input('answer_from_community');
        $is_founder = $request->input('answer_from_founder') == null ? 0 : $request->input('answer_from_founder');

        //tags
        $tags = $request->input('tags');
        $tagCount = count($tags);

        $topic = ForumTopic::find($id);
        $topic->title = $request->input('topic');
        $topic->details = $request->input('details');
        $topic->is_support = $is_support;
        $topic->is_community = $is_community;
        $topic->is_founder = $is_founder;

        //save
        if ($user->forums()->save($topic)) {

            //success
            $success = array_add($success, $z++, 'Post updated successfully.');

            //add tags
            foreach ($tags as $tag) {
                $tagStatus = $this->taggable($tag, $topic, $user);
                if ($tagStatus) {
                    $tagSuccess++;
                }
            }

            if ($tagSuccess > 0)
                $success = array_add($success, $z++, $tagSuccess . ' of ' . $tagCount . ' tags added along with post successfully.');

            return redirect()->back()
                ->with('bulk_success', $success);
        }

        return redirect()->back()
            ->with('error', 'Failed adding post. Try again!')
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (ForumTopic::destroy($id))
            return redirect()->back()
                ->with('success', 'Post deleted successfully.');

        return redirect()->back()
            ->with('error', 'Failed deleting post. Please try again!');
    }

    /**
     * @param $tag
     * @param $topic
     * @param $user
     * @return bool
     */
    private function taggable($tag, $topic, $user)
    {
        $_tag = new Tag([
            'user_id' => $user->id,
            'name' => $tag,
        ]);

        //save
        if ($topic->tags()->updateOrCreate(['name' => $tag, 'user_id' => $user->id]))
            return true;

        //return false on fail
        return false;

    }

    /**
     * Update the specified resource status in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $topic = ForumTopic::find($id);
        $topic->solved_at = $topic->solved_at == null ? Carbon::now() : null;

        //message
        $message = $topic->solved_at != null ? 'Post marked as closed.' : 'Post status changed to active';

        if ($topic->save())
            return redirect()->back()
                ->with('success', $message);

        return redirect()->back()
            ->with('error', 'Failed updating post status. Please try again!');
    }
}
