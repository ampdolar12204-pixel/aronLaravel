@extends('layouts.main')

@include('toastdisplay')

@section('content')

    <div class="row gx-1">
        
        <div class="container col-lg-4 d-flex flex-column justify-content-center py-2">
            <h1 class="h1 mb-5">Welcome, {{session('user')->name}}!</h1>
            <div class="card py-5">         
                <div class="position-relative mx-auto" style="width: 220px; height: 220px;">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center rounded-circle overflow-hidden border bg-light">
                        @if(session('user')->profile_picture)
                            <img src="{{ asset(session('user')->profile_picture) }}" alt="Profile picture" class="w-100 h-100 object-fit-cover">
                        @else
                            <img src="{{ asset('images/ano.png') }}" alt="Default profile picture" class="w-100 h-100 object-fit-cover">
                        @endif
                    </div>

                    <button class="btn btn-sm btn-primary position-absolute bottom-0 end-0" data-bs-toggle="modal" data-bs-target="#changepicModal">Change</button>
                    
                        
                        <div class="modal fade" id="changepicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    
                                <form action="/updateprofilepicture/{{ session('user')->id }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update profile picture</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="profile" class="form-label">Choose a new profile picture</label>
                                            <input class="form-control" type="file" id="profile" name="profile" accept="image/*" required>
                                            
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                
                                </form>
                                
                                </div>
                            </div>
                        </div>
                </div>
                <p class="text-center mt-3">User ID: {{session('user')->id}}</p>
            </div>
        </div>

        <div class="container col-lg py-2">
            <h1 class="h1 mb-5">{{session('user')->name}}'s Info</h1>
            <div class="container card py-5">
                <form class="px-3" action="/editpersonaluser/{{ session('user')->id }}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input required name="name" value="{{session('user')->name}}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="John Doe">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input required name="email" value="{{session('user')->email}}" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>

                            <label for="current_pass" class="form-label">Current Password</label>
                            <input name="current_pass" type="password" id="current_pass" class="form-control" aria-describedby="currentPasswordHelpBlock" placeholder="Enter your current password">
                            <div id="currentPasswordHelpBlock" class="form-text">
                                Required only when changing your password.
                            </div>

                            <label for="inputPassword5" class="form-label">Password</label>
                            <input name="pass" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Leave blank to keep current password">
                            <div id="passwordHelpBlock" class="form-text">
                                Fill this in only if you want to change the password.
                            </div>

                            <label for="inputPassword5" class="form-label">Confirm Password</label>
                            <input name="confirmpass" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Confirm new password">
                            <div id="passwordHelpBlock" class="form-text mb-3">
                            </div>
                                
                            <a class="btn btn-secondary" onclick="Clear()">Clear</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                       
                    </form>
                </p>
            
            </div>

        </div>
    </div>

@endsection