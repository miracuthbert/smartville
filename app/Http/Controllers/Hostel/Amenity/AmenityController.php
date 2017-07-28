<?php

namespace App\Http\Controllers\Hostel\Amenity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmenityController extends Controller
{
    /**
     * AmenityController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $app
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $app)
    {
        //find company app
        $app = CompanyApp::findOrFail($app);

        return view('hostels.amenities.index')
            ->with('app', $app);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $app
     * @return \Illuminate\Http\Response
     */
    public function create($app)
    {
        //find company app
        $app = CompanyApp::findOrFail($app);

        return view('hostels.amenities.create')
            ->with('app', $app);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('hostels.amenities.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('hostels.amenities.edit');
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
