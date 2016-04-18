<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $users = User::where('name', '=', $request->input('name'))
//            ->orderBy('email', 'desc')
//            ->get();

        //redirect to Trip Database page 
        return redirect('tripdatabase'); //, compact('users'));
    }

//    public function test(User $user)
//    {
//
//        return 'Hey ' . $user->name;
//    }


}
