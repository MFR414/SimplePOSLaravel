@extends('layouts.app')

@section('content')
    <div class="title-block">
        <h1 class="title">User Management</h1>
        <p class='title-description'>Manage users who will have be able to control all aspects of the application.</p>
    </div>

    @if(Session::has('success_message'))
        <div class="card card-success" style='margin-bottom: 20px'>
            <div class="card-header">
                <div class="header-block">
                    <p class="title" style='color: white'>Success</p>
                </div>
            </div>
            <div class="card-block">
                {{ Session::get('success_message') }}
            </div>
        </div>
    @endif

    @if(Session::has('error_message'))
        <div class="card card-danger" style='margin-bottom: 20px'>
            <div class="card-header">
                <div class="header-block">
                    <p class="title" style='color: white'>Error</p>
                </div>
            </div>
            <div class="card-block">
                {{ Session::get('error_message') }}
            </div>
        </div>
    @endif

    <section class="section">
        <a href="{{ route('admins.users.create') }}" class="btn btn-primary mb-4">Create User</a>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">
                    <div class="card-block">
                        <div class="card-title-block">
                            <h3 class="title">Search Users</h3>
                        </div>
                        <form action="{{ route('admins.users.index') }}" method="GET" style="margin-bottom: 0">
                            @csrf
                            <section>
                                <div class="d-flex flex-row">
                                    <div style="margin-right: 20px; width: 100%">
                                        <div class="form-group" style='margin-bottom: 0'>
                                            <label class="control-label">Username</label>
                                            <input type="text" class="form-control boxed" name="username" value="{{ $search_terms['username'] }}">
                                        </div>
                                    </div>
                                    <div style="margin-right: 20px; width: 100%">
                                        <div class="form-group" style='margin-bottom: 0'>
                                            <label class="control-label">First Name</label>
                                            <input type="text" class="form-control boxed" name="first_name" value="{{ $search_terms['first_name'] }}">
                                        </div>
                                    </div>
                                    <div style="margin-right: 20px; width: 100%">
                                        <div class="form-group" style='margin-bottom: 0'>
                                            <label class="control-label">Last Name</label>
                                            <input type="text" class="form-control boxed" name="last_name" value="{{ $search_terms['last_name'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <button class="btn btn-primary" type="submit" style="width: 100%;margin-top: 32px; height: 38px">Search Users</button>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section mt-2">
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">
                    <div class="card-block">
                        <div class="card-title-block">
                            <h3 class="title">Users</h3>
                        </div>
                        <section>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($users) <= 0)
                                            <tr>
                                                <td colspan="4">No users</td>
                                            </tr>
                                        @else 
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->first_name }}</td>
                                                    <td>{{ $user->last_name }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->roles }}</td>
                                                    <td>
                                                        <a href="{{ route('admins.users.show', [
                                                            'id' => $user->id
                                                        ]) }}" class="btn btn-primary">View</a>
                                                        <a href="{{ route('admins.users.delete', [
                                                            'id' => $user->id
                                                        ]) }}" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            {!! $users->appends($_GET)->links() !!}
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection