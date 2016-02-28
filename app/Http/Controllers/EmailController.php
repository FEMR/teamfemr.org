<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\User;
class EmailController extends Controller
{
    public function index( )
    {
       /* Mail::send('emails.test', ['name' => 'fEMR Admin'], function($message)
        {
            $message->to('femrsquad@gmail.com','Admin')->from('femrsquad@gmail.com')->subject('Please approve.');
        });*/
        return view('emails.register');
    }
    public function createRegister(Request $request)
    {
        $user=new User;
        $data['name']=$user->name=$request->username;
        $data['email']=$user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->remember_token=str_random(100);
        if ($user->save())
        {
            Mail::send('emails.register',['data'=>$data],function($mail) use ($data){
$               $mail->to($data['email'],$data['name'])->from('femrsquad@gmail.com')->subject('Please Approve');
            });
            return Redirect::to('/');
        }
    }
}
