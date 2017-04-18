<?php

namespace App\Http\Controllers\Admin\Documentation;

use App\Http\Requests\Admin\Docs\StoreManualPageRequest;
use App\Models\v1\Documentation\ManualChapter;
use App\Models\v1\Documentation\ManualPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManualPageController extends Controller
{
    /**
     * ManualPageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //catch passed manual; status
        $id = $request->manchapter;
        $status = $request->status;

        //find manual
        $chapter = ManualChapter::find($id);

//        dd($manual);

        //check if null
        if ($chapter == null)
            abort(404);

        //find manual
        $manual = $chapter->manual;

        //find pages
        //pages
        if ($status == null)
            $pages = $chapter->pages()->orderBy('created_at', 'desc')->paginate();

        //pages disabled
        if ($status == "disabled")
            $pages = $chapter->pages()->where('status', 0)->orderBy('updated_at', 'desc')->paginate();

        //pages active
        if ($status == "active")
            $pages = $chapter->pages()->where('status', 1)->orderBy('updated_at', 'desc')->paginate();

        //pages trashed
        if ($status == "trashed")
            $pages = $chapter->pages()->onlyTrashed()->orderBy('deleted_at', 'desc')->paginate();

        //render view
        return view('v1.admin.documentation.man_pages.index')
            ->with('status', $status)
            ->with('manual', $manual)
            ->with('chapter', $chapter)
            ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //passed manual
        $chapter = $request->manchapter;

        //find chapter
        $chapter = ManualChapter::find($chapter);

        //passed manual
        $manual = $chapter->manual;

        $product = null;
        $features = null;

        if ($manual->manualable_type == Product::class) {
            //find manual product
            $product = $manual->manualable;

            //find manual product features
            $features = $product->features;
        }

        return view('v1.admin.documentation.man_pages.create')
            ->with('product', $product)
            ->with('features', $features)
            ->with('man', $manual)
            ->with('chapter', $chapter);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManualPageRequest $request)
    {
        //validation successful

        //catch input
        $chapter = $request->input('chapter');
        $user = $request->user();
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');
        $status = $request->input('status');

        //find chapter
        $chapter = ManualChapter::find($chapter);
        $_title = $chapter->title;

        //new
        $page = new ManualPage();
        $page->user_id = $user->id;
        $page->title = $title;
        $page->body = $body;
        $page->url = $url;
        $page->status = $status;

        if ($chapter->pages()->save($page))
            return redirect()->route('manpage.index', ['manchapter' => $chapter->id])
                ->with('success', $title . ' page added to ' . $_title . ' chapter successfully.');

        //error
        return redirect()->back()
            ->with('error', 'Failed creating page ' . $title . '. Please try again!')
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

        //find page
        $page = ManualPage::find($id);

        //chapter
        $chapter = $page->chapter;

        //find manual
        $manual = $chapter->manual;

        //chapters
        $chapters = $manual->chapters;

        return view('v1.admin.documentation.man_pages.show')
            ->with('manual', $manual)
            ->with('chapters', $chapters)
            ->with('chapter', $chapter)
            ->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //find page
        $page = ManualPage::find($id);

        //chapter
        $chapter = $page->chapter;

        //find manual
        $manual = $chapter->manual;

        //chapters
        $chapters = $manual->chapters;

        return view('v1.admin.documentation.man_pages.edit')
            ->with('manual', $manual)
            ->with('chapters', $chapters)
            ->with('chapter', $chapter)
            ->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreManualPageRequest $request, $id)
    {
        //validation successful

        //catch input
        $chapter = $request->input('chapter');
        $user = $request->user();
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');
        $status = $request->input('status');

        //find chapter
        $chapter = ManualChapter::find($chapter);

        //find page
        $page = ManualPage::find($id);

        //fill page
        $page->user_id = $user->id;
        $page->title = $title;
        $page->body = $body;
        $page->url = $url;
        $page->status = $status;

        if ($chapter->pages()->save($page))
            return redirect()->back()
                ->with('success', $title . ' page updated successfully.');

        //error
        return redirect()->back()
            ->with('error', 'Failed updating page ' . $title . '. Please try again!')
            ->withInput();
    }

    /**
     * Update the specified resource status in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $page = ManualPage::find($id);

        if ($page == null)
            abort(404);

        //title
        $title = $page->title;

        //status
        $status = $page->status == 1 ? 0 : 1;
        $statusMsg = $status == 1 ? 'Active' : 'Disabled';

        if ($page->update(['status' => $status]))
            return redirect()->back()
                ->with('success', $title . ' page status successfully updated to ' . $statusMsg);

        return redirect()->back()
            ->with('error', 'Failed updating ' . $title . ' page status. Try again!');
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $page = ManualPage::onlyTrashed()->where('id', $id)->first();

        if ($page == null)
            abort(404);

        //title
        $title = $page->title;

        if ($page->restore())
            return redirect()->back()
                ->with('success', $title . ' page successfully restored.');

        return redirect()->back()
            ->with('error', 'Failed restoring ' . $title . ' page to manual. Try again!');
    }

    /**
     * Partially Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $page = ManualPage::find($id);

        if ($page == null)
            abort(404);

        //title
        $title = $page->title;

        if ($page->delete())
            return redirect()->back()
                ->with('success', $title . ' page moved to trash.');

        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' page to trash. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = ManualPage::onlyTrashed()->where('id', $id)->first();

        if ($page == null)
            abort(404);

        //title
        $title = $page->title;

        if ($page->forceDelete())
            return redirect()->back()
                ->with('success', $title . ' page deleted completely.');

        return redirect()->back()
            ->with('error', 'Failed deleting ' . $title . ' page. Try again!');
    }
}
