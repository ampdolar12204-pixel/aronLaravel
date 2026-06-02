@extends('layouts.main')

@section('content')

@include('toastdisplay')

<div class="container">

    
    <h1>Login</h1>

    <div class="container">
        <form action="/login" method="POST">
            
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input required name="email" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>

            <label for="inputPassword5" class="form-label">Password</label>
            <input required name="pass" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text mb-5">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>
            
            <div class="container-fluid d-flex justify-content-center mb-2">
                <button class="btn btn-lg btn-primary w-50">Login</button>
            </div>
        </form>
        <p class="text-center fs-6">No account yet? <a href="{{route('register')}}" class="text-secondary">Register</a></p>
    
    </div>

</div>

@endsection
