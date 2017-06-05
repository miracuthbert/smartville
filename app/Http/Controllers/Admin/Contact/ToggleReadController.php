<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Models\v1\Contact\ContactMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToggleReadController extends Controller
{
    /**
     * Update contact message 'email' 'read_at' status in storage
     */
    function __invoke(Request $request)
    {
        $ids = $request->message;

        if ($ids != "all")
            $update = ContactMessage::whereIn('id', $ids)->whereNull('read_at')->update(['read_at' => Carbon::now()]);
        else
            $update = ContactMessage::whereNull('read_at')->update(['read_at' => Carbon::now()]);

        //message
        $msg = count($ids) > 1 || $ids == "all" ? $ids == "all" ? "Unread messages mark as read" : count($ids) . " messages marked as read" : "Message marked as read";

        if ($update)
            return redirect()->back()
                ->with('success', $msg);

        //error
        return redirect()->back()
            ->with('error', $msg);
    }
}
