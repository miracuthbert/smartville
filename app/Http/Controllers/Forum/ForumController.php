<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests\Forum\StoreForumPostRequest;
use App\Models\Forum\ForumTopic;
use App\Models\Site\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    /**
     * ForumController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index', 'show'
        ]);
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
        $sort = $request->sort;

        //get all forum topics
        $topics = $topics::withCount('comments')->orderBy('created_at', 'DESC')->paginate(15);

        //get tags
        $tags = Tag::where('taggable_type', ForumTopic::class)->select('name')->distinct()->latest()->paginate(5);

//        dd($tags);

        return view('v1.forum._index')
            ->with('topics', $topics)
            ->with('sort', $sort)
            ->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get tags
        $tags = Tag::where('taggable_type', ForumTopic::class)->select('name')->distinct()->latest()->paginate(5);

        return view('v1.forum.create')
            ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreForumPostRequest $request)
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
        

        //upload handler
        if ($uploads != null) {
            //count uploads
            $count = count($uploads);

            //multiple uploads
            if ($count > 1) {
                foreach ($uploads as $upload) {
                    $uploadStatus = $this->upload($upload);

                    //check if upload is successful
                    if ($uploadStatus) {
                        $uploadSuccess++;
                    }
                }

                //check if uploads successful
                if ($uploadSuccess > 0)
                    $success = array_add($success, $z++, $uploadSuccess . ' of ' . $count . ' uploaded successfully.');
            }

            //single upload
            $uploadStatus = $this->upload($upload);

            //check if upload is successful
            if ($uploadStatus) {
            }

//            $data = array_add($data, 'level', $request->file('file'));
        }

        //tags
        $tags = $request->input('tags');
        $tagCount = count($tags);

        $topic = new ForumTopic();
        $topic->title = $request->input('topic');
        $topic->details = $request->input('details');
        $topic->is_support = $is_support;
        $topic->is_community = $is_community;
        $topic->is_founder = $is_founder;

        //save
        if ($user->forums()->save($topic)) {

            //success
            $success = array_add($success, $z++, 'Post added to forum successfully.');

            //add tags
            foreach ($tags as $tag) {
                $tagStatus = $this->taggable($tag, $topic, $user);
                if ($tagStatus) {
                    $tagSuccess++;
                }
            }

            if ($tagSuccess > 0)
                $success = array_add($success, $z++, $tagSuccess . ' of ' . $tagCount . ' tags added along with post successfully.');

            return redirect()->route('forum.index')
                ->with('bulk_success', $success);
        }

//        dd($request->all());

        return redirect()->back()
            ->with('error', 'Failed adding post. Try again!')
            ->withInput();
    }

    /**
     * Upload a newly attached file in storage.
     */
    public function upload($upload)
    {
        //check if image
    }

    /**
     * Upload a newly attached file in storage.
     * @param $tag
     * @param $topic
     * @param $user
     * @return bool
     */
    public function taggable($tag, $topic, $user)
    {
        $_tag = new Tag();
        $_tag->user_id = $user->id;
        $_tag->name = $tag;

        //save
        if ($topic->tags()->save($_tag))
            return true;

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $notify_id = $request->read;

        if ($notify_id != null) {
            //find notification
            $notification = $request->user()->notifications()->where('id', $notify_id)->first();

            //mark as read if not read
            $notification->read_at == null ? $notification->update(['read_at' => Carbon::now()]) : '';
        }

        //get topic
        $topic = ForumTopic::withCount('comments')->where('id', $id)->first();

        //tags
        $_tags = $topic->tags;

        //get tags
        $tags = Tag::where('taggable_type', ForumTopic::class)->select('name')->distinct()->latest()->paginate(5);

        //comments
        $comments = $topic->comments()->latest()->get();

        return view('v1.forum.show')
            ->with('topic', $topic)
            ->with('_tags', $_tags)
            ->with('tags', $tags)
            ->with('comments', $comments);
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
