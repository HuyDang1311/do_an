<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param Request $request Request
     *
     * @return \Illuminate\View\View | \Illuminate\Contracts\View\Factory
     */
    public function __invoke(Request $request)
    {
        return view('index');
    }
}
