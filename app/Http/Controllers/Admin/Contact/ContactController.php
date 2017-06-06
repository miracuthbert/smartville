<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Models\v1\Contact\ContactMessage;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_string = $request->query->all();
        $sort = $request->sort;
        $from = $request->from;

        //from
        if ($from != null && $sort == "name")
            $messages = ContactMessage::where('name', $from)
                ->orWhere('email', $from)
                ->orderBy('created_at', 'DESC')
                ->paginate();

        if ($sort == "all")
            $messages = ContactMessage::orderBy('created_at', 'DESC')->paginate();

        //trashed
        if ($sort == "trashed")
            $messages = ContactMessage::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate();

        //read
        if ($sort == "read")
            $messages = ContactMessage::where('read_at', '<>', null)->orderBy('created_at', 'DESC')->paginate();

        //unread
        if ($sort == "unread")
            $messages = ContactMessage::where('read_at', null)->orderBy('created_at', 'DESC')->paginate();

        return view('v1.admin.contact.index')
            ->with('query_string', $query_string)
            ->with('sort', $sort)
            ->with('messages', $messages);
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
     * @param  \Illuminate\Http\Request  $request
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

        $message = ContactMessage::find($id);

        $reply = $request->reply;

        if ($message == null)
            abort(404);

        if ($message->read_at == null) {

            //time read
            $when = Carbon::now();

            //update message
            $message->update(['read_at' => $when]);
        }

        return view('v1.admin.contact.view')
            ->with('reply', $reply)
            ->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
