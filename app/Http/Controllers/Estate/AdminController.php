<?php

namespace App\Http\Controllers\Estate;

use App\CompanyApp;
use App\CompanyUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * AdminController Get Estate Dashboard.
     */
    public function getDashboard($id)
    {
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //pending bills
        $p_bills = $app->bills()->where('tenant_bills.status', 0)->get();

        //pending rent
        $p_rents = $app->rents()->where('tenant_rents.status', 0)->get();

        return view('v1.estates.dashboard')
            ->with('app', $app)
            ->with('p_bills', $p_bills)
            ->with('p_rents', $p_rents);
    }

    /**
     * AdminController Get Estate Profile.
     */
    public function getProfile($id)
    {
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.profile')
            ->with('app', $app);
    }

    /**
     * AdminController Get Estate Settings.
     */
    public function getSettings($id)
    {
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.settings')
            ->with('app', $app);
    }

    /**
     * CompanyController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app);

        $new_status = $app->status === 1 ? 0 : 1;

        if ($app->update(['status' => $new_status]))
            return redirect()->back()
                ->with('success', $app->company->title . ' ' . $app->product->title . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->company->title . ' ' . $app->product->title . ' status update failed. Try again!');

    }

    /**
     * CompanyController delete.
     */
    public function delete($id)
    {
        //find
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $app->title;

        //update status
        if ($app->update(['status' => 0])) {
            //delete
            if ($app->delete()) {
                return redirect()->back()
                    ->with('success', $title . ' ' . $app->product->title . ' moved to trash successfully.');
            }
        }

        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' ' . $app->product->title . ' to trash. Try again!');
    }

    /**
     * CompanyController restore.
     */
    public function restore($id)
    {
        //find
        $app = CompanyApp::onlyTrashed()->where('id', $id)->first();

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app);

        if ($app->update(['status' => 1])) {
            //restore
            if ($app->restore()) {
                return redirect()->back()
                    ->with('success', $app->title . ' ' . $app->product->title . ' restored successfully.');
            }
        }

        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->title . ' ' . $app->product->title . '. Try again!');
    }

    /**
     * CompanyController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = CompanyApp::onlyTrashed()->where('id', $id)->first();

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'App deletion successful. ' . $title . ' ' . $app->product->title . ' is removed completely!');
        }

        return redirect()->back()
            ->with('error', 'Failed deleting app. ' . $title . ' ' . $app->product->title . '. Try again!');
    }

}
