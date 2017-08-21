<?php

namespace App\Http\Controllers\Rental\Notification;

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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CompanyApp $app)
    {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyApp $app)
    {
        //check app
        if ($app == null)
            abort(403);

        //authorize
        $this->authorize('update', $app);

        $notification = $app->notifications()->update(['read_at' => Carbon::now()]);

        if ($notification) {
            return back()
                ->withSuccess('All notifications marked as read.');
        }

        return back()
            ->withError('Failed marking notifications as read.');

    }

    /**
     * Update the notification 'read_at' column in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CompanyApp $app
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function toggleRead(Request $request, CompanyApp $app, $id)
    {
        //check app
        if ($app == null)
            abort(403);

        //authorize
        $this->authorize('update', $app);

        $notification = $app->notifications()->where('id', $id)->first();

        if ($notification->read_at != null) {
            return back()
                ->with('success', 'Notification already marked as read.');
        }

        if ($notification->update(['read_at' => Carbon::now()])) {
            return back()
                ->withSuccess('Notification marked as read.');
        }

        return back()
            ->withError('Failed marking notification as read.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param $id
     * @return mixed
     */
    public function delete(Request $request, CompanyApp $app, $id)
    {
        //check app
        if ($app == null)
            abort(403);

        //authorize
        $this->authorize('delete', $app);

        $notification = $app->notifications()->where('id', $id)->first();

        if ($notification->delete()) {
            return back()
                ->withSuccess('Notification deleted.');
        }

        return back()
            ->withError('Failed deleting notification.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
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
                ->withSuccess('All notifications deleted.');
        }

        return back()
            ->withError('Failed deleting notifications. Try again!');
    }
}
