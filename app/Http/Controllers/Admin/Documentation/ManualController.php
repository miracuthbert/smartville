<?php

namespace App\Http\Controllers\Admin\Documentation;

use App\Http\Requests\Admin\Docs\StoreManualRequest;
use App\Models\v1\Documentation\Manual;
use App\Models\v1\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ManualController extends Controller
{
    /**
     * ManualController constructor.
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
    public function index(Request $request, Manual $manuals)
    {

        $status = $request->status;

        //manuals
        if ($status == null)
            $manuals = $manuals->orderBy('created_at', 'desc')->get();

        //manuals disabled
        if ($status == "disabled")
            $manuals = $manuals->where('status', 0)->orderBy('updated_at', 'desc')->get();

        //manuals active
        if ($status == "active")
            $manuals = $manuals->where('status', 1)->orderBy('updated_at', 'desc')->get();

        //manuals trashed
        if ($status == "trashed")
            $manuals = $manuals->onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        return view('v1.admin.documentation.manual.index')
            ->with('status', $status)
            ->with('_manuals', $manuals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('v1.admin.documentation.manual.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreManualRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManualRequest $request)
    {

        //validate
//        $this->validate($request, [
//            'app' => 'required|exists:products,id',
//            'title' => 'required|unique:manuals|max:255',
//            'url' => 'required|unique:manuals|max:255',
//            'body' => 'required',
//            'status' => 'required|boolean',
//        ]);

        //input
        $stand_alone = $request->input('stand_alone');
        $app = $request->input('app');
        $user = $request->user();
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');
        $status = $request->input('status');

        //product // app
        $product = Product::find($app);

        //new manual
        $manual = new Manual();
        $manual->user_id = $user->id;
        $manual->title = $title;
        $manual->body = $body;
        $manual->url = $url;
        $manual->status = $status;

        if ($stand_alone == 0) {
            if ($product->manuals()->save($manual)) {
                return redirect()->route('manual.index')
                    ->with('success', $title . ' manual created successfully.');
            }
        } else {
            if ($manual->save()) {
                return redirect()->route('manual.index')
                    ->with('success', $title . ' manual created successfully.');
            }
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed creating ' . $title . ' manual. Please try again!')
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

        //manual
        $manual = Manual::find($id);

        //check if null
        if ($manual == null)
            abort(404);

        //chapters
        $chapters = $manual->chapters;

        return view('v1.admin.documentation.manual.show')
            ->with('manual', $manual)
            ->with('chapters', $chapters);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //manual
        $manual = Manual::find($id);

        //product
        $product = $manual->manualable;

        //check if null
        if ($manual == null)
            abort(404);

        //chapters
        $chapters = $manual->chapters;

        return view('v1.admin.documentation.manual.edit')
            ->with('product', $product)
            ->with('manual', $manual)
            ->with('chapters', $chapters);
    }

    /**
     * Update the specified resources pages in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function pages(Request $request)
    {
        $this->validate($request, [
            'index.*' => 'required|integer',
            'manual.*' => 'required|integer',
        ]);

        $success = array();
        $pg = 0;
        $z = 0;

        //index
        $pages = $request->index;

        //manuals
        $manuals = $request->manual;

        //manual count
        $pgc = count($manuals);

        for ($i = 0; $i < $pgc; $i++) {
            $update = Manual::where('id', $manuals[$i])->update(['index' => $pages[$i]]);
            if ($update)
                $pg++;
        }

        if ($pg > 0) {
            $success = array_add($success, $z++, $pg . ' of ' . $pgc . ' page numbers updated.');

            return redirect()->back()
                ->with('bulk_success', $success);
        }

        return redirect()->back()
            ->with('error', 'Failed updating pages.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreManualRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreManualRequest $request, $id)
    {

        //validation successful

        //input
        $app = $request->input('app');
        $user = $request->user();
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');
        $status = $request->input('status');

        //product // app
        $product = Product::find($app);

        //find manual
        $manual = Manual::find($id);

        if ($manual == null)
            abort(404);

        $manual->title = $title;
        $manual->body = $body;
        $manual->url = $url;
        $manual->status = $status;

        if ($product->manuals()->save($manual)) {
            return redirect()->back()
                ->with('success', $title . ' manual updated successfully.');
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed updating ' . $title . ' manual. Please try again!');
    }

    /**
     * Update the specified resource status in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $manual = Manual::find($id);

        if ($manual == null)
            abort(404);

        //title
        $title = $manual->title;

        //status
        $status = $manual->status == 1 ? 0 : 1;
        $statusMsg = $status == 1 ? 'Active' : 'Disabled';

        if ($manual->update(['status' => $status]))
            return redirect()->back()
                ->with('success', $title . ' manual status successfully updated to ' . $statusMsg);

        return redirect()->back()
            ->with('error', 'Failed updating ' . $title . ' manual status. Try again!');
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $manual = Manual::onlyTrashed()->where('id', $id)->first();

        if ($manual == null)
            abort(404);

        //title
        $title = $manual->title;

        if ($manual->restore())
            return redirect()->back()
                ->with('success', $title . ' manual successfully restored.');

        return redirect()->back()
            ->with('error', 'Failed restoring ' . $title . ' manual. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $manual = Manual::find($id);

        if ($manual == null)
            abort(404);

        //title
        $title = $manual->title;

        if ($manual->delete())
            return redirect()->back()
                ->with('success', $title . ' manual moved to trash.');

        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' manual to trash. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manual = Manual::onlyTrashed()->where('id', $id)->first();

        if ($manual == null)
            abort(404);

        //title
        $title = $manual->title;

        if ($manual->forceDelete())
            return redirect()->back()
                ->with('success', $title . ' manual deleted completely.');

        return redirect()->back()
            ->with('error', 'Failed deleting ' . $title . ' manual. Try again!');
    }
}
