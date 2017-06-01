<?php

namespace App\Http\Controllers;

use App\Models\v1\Contact\ContactMessage;
use App\Notifications\ContactMessageNotification;
use App\Models\v1\Product\Product;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * Show the application welcome.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the application services.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        return view('v1.home.services');
    }

    /**
     * Show the application service.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($id)
    {
        $product = Product::find($id);

        if ($product == null)
            abort('404');

        //features
        $features = $product->features()->where('status', 1)->get();

        return view('v1.home.service')
            ->with('product', $product)
            ->with('product_features', $features);
    }

    /**
     * Show the application about.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('v1.home.about');
    }

    /**
     * Show the application contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('v1.home.contact');
    }

    /**
     * Show the application contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:60',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|min:3',
            'subject' => 'required|max:255',
            'message' => 'required|max:2500',
        ], [], [
            'phone' => 'phone number',
        ]);

        //message
        $message = new ContactMessage();
        $message->name = $request->input('name');
        $message->email = $request->input('email');
        $message->phone = $request->input('phone');
        $message->subject = $request->input('subject');
        $message->message = $request->input('message');

        //check if saved
        if ($message->save()) {
            //id
            $id = $message->id;

            //users
            $users = UserRole::where('role_id', 1)->where('status', 1)->get();

            //queue notification
            $when = Carbon::now()->addMinutes(10);

            foreach ($users as $role){
                $role->user->notify((new ContactMessageNotification($message, $role->user))->delay($when));
            }

            return redirect()->back()
                ->with('success', 'Message sent successfully');
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed sending message.')
            ->withInput();
    }
}
