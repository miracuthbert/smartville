<?php

namespace App\Http\Controllers\Admin\App;

use App\Http\Requests\Admin\App\StoreAppRequest;
use App\Models\v1\Product\Product;
use App\Models\v1\Shared\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    /**
     * AppController constructor.
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
    public function index($sort)
    {
        $index = collect();

        if ($sort == "all") {
            $index = Product::paginate(15);
        } elseif ($sort == "active") {
            $index = Product::where('status', 1)->paginate();
        } elseif ($sort == "disabled") {
            $index = Product::where('status', 0)->paginate();
        } elseif ($sort == "trashed") {
            $index = Product::onlyTrashed()->paginate();
        }

        return view('v1.admin.apps.index')
            ->with('apps', $index)
            ->with('sort', $sort);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('title', 'LIKE', '%apps%')->firstOrFail();
        $categories = $categories->categories;

        $payments = Category::where('title', 'LIKE', '%monetization%')->firstOrFail();
        $payments = $payments->categories;

        return view('v1.admin.apps.create')
            ->with('categories', $categories)
            ->with('payments', $payments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAppRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppRequest $request)
    {
        //catch input
        $ver_no = $request->input('version_no');

        //save
        $product = new Product();
        $product->category_id = $request->input('category');
        $product->monetization_id = $request->input('payment_model');
        $product->title = $request->input('title');
        $product->slug = $request->input('slug');
        $product->summary = $request->input('summary');
        $product->desc = $request->input('description');
        $product->app = $request->input('app');
        $product->page = $request->input('page');
        $product->version_name = $request->input('version_name');
        $product->version_no = $ver_no != null ? $ver_no : null;
        $product->mode = $request->input('mode');
        $product->coming_soon = $request->input('coming_soon');
        $product->status = $request->input('status');

        if ($product->save()) {
            return redirect()->route('admin.app.view', ['id' => $product->id])
                ->with('success', 'App added successfully. You can now add app features!');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed adding new app. Try again!')
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app = Product::findorFail($id);

        return view('v1.admin.apps.show')
            ->with('app', $app);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $app = Product::findorFail($id);
        $categories = Category::where('title', 'LIKE', '%apps%')->first();
        $categories = $categories->categories;
        $payments = Category::where('title', 'LIKE', '%monetization%')->first();
        $payments = $payments->categories;

        return view('v1.admin.apps.edit')
            ->with('app', $app)
            ->with('categories', $categories)
            ->with('payments', $payments);
    }

    /**
     * Update the specified resource status in storage
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $app = Product::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        if ($app->status == 1)
            $app->status = 0;
        else
            $app->status = 1;

        if ($app->save())
            return redirect()->back()
                ->with('success', $app->title . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->title . ' status update failed. Try again!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAppRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAppRequest $request, $id)
    {

        //check
        $product = Product::findOrFail($request->input('id'));

        //check if null
        if ($product == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.')
                ->withInput();

        //catch input
        $ver_no = $request->input('version_no');

        //save
        $product->category_id = $request->input('category');
        $product->monetization_id = $request->input('payment_model');
        $product->title = $request->input('title');
        $product->slug = $request->input('slug');
        $product->summary = $request->input('summary');
        $product->desc = $request->input('description');
        $product->page = $request->input('page');
        $product->version_name = $request->input('version_name');
        $product->version_no = $ver_no != null ? $ver_no : null;
        $product->mode = $request->input('mode');
        $product->coming_soon = $request->input('coming_soon');
        $product->status = $request->input('status');

        if ($product->save()) {
            return redirect()->back()
                ->with('success', $product->title . ' updated successfully!');
        }

        return redirect()->back()
            ->with('error', 'Failed updating ' . $product->title . '. Try again!')
            ->withInput();
    }

    /**
     * Partially Remove the specified resource from storage
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //find
        $app = Product::findOrFail($id);

        //title
        $title = $app->title;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', $title . ' moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' to trash. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find
        $app = Product::onlyTrashed()->where('id', $id)->firstOrFail();

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'App deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting app. Try again!');
    }

    /**
     * Restore the specified resource in storage
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //find
        $app = Product::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //restore
        if ($app->restore()) {
            return redirect()->route('admin.apps', ['sort' => 'all'])
                ->with('success', $app->title . ' restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->title . '. Try again!');
    }

}
