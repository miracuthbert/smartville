<?php

namespace App\Http\Controllers\Support\Test;

use App\Models\Support\BugReport;
use App\Models\v1\Product\ProductFeature;
use App\Notifications\BugReportSentNotification;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BugController extends Controller
{
    /**
     * Holds bug admin route
     *
     * @var $bug_route
     */
    protected $bug_route;

    /**
     * BugController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('v1.support.bugs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('v1.support.bugs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bug' => 'required|max:255',
            'app_feature' => 'required|exists:product_features,id',
            'details' => 'required',
        ]);

        //catch input
        $user = $request->user();
        $bug = $request->input('bug');
        $details = $request->input('details');
        $feature = $request->input('app_feature');
        $_feature = ProductFeature::find($feature);

        //create
        $report = new BugReport();
        $report->title = $bug;
        $report->details = $details;
        $report->user_id = $user->id;

        if ($_feature->bugs()->save($report)) {
            $msg = 'Bug report sent successfully. You\'ll be notified once the issue is addressed!';

            //route
            $this->bug_route = route('bugs.show', ['bug' => $report->id]);

            //delay time
            $when = Carbon::now()->addMinute();

            //users with root status
            $users = UserRole::where('role_id', 1)->where('status', 1)->get();

            foreach ($users as $role) {
                //notify
                $role->user->notify((new BugReportSentNotification($report, $_feature, $user, $role->user, $this->bug_route))
                    ->delay($when));
            }

            return redirect()->back()
                ->with('success', $msg);
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed sending bug report. Please try again!')
            ->withInput();
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
