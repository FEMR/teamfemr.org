@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center>Register</center></div>

                    <div class="panel-body">
                        {!!Form::open(array('route'=>'createRegister','id'=>'register','method'=>'post')) !!}
                        <table>
                            <tr>
                                <td>User Name</td>
                                <td>{!! Form::text('username',null,array('id'=>'username')) !!}</td>

                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>{!! Form::password('password',array('id'=>'password','required'))!!}</td>
                            </tr>
                            <tr>
                                <td>Password Confirm</td>
                                <td>
                                    {!! Form::password('confirm_password',array('id'=>'confirm_password','required')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::submit('Register') !!}
                                </td>
                            </tr>
                        </table>
                        {!!Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection