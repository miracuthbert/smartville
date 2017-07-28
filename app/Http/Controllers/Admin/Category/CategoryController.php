<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Models\v1\Shared\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
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
    public function index()
    {
        $categories = Category::with('categories')->where('parent', 1)->where('status', 1)->paginate();

        return view('v1.admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::where('parent', 1)->where('status', 1)->get();

        return view('v1.admin.category.create')->with('parents', $parents);
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
        $level = $request->input('level');
        $parent = $request->input('parent');
        $status = $request->input('status');
        $features = $request->input('feature');
        $feature_values = $request->input('feature_value');

        $data = array();

        for ($i = 0; $i < count($features); $i++) {
            $item = [
                "name" => $features[$i],
                "type" => strtolower($feature_values[$i]),
            ];
            $data = array_add($data, $i, $item);
        }

        $category = new Category();
        $category->title = $title;
        $category->desc = $details;
        $category->parent = $level;
        $category->features = $data;
        $category->status = $status;

        if ($parent != "none" && $level == 0 && $parent > 0) {
            $_type = Category::find($parent);

            $category->categorable()->associate($_type);
            $category->save();

            return redirect()->route('category.index')->with('success', $title . ' category created successfully.');
        } else {
            //check if associated
            if ($category->categorable) {
                //if true dissociate
                $category->categorable()->dissociate();
            }

            //check if successfully updated
            if ($category->save())
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
        $parents = Category::where('parent', 1)->where('status', 1)->get();

        $category = Category::find($id);

        if ($category == null)
            abort(404);

        return view('v1.admin.category.edit')->with('parents', $parents)->with('cat', $category);

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
        $level = $request->input('level');
        $parent = $request->input('parent');
        $status = $request->input('status');
        $features = $request->input('feature');
        $feature_values = $request->input('feature_value');

        $data = array();

        for ($i = 0; $i < count($features); $i++) {
            $item = [
                "name" => $features[$i],
                "type" => strtolower($feature_values[$i]),
            ];
            $data = array_add($data, $i, $item);
        }

        $category = Category::find($id);

        if ($category == null)
            abort(401);

        $category->title = $title;
        $category->desc = $details;
        $category->parent = $level;
        $category->features = $data;
        $category->status = $status;

        if ($parent != "none" && $level == 0 && $parent > 0) {
            $_type = Category::find($parent);

            $category->categorable()->associate($_type);
            $category->save();

            return redirect()->route('category.index')->with('success', $title . ' category updated successfully.');
        } else {
            //check if associated
            if ($category->categorable) {
                //if true dissociate
                $category->categorable()->dissociate();
            }

            //check if successfully updated
            if ($category->save())
                return redirect()->route('category.index')->with('success', $title . ' category updated successfully.');
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
