<?php

namespace App\Http\Controllers\Admin;

use App\ProductFeature;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductFeatureController extends Controller
{

    /**
     * ProductFeatureController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming feature create/update request.
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data, $type)
    {
        if ($type === "update") {
            return $validate = Validator::make($data, [
                'id' => 'required|exists:product_features,id',
                'feature' => 'required|min:3|max:255',
                'details' => 'required|min:10|max:255',
            ]);
        } else {
            return $validate = Validator::make($data, [
                'app' => 'required|exists:products,id',
                'feature' => 'required|min:3|max:255',
                'details' => 'required|min:10|max:255',
            ]);
        }
    }

    /**
     * ProductFeatureController store.
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all(), null);

        //check for errors
        if ($validator->fails()) {
            return redirect()->json(['status' => 0, 'message' => $validator->errors()]);
        }

        //catch input
        $feature = $request->input('feature');
        $details = $request->input('details');

        //save
        $app = new ProductFeature();
        $app->feature = $feature;
        $app->value = $details;

        if ($app->save()) {
            return redirect()->json([
                'message' => 'Feature added successfully.',
                'status' => 1,
            ]);
        }

        return redirect()->json([
            'message' => 'Some error occured. Failed adding feature. Try again!',
            'status' => 0,
        ]);
    }

    /**
     * ProductFeatureController update.
     */
    public function update(Request $request)
    {
        $validator = $this->validator($request->all(), "update");

        //check for errors
        if ($validator->fails()) {
            return redirect()
                ->json([
                    'status' => 0,
                    'message' => $validator->errors()
                ]);
        }

        //catch input
        $id = $request->input('id');
        $feature = $request->input('feature');
        $details = $request->input('details');

        //check
        $app = ProductFeature::find($id);

        //check if null
        if ($app == null)
            return redirect()
                ->json([
                    'status' => 0,
                    'message', 'You tried to perform an action on an invalid record.',
                ]);

        //save
        $app->feature = $feature;
        $app->value = $details;

        if ($app->save()) {
            return redirect()->json([
                'message' => 'Feature updated successfully.',
                'status' => 1,
            ]);
        }

        return redirect()->json([
            'message' => 'Some error occured. Failed updating feature. Try again!',
            'status' => 0,
        ]);
    }


    /**
     * ProductFeatureController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = ProductFeature::find($id);

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
                ->with('success', $app->feature . ' feature status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->feature . ' feature status update failed. Try again!');

    }
    /**
     * ProductFeatureController delete.
     */
    public function delete($id)
    {
        //find
        $app = ProductFeature::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->feature;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', $title . ' feature moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' feature to trash. Try again!');
    }

    /**
     * ProductFeatureController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = ProductFeature::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->feature;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'App feature deletion successful . ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting app feature. Try again!');
    }

    /**
     * ProductFeatureController restore.
     */
    public function restore($id)
    {
        //find
        $app = ProductFeature::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $app->feature . ' feature restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->feature . ' . Try again!');
    }

}
