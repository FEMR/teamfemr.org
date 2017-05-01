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
    
}
