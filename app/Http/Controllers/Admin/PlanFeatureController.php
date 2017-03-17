<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlanFeatureController extends Controller
{

    /**
     * PlanFeatureController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming plan feature create/update request.
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data, $type)
    {
        if ($type === "update") {
            return $validate = Validator::make($data, [
                'feature' => 'required|integer|exists:plan_features,id',
                'price' => 'required|numeric',
                'limit' => 'required|integer',
                'trial' => 'required|boolean',
                'status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                'plan' => 'required|integer|exists:product_plans,id',
                'feature.*' => 'integer|exists:product_features,id',
                'price.*' => 'numeric',
                'limit.*' => 'integer',
                'trial.*' => 'boolean',
                'status.*' => 'boolean',
            ]);
        }
    }

    /**
     * PlanFeatureController store.
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

        $i = 0;
        $success = array();

        //catch input
        $features = $request->input('feature');
        $limit = $request->input('limit');
        $price = $request->input('price');
        $trial = $request->input('trial');
        $status = $request->input('status');
        $_feat = count($features);

        //save feature
        if ($_feat > 0) {
            for ($f = 0; $f < $_feat; $f++) {
                $success = array_add($success, $i++, 'Feature:' . $features[$f]);
                $success = array_add($success, $i++, 'Limit:' . $limit[$f]);
                $success = array_add($success, $i++, 'Price:' . $price[$f]);
                $success = array_add($success, $i++, 'Trial:' . $trial[$f]);
                $success = array_add($success, $i++, 'Status:' . $status[$f]);
            }
        }

        return redirect()->back()
            ->with('bulk_success', $success)
            ->withInput();

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Some error encountered. Failed adding features. Try again!')
            ->withInput();
    }

    /**
     * PlanFeatureController update.
     */

    /**
     * PlanFeatureController toggleStatus.
     */

    /**
     * PlanFeatureController delete.
     */

    /**
     * PlanFeatureController restore.
     */

    /**
     * PlanFeatureController destroy.
     */
}
