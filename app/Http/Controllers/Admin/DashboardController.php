<?php

namespace FEMR\Http\Controllers\Admin;

use FEMR\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 * @package FEMR\Http\Controllers\Admin
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    /**
     * A temporary endpoint to tinker with things before deciding where they are going to go
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sandbox()
    {
        return view('admin.dashboard.sandbox');
    }
}
