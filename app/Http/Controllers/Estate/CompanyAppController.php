<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Company\CompanyApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAppController extends Controller
{

    /**
     * CompanyAppController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * CompanyAppController toggleStatus.
     */
    public function toggleStatus($id)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app);

        $new_status = $app->status === 1 ? 0 : 1;
        
        if($app->update(['status' => $new_status])) {
            return redirect()->back
                ->with('success', '');
        }
    }

    /**
     * CompanyAppController delete.
     */
    public function delete($id)
    {
    }

    /**
     * CompanyAppController restore.
     */
    public function restore($id)
    {
    }

    /**
     * CompanyAppController destroy.
     */
    public function destroy($id)
    {
    }
}
