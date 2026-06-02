@extends('layouts.main')

@section('content')

<div class="container">

    @include('toastdisplay')
    
    
    <h1>Register</h1>

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
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
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
        <p class="text-center fs-6">Already have an account? <a href="{{route('login')}}" class="text-secondary">Login</a>
    </p>
    
    </div>

</div>

@endsection
