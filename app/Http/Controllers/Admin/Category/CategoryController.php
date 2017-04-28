<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Models\v1\Shared\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate();

        return view('v1.admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('v1.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        $title = $request->input('title');
        $details = $request->input('details');
        $type = $request->input('type');
        $parent = $request->input('level');
        $status = $request->input('status');

        $category = new Category();
        $category->title = $title;
        $category->desc = $details;
        $category->parent = $parent;
        $category->status = $status;

        if ($type > 0) {
            $_type = Category::find($type);
            $category->categorable_id = $_type->id;
            $category->categorable_type = $_type->categorable_type;
        } else {
            $category->categorable_type = $type;
        }

        if ($category->save()) {
            return redirect()->route('category.index')->with('success', $title . ' category created successfully.');
        }

        return redirect()->back()->with('error', 'Failed creating category. Try again!')->withInput();
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
        $category = Category::find($id);

        if ($category == null)
            abort(404);

        return view('v1.admin.category.edit')->with('cat', $category);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategoryRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        $title = $request->input('title');
        $details = $request->input('details');
        $type = $request->input('type');
        $parent = $request->input('level');
        $status = $request->input('status');

        $category = Category::find($id);

        if ($category == null)
            abort(401);

        $category->title = $title;
        $category->desc = $details;
        $category->parent = $parent;
        $category->status = $status;

        if ($type > 0) {
            $_type = Category::find($type);
            $category->categorable_id = $_type->id;
            $category->categorable_type = $_type->categorable_type;
        } else {
            $category->categorable_type = $type;
        }

        if ($category->save()) {
            return redirect()->back()->with('success', $title . ' category updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed updating category. Try again!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Category::destroy($id);

        if ($delete)
            return redirect()->back()->with('success', 'Category deleted successfully.');

        return redirect()->back()->with('error', 'Failed deleting category. Try again');
    }
}
