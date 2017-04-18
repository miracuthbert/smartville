<?php

namespace App\Http\Controllers\Estate\Rental\Billing;

use App\EstateBill;
use App\Notifications\EstateBillingReminder;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Find the companies with billing reminder's today.
     *
     * @param $bills
     */
    public function search()
    {
        //date
        $date = Carbon::now();

        //days in month
        $daysOfMonth = $date->daysInMonth;

        //day of month
        $dayOfMonth = $date->day;

        //days in month
        $lastDayOfMonth = $date->lastOfMonth()->day;

        //Check if today is last day of month
        //if true then get bills with billing reminder
        //greater than the # of days of current month
        //else get bills with reminder set today
        if ($lastDayOfMonth == $dayOfMonth)
            $bills = EstateBill::where('billing_reminder', '>', $daysOfMonth)->where('status', 1)->get();
        else
            $bills = EstateBill::where('billing_reminder', $dayOfMonth)->where('status', 1)->get();

        if (count($bills) > 0)
            $this->notify($bills);
        else
            return response()->json(['status' => 1, 'message' => 'No reminders to send today.']);
    }

    /**
     * Notify the specified company's.
     *
     * @param $bills
     */
    public function notify($bills)
    {
        $when = Carbon::now()->addMinutes(3);

        //loop
        foreach ($bills as $bill) {
            //estate
            $app = $bill->app;

            //notify
            $app->notify((new EstateBillingReminder($app->company, $bill))->delay($when));
        }
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
