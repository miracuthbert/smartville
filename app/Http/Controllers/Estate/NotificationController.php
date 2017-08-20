<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Company\CompanyApp;
use Carbon\Carbon;
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
        if ($app == null)
            abort(403);

        //authorize
        $this->authorize('view', $app);

        //notifications
        $notifications = $app->notifications()->paginate();

        return view('rental.notifications.index')
            ->with('app', $app)
            ->with('_notifications', $notifications);

    }

    /**
     * NotificationController view.
     */


    /**
     * Update the notification 'read_at' column in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function toggleRead(Request $request, $id)
    {
        //get app
        $app = CompanyApp::find($request->app);

        //check app
        if ($app == null)
            abort(403);

        //authorize
        $this->authorize('view', $app);

        $notification = $app->notifications()->where('id', $id)->first();

        if ($notification->read_at != null) {
            return back()
                ->with('success', $notification->data['title'] . ' notification already marked as read!');
        }

        if ($notification->update(['read_at' => Carbon::now()])) {
            return back()
                ->with('success', str_limit($notification->data['title'], 15) . ' notification marked as read!');
        }

        return back()
            ->with('error', 'Failed marking ' . str_limit($notification->data['title'], 15) . ' notification as read!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function delete(Request $request, $id)
    {
        //get app
        $app = CompanyApp::find($request->app);

        //check app
        if ($app == null)
            abort(403);

        //authorize
        $this->authorize('view', $app);

        $notification = $app->notifications()->where('id', $id)->first();

        if ($notification->delete()) {
            return back()
                ->with('success', $notification->data['title'] . ' notification removed!');
        }

        return back()
            ->with('error', 'Failed removing ' . str_limit($notification->data['title'], 15) . ' notification!');

    }

    /**
     * Remove the specified resources from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @return mixed
     */
    public function destroy(Request $request, CompanyApp $app)
    {
        //check app
        if ($app == null)
            abort(403);

        //authorize
        $this->authorize('delete', $app);

        if ($app->notifications()->delete()) {
            return back()
                ->with('success', 'All notifications deleted.');
        }

        return back()
            ->with('error', 'Failed deleting notifications. Try again!');

    }

}
