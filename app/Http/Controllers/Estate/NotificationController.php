<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Company\CompanyApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{

    /**
     * NotificationController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * NotificationController index.
     */
    public function index($id)
    {
        //get app
        $app = CompanyApp::find($id);

        //check app
        if($app == null)
            abort(403);

        //authorize
        $this->authorize('view', $app);

        //notifications
        $notifications = $app->notifications()->paginate();

        return view('v1.estates.notifications.index')
            ->with('app', $app)
            ->with('_notifications', $notifications);

    }

    /**
     * NotificationController view.
     */

    /**
     * NotificationController toggleRead.
     */

    /**
     * NotificationController delete.
     */

}
