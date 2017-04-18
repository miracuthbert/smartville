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
    public function index(BugReport $bugReport)
    {
        $bugReport = $bugReport->orderBy('created_at', 'DESC')->paginate();

        return $bugReport;
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
