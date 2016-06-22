<?php

namespace MPlaneta\Http\Controllers;


use MPlaneta\CargaInfo;
use MPlaneta\Http\Controllers\Controller;

class CargaInfoController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('carga.create');
        //return \View::make('');
    }
}