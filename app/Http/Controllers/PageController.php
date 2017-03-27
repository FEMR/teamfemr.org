<?php

namespace FEMR\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {

		return view( 'home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function emr()
    {

        return view( 'emr' );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news()
    {

        return view( 'news' );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function slack()
    {

        return view( 'slack' );
    }
}
