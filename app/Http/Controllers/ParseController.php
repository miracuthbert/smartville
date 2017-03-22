<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

use App\Http\Requests;

class ParseController extends Controller
{
    /**
     * ParseController dateParser.
     */
    public function dateParser(Request $request)
    {
        $date = $request->input('date');
        $duration = $request->input('duration');

        $date = Carbon::parse($date);

        $parsed = is_integer($duration) ? $date->addMonths($duration)->toDateString() : $date->addMonth()->toDateString();

        if ($parsed)
            return response()->json(['status' => 1, 'date' => $parsed]);

        return response()->json(['status' => 0, 'message' => 'Failed generating date.']);
    }
}
