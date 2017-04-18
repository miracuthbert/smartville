<?php

namespace App\Http\Controllers\Forum\Search;

use App\Models\Forum\ForumTopic;
use App\Models\Site\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param ForumTopic $topics
     * @param Tag $tags
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ForumTopic $topics, Tag $tags)
    {
        //init variables
        //results
        $results = null;

        //keyword
        $keyword = $request->keyword;

        //tag
        $tag = null;

        //topic
        $topic = null;

        //get tags
        $tags = Tag::where('taggable_type', ForumTopic::class)->select('name')->distinct()->latest()->paginate(5);

        switch ($keyword) {
            case 'tags':    //tag searcsh

                //get tag
                $tag = $request->tag;

                //results
                $results = $tags::where('name', 'LIKE', '%' . $tag . '%')->latest()->get();
                break;

            case 'simple':  //simple search

                //where
                $where = null;

                //get search input
                $topic = $request->input('topic');

                //explode the search input to single strings
                $_topics = explode(' ', $topic);

                foreach ($_topics as $topic) { //loop through the search term; create custom search query
                    if (head($_topics) == $topic)
                        $where .= " `title` LIKE '%" . $topic . "%' or `details` LIKE '%" . $topic . "%' or";
                    else if (last($_topics) == $topic)
                        $where .= " `title` LIKE '%" . $topic . "%' or `details` LIKE '%" . $topic . "%'";
                    else
                        $where .= " `title` LIKE '%" . $topic . "%' or `details` LIKE '%" . $topic . "%' or ";

                }

                //results
                $results = $topics::withCount('comments')->where(DB::raw($where))->paginate();
                break;

            default:
                $results = null;
                break;

        }

        return view('v1.forum.search.index')
            ->with('keyword', $keyword)
            ->with('tag', $tag)
            ->with('topic', $topic)
            ->with('tags', $tags)
            ->with('results', $results);
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
