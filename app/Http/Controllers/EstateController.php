<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EstateController extends Controller
{

    /**
     * EstateController constructor.
     */
    public function __construct()
    {
        $this->middleware('estate.admin');
    }
}
