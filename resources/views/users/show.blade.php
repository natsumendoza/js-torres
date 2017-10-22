@extends('layouts.layout2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{$message}}</strong>
                            </div>
                        @endif
                        <form class="form-horizontal" method="post" action="{{action('UserController@update', Auth::user()->id)}}">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                <label for="firstName" class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control" name="firstName" value="{{ Auth::user()->first_name }}" required autofocus>

                                    @if ($errors->has('firstName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('middleName') ? ' has-error' : '' }}">
                                <label for="middleName" class="col-md-4 control-label">Middle Name</label>

                                <div class="col-md-6">
                                    <input id="middleName" type="text" class="form-control" name="middleName" value="{{ Auth::user()->middle_name }}" required autofocus>

                                    @if ($errors->has('middleName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('middleName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                <label for="lastName" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control" name="lastName" value="{{ Auth::user()->last_name }}" required autofocus>

                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6">
                                    <select id="gender" type="text" class="form-control" name="gender" value="{{ Auth::user()->gender }}" required autofocus>
                                        <option {{ Auth::user()->gender == 'Male' ? 'selected' : '' }}  value="Male">Male</option>
                                        <option {{ Auth::user()->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phoneNo') ? ' has-error' : '' }}">
                                <label for="phoneNo" class="col-md-4 control-label">Contact No.</label>

                                <div class="col-md-6">
                                    <input id="phoneNo" type="text" class="form-control" name="phoneNo" value="{{ Auth::user()->phone_no }}" required autofocus>

                                    @if ($errors->has('phoneNo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phoneNo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
