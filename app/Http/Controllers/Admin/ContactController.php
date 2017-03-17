<?php

namespace App\Http\Controllers\Admin;

use App\ContactMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * ContactController index.
     */
    public function index($sort)
    {
        //all
        if ($sort == "all")
            $messages = ContactMessage::orderBy('created_at', 'DESC')->paginate(25);

        //trashed
        if ($sort == "trashed")
            $messages = ContactMessage::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(25);

        //read
        if ($sort == "read")
            $messages = ContactMessage::where('read_at', '<>', null)->orderBy('read_at', 'DESC')->paginate(25);

        //unread
        if ($sort == "unread")
            $messages = ContactMessage::where('read_at', null)->orderBy('read_at', 'DESC')->paginate(25);


        return view('v1.admin.contact.index')
            ->with('sort', $sort)
            ->with('messages', $messages);
    }

    /**
     * ContactController message.
     */
    public function message($id, Request $request)
    {
        $message = ContactMessage::find($id);

        $reply = $request->reply;

        if ($message == null)
            abort(404);

        if ($message->read_at == null) {
            //read when
            $when = Carbon::now();
            $message->update(['read_at' => $when]);
        }

        return view('v1.admin.contact.view')
            ->with('reply', $reply)
            ->with('message', $message);
    }

    /**
     * ContactController send.
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|min:3|max:160',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|min:3',
            'message' => 'required|max:2500',
        ], [], [
            'phone' => 'phone number',
        ]);
    }
}
