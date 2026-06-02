@extends('layouts.main')

@section('content')

    @include('toastdisplay')

    <h1 class="h1 mb-3">Welcome, admin!</h1>
    <div class="container">
        <button class="btn btn-primary mb-3" 
        data-bs-toggle="modal" 
        data-bs-target="#staticBackdrop"
        >Add new user <b class="fs-5">+</b></button>
       
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="/adduser" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New user</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="/register" method="POST">

                            @csrf

                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">First Name</label>
                            <input required name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="John Doe">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input required name="email" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>

                            <label for="inputPassword5" class="form-label">Password</label>
                            <input required name="pass" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text">
                                Password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>

                            <label for="inputPassword5" class="form-label">Confirm Password</label>
                            <input required name="confirmpass" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text mb-3">
                            </div>
                            
                            <div class="container-fluid d-flex justify-content-center gx-auto mt-5 mb-2">
                                <a class="btn btn-secondary me-2  w-50" onclick="Clear()">Clear</a>
                                <button class="btn btn-primary w-50">Register</button>
                            </div>
                        </form>
                    
                    </div>
                </div>
                </div>
            </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{$user->id}}">View</button></td>
                </tr>

                <div class="modal fade" id="viewModal{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <form action="/edituser/{{ $user->id }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$user->name}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input required name="name" value="{{$user->name}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="John Doe">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input required name="email" value="{{$user->email}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                </div>

                                <label for="inputPassword5" class="form-label">Password</label>
                                <input required value="{{$user->password}}" name="pass" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                                <div id="passwordHelpBlock" class="form-text">
                                    Password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                </div>

                                <label for="inputPassword5" class="form-label">Confirm Password</label>
                                <input required value="{{$user->password}}" name="confirmpass" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                                <div id="passwordHelpBlock" class="form-text mb-3">
                                </div>
                                
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" onclick="Clear()">Clear</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}" class="btn btn-danger">Delete user</a>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete: {{$user->name}} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           Delete this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="/deleteuser/{{$user->id}}" type="button" class="btn btn-danger">Delete</a>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection