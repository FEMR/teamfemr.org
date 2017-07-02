@extends('layouts.app')

@section('content')

    <div class="login-box">
        <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="card ">
                <header class="card-header">
                    <p class="card-header-title">
                        Register
                    </p>
                </header>
                <div class="card-content">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="content">

                            <div class="field">
                                <label class="label">Name</label>
                                <p class="control">
                                    <input name="name" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" type="text" value="{{ old('name') }}" required autofocus>
                                </p>
                            </div>
                            @include('auth.components.form-errors', ['field' => 'name', 'type' => 'horizontal'])

                            <div class="field">
                                <label class="label">E-mail</label>
                                <p class="control">
                                    <input name="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="text" value="{{ old('email') }}" required>
                                </p>
                            </div>
                            @include('auth.components.form-errors', ['field' => 'email', 'type' => 'horizontal'])

                            <div class="field">
                                <label class="label">Password</label>
                                <p class="control">
                                    <input name="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" type="password" value="{{ old('password') }}" required>
                                </p>
                            </div>
                            @include('auth.components.form-errors', ['field' => 'password', 'type' => 'horizontal'])

                            <div class="field">
                                <label class="label">Confirm password</label>
                                <p class="control">
                                    <input name="password_confirmation" class="input{{ $errors->has('password-confirm') ? ' is-danger' : '' }}" type="password" value="{{ old('password-confirm') }}" required>
                                </p>
                            </div>
                            @include('auth.components.form-errors', ['field' => 'password-confirm', 'type' => 'horizontal'])

                            <div class="field">

                                <p class="control">
                                    <button class="button is-primary">Register</button>
                                </p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection