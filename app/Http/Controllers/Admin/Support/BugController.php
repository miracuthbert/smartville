<?php

namespace App\Http\Controllers\Admin\Support;

use App\Models\Support\BugReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BugReport $bugReport)
    {
        $sort = $request->sort;

        if ($sort == "new")
            $bugReport = $bugReport->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->paginate();
        elseif ($sort == "pending")
            $bugReport = $bugReport->whereNull('solved_at')->orderBy('created_at', 'ASC')->paginate();
        elseif ($sort == "solved")
            $bugReport = $bugReport->whereNotNull('solved_at')->orderBy('created_at', 'DESC')->paginate();
        else
            $bugReport = $bugReport->orderBy('created_at', 'DESC')->paginate();

        return view('v1.admin.bugs.index')->with('rep_bugs', $bugReport);
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
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $notify_id = $request->read;

        if ($notify_id != null) {
            //find notification
            $notification = $request->user()->notifications()->where('id', $notify_id)->first();

            //mark as read
            $notification->read_at == null ? $notification->update(['read_at' => Carbon::now()]) : '';
        }

        $bugReport = BugReport::find($id);

        $feature = $bugReport->buggable;

        return view('v1.admin.bugs.show')
            ->with('feature', $feature)
            ->with('bug', $bugReport);
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
     * Update bug status
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $route = route('bugs.status', ['bug' => $id]);

        $bug = BugReport::findOrFail($id);
        $bug->solved_at = empty($bug->solved_at) ? Carbon::now() : null;

        if ($bug->update())
            return redirect()->back()
                ->with('success', "'" . $bug->title . "'" . " status updated successfully.")
                ->with('link_name', empty($bug->solved_at) ? 'Mark as Solved' : 'Mark as Pending')
                ->with('success_link', $route);
        else
            return redirect()->back()
                ->with('error', "'" . $bug->title . "'" . " status update failed.")
                ->with('link_name', 'Try again!')
                ->with('error_link', $route);
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
