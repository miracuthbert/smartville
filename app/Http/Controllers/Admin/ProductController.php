<?php

namespace App\Http\Controllers\Admin;

use App\Models\v1\Product\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming product create/update request.
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data, $type)
    {
        if ($type === "update") {
            return $validate = Validator::make($data, [
                'name' => 'required|min:3|max:255',
                'summary' => 'required|min:50',
                'description' => 'required',
                'category' => 'required|integer',
                'payment_model' => 'required|integer',
                'app' => 'required|boolean',
                'version_no' => 'numeric',
                'mode' => 'required|boolean',
                'status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                'name' => 'required|unique:products,title|min:3|max:255',
                'summary' => 'required|min:50',
                'description' => 'required',
                'category' => 'required|integer',
                'payment_model' => 'required|integer',
                'app' => 'required|boolean',
                'version_no' => 'numeric',
                'mode' => 'required|boolean',
                'coming_soon' => 'required|boolean',
                'status' => 'required|boolean',
            ]);
        }
    }

    /**
     * ProductController getCreate.
     */
    public function getCreate()
    {
        return view('v1.admin.apps.create');
    }

    /**
     * ProductController store.
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all(), null);

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //catch input
        $ver_no = $request->input('version_no');

        //save
        $product = new Product();
        $product->category_id = $request->input('category');
        $product->monetization_id = $request->input('payment_model');
        $product->title = $request->input('name');
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
     * ----------------------------------------------------------------------------------------------------------------------
     * Apps
     * ----------------------------------------------------------------------------------------------------------------------
     * Rental Management App
     * A full app with rental property manager & grouping; lease manager; billing and invoice service and a tenant panel where tenants can check and keep track of their bills and invoices.
     * A full packaged rental management app.
     * ----------------------------------------------------------------------------------------------------------------------
     * Hostel Management App
     * An app suitable for hostels; with grouping of properties by rooms and beds; coupled with billing and invoice services. Also a tenant dashboard them to view and track their bills, invoices among other services.
     * Suitable for schools and hostel setup properties.
     * ----------------------------------------------------------------------------------------------------------------------
     * Billing Service App
     * A simple billing and invoicing package for real estate owners. Suitable for standalone needs.
     * A standalone billing and invoicing service. Suitable for companies that want to extend their applications.
     */

    /**
     * ProductController getApps.
     */
    public function getApps($sort)
    {
        $index = collect();

        if ($sort == "all") {
            $index = Product::paginate(15);
        } elseif ($sort == "active") {
            $index = Product::where('status', 1)->paginate(15);
        } elseif ($sort == "disabled") {
            $index = Product::where('status', 0)->paginate(15);
        } elseif ($sort == "trashed") {
            $index = Product::onlyTrashed()->paginate(15);
        }

        //uncomment only for debug
//        dd($index);

        return view('v1.admin.apps.index')
            ->with('apps', $index)
            ->with('sort', $sort);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $app = Product::findorFail($id);

        return view('v1.admin.apps.edit')
            ->with('app', $app);
    }

    /**
     * ProductController update.
     */
    public function update(Request $request)
    {
        $validator = $this->validator($request->all(), "update");

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //check
        $product = Product::find($request->input('id'));

        //check if null
        if ($product == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //catch input
        $ver_no = $request->input('version_no');

        //save
        $product->category_id = $request->input('category');
        $product->monetization_id = $request->input('payment_model');
        $product->title = $request->input('name');
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
     * ProductController toggleStatus.
     */
    public function toggleStatus($id)
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
     * ProductController delete.
     */
    public function delete($id)
    {
        //find
        $app = Product::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

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
     * ProductController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = Product::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

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
     * ProductController restore.
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
