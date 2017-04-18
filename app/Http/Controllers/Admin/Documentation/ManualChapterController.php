<?php

namespace App\Http\Controllers\Admin\Documentation;

use App\Http\Requests\Admin\Docs\StoreManualChapterPost;
use App\Models\v1\Documentation\Manual;
use App\Models\v1\Documentation\ManualChapter;
use App\Models\v1\Product\Product;
use App\Models\v1\Product\ProductFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManualChapterController extends Controller
{
    /**
     * ManualChapterController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //catch passed manual; status
        $id = $request->manual;
        $status = $request->status;

        //find manual
        $manual = Manual::find($id);

//        dd($manual);

        //check if null
        if ($manual == null)
            abort(404);

        //find product
        $product = $manual->manualable;

        //find chapters
        //chapters
        if ($status == null)
            $chapters = $manual->chapters()->orderBy('created_at', 'desc')->paginate();

        //chapters disabled
        if ($status == "disabled")
            $chapters = $manual->chapters()->where('status', 0)->orderBy('updated_at', 'desc')->paginate();

        //chapters active
        if ($status == "active")
            $chapters = $manual->chapters()->where('status', 1)->orderBy('updated_at', 'desc')->paginate();

        //chapters trashed
        if ($status == "trashed")
            $chapters = $manual->chapters()->onlyTrashed()->orderBy('deleted_at', 'desc')->paginate();

        //render view
        return view('v1.admin.documentation.man_chapters.index')
            ->with('status', $status)
            ->with('product', $product)
            ->with('manual', $manual)
            ->with('chapters', $chapters);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //passed manual
        $manual = $request->manual;

        //find manual
        $manual = Manual::find($manual);

        $product = null;
        $features = null;

        if ($manual->manualable_type == Product::class) {
            //find manual product
            $product = $manual->manualable;

            //find manual product features
            $features = $product->features;
        }

        //all manuals
        $manuals = Manual::all();

        return view('v1.admin.documentation.man_chapters.create')
            ->with('product', $product)
            ->with('features', $features)
            ->with('man', $manual)
            ->with('mans', $manuals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManualChapterPost $request)
    {

        //validation successful
//        dd($request->all());

        //catch input
        $manual = $request->input('manual');
        $user = $request->user();
        $feature = $request->input('feature');
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');
        $status = $request->input('status');

        //find manual
        $manual = Manual::find($manual);
        $_title = $manual->title;

        //feature
        $feature = ProductFeature::find($feature);

        //new manual chapter
        $chapter = new ManualChapter();
        $chapter->user_id = $user->id;
        $chapter->title = $title;
        $chapter->body = $body;
        $chapter->url = $url;
        $chapter->status = $status;

//        dd($feature);

        //success
        if ($feature != null) { //store via features
            $chapter->manual_id = $manual->id;
            if ($feature->chapters()->save($chapter)) {
                return redirect()->route('manual.index')
                    ->with('success', $title . ' chapter in ' . $_title . ' manual created successfully.');
            }
        } else { //store via manual
            if ($manual->chapters()->save($chapter)) {
                return redirect()->route('manual.index')
                    ->with('success', $title . ' chapter in ' . $_title . ' manual created successfully.');
            }
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed creating chapter ' . $title . '. Please try again!')
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

        //find chapter
        $chapter = ManualChapter::find($id);

        //find manual
        $manual = $chapter->manual;
        $chapters = $manual->chapters;

        $product = null;
        $features = null;

        if ($manual->manualable_type == Product::class) {
            //find manual product
            $product = $manual->manualable;

            //find manual product features
            $features = $product->features;
        }

        return view('v1.admin.documentation.man_chapters.show')
            ->with('product', $product)
            ->with('features', $features)
            ->with('manual', $manual)
            ->with('chapters', $chapters)
            ->with('chapter', $chapter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //find chapter
        $chapter = ManualChapter::find($id);

        //find manual
        $manual = $chapter->manual;
        $chapters = $manual->chapters;

        $product = null;
        $features = null;

        if ($manual->manualable_type == Product::class) {
            //find manual product
            $product = $manual->manualable;

            //find manual product features
            $features = $product->features;
        }

        return view('v1.admin.documentation.man_chapters.edit')
            ->with('product', $product)
            ->with('features', $features)
            ->with('manual', $manual)
            ->with('chapters', $chapters)
            ->with('chapter', $chapter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreManualChapterPost $request, $id)
    {
        //catch input
//        $manual = $request->input('manual');
        $user = $request->user();
        $feature = $request->input('feature');
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');
        $status = $request->input('status');

        //find chapter
        $chapter = ManualChapter::find($id);

        //find manual
        $manual = $chapter->manual;
        $_title = $manual->title;

        //feature
        $feature = ProductFeature::find($feature);

        //new manual chapter
        $chapter->user_id = $user->id;
        $chapter->title = $title;
        $chapter->body = $body;
        $chapter->url = $url;
        $chapter->status = $status;

//        dd($feature);

        //success
        if ($feature != null) { //store via features
            $chapter->manual_id = $manual->id;
            if ($feature->chapters()->save($chapter)) {
                return redirect()->back()
                    ->with('success', $title . ' chapter updated successfully.');
            }
        } else { //store via manual
            if ($manual->chapters()->save($chapter)) {
                return redirect()->back()
                    ->with('success', $title . ' chapter updated successfully.');
            }
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed updating chapter ' . $title . '. Please try again!')
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
        $manual = ManualChapter::find($id);

        if ($manual == null)
            abort(404);

        //title
        $title = $manual->title;

        //status
        $status = $manual->status == 1 ? 0 : 1;
        $statusMsg = $status == 1 ? 'Active' : 'Disabled';

        if ($manual->update(['status' => $status]))
            return redirect()->back()
                ->with('success', $title . ' chapter status successfully updated to ' . $statusMsg);

        return redirect()->back()
            ->with('error', 'Failed updating ' . $title . ' chapter status. Try again!');
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $manual = ManualChapter::onlyTrashed()->where('id', $id)->first();

        if ($manual == null)
            abort(404);

        //title
        $title = $manual->title;

        if ($manual->restore())
            return redirect()->back()
                ->with('success', $title . ' chapter successfully restored.');

        return redirect()->back()
            ->with('error', 'Failed restoring ' . $title . ' chapter to manual. Try again!');
    }

    /**
     * Partially Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $manual = ManualChapter::find($id);

        if ($manual == null)
            abort(404);

        //title
        $title = $manual->title;

        if ($manual->delete())
            return redirect()->back()
                ->with('success', $title . ' chapter moved to trash.');

        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' chapter to trash. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = ManualChapter::onlyTrashed()->where('id', $id)->first();

        if ($chapter == null)
            abort(404);

        //title
        $title = $chapter->title;

        if ($chapter->forceDelete())
            return redirect()->back()
                ->with('success', $title . ' chapter deleted completely.');

        return redirect()->back()
            ->with('error', 'Failed deleting ' . $title . ' chapter. Try again!');
    }
}
