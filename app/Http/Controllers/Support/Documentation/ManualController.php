<?php

namespace App\Http\Controllers\Support\Documentation;

use App\Models\v1\Documentation\Manual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Manual $manuals)
    {
        $manuals = $manuals->all();
        
        return view('v1.docs.manual.index');
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

        //manual
        $manual = Manual::where('url', $id)->first();

        //check if null
        if ($manual == null)
            abort(404);

        //chapters
        $chapters = $manual->chapters;

        return view('v1.docs.manual.show')
            ->with('manual', $manual)
            ->with('chapters', $chapters);
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
