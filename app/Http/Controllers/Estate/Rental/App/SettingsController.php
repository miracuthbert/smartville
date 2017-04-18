<?php

namespace App\Http\Controllers\Estate\Rental\App;

use App\Models\v1\Company\CompanyApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $app = CompanyApp::find($id);

        //settings
        $settings = $app->settings;

        //default settings
        $default_settings = config('settings.rental_app');

        //debug
//        dd($default_settings);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.settings')
            ->with('default_settings', $default_settings)
            ->with('settings', $settings)
            ->with('app', $app);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
