@extends('layouts.app')

@section('content')

<section class="section">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-title-block">
                        <h3 class="title">Update a User</h3>
                    </div>
                    <form class="user" action="{{ route('admins.users.update', [
                            'id' => $user->id
                        ]) }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputUsername"
                                placeholder="Username" name="username" value="{{ $user->username}}">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="First Name" name="first_name" value="{{ $user->first_name}}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="exampleLastName"
                                    placeholder="Last Name" name="last_name" value="{{ $user->last_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputAddress"
                                placeholder="Address" name="address" value="{{ $user->address}}">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Email Address" name="email" value="{{ $user->email}}">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="gender" id="gender">
                                <option @if( $user->gender == "Laki-Laki" ) selected="selected" @endif value="Laki-laki">Laki - laki</option>
                                <option @if( $user->gender == "Perempuan" ) selected="selected" @endif value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="roles" id="roles">
                                <option @if( $user->roles == "Admin" ) selected="selected" @endif value="Admin">Admin</option>
                                <option @if( $user->roles == "Owner" ) selected="selected" @endif value="Owner">Owner</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user"
                                    id="exampleInputPassword" name="password" placeholder="Password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user"
                                    id="exampleRepeatPassword" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Update User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection