<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function showLogin(){
        return view('login');
    }

    function showRegister(){
        return view('register');
    }

    function register(Request $request){

        $request->validate([
            'name'=> 'required|required|max:255',
            'email'=> 'required|required|max:255',
            'pass'=> 'required|required|max:255',
            'confirmpass'=> 'required|required|max:255',
        ]);

        if($request->pass != $request->confirmpass){
            return back()->with('error', 'Passwords do not match!');
        }

        if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email is already in use.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->pass)
        ]);

        return back()-> with('success', 'Account created successfully!');
    }

    function login(Request $request){

        $request->validate([
            'email'=> 'required|required|max:255',
            'pass'=> 'required|required|max:255',
        ]);

        //access admin page
        if($request->email === 'admin@admin' && $request->pass === 'admin'){
            session(['user' => 'admin']);
            return redirect('/dashboard')->with('sucess', 'Welcome, admin!');
        }

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->pass, $user->password)){
            return back()->with('error', 'Invalid credentials!');
        }

        session(['user' => $user]);
        return redirect('/home')->with('sucess', 'Welcome, ' . $user->name . '!');
    }

    function logout(){
        session()->forget('user');
        return redirect('/login')->with('success', 'Logged out from account.');
    }

    function showdashboard(){
        $users = User::all();

        return view('dashboard', compact('users'));
    }
    
    function deleteuser($id){
        $user = User::where('id', $id);
        if(!$user){
            return back()->with('error', 'Unable to delete user.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    function edituser(Request $request, $id){
        $request->validate([
            'name'=> 'required|required|max:255',
            'email'=> 'required|required|max:255',
            'pass'=> 'required|required|max:255',
            'confirmpass'=> 'required|required|max:255',
        ]);

        $user = User::where('id', $id)->first();
        if(!$user){
            return back()->with('error', 'Unable to update user.');
        }

        if($request->pass != $request->confirmpass){
            return back()->with('error', 'Passwords must match.');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->pass)
        ]);

        return back()->with('success', 'User successfully added.');
    }

    function showperdashboard(){
        return view('perdashboard');
    }

    function editpersonaluser(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'current_pass' => 'nullable|string|max:255',
        ]);

        $password = trim((string) $request->input('pass'));
        $confirmPassword = trim((string) $request->input('confirmpass'));
        $currentPassword = trim((string) $request->input('current_pass'));
        $passwordFilled = $password !== '';
        $confirmFilled = $confirmPassword !== '';

        if($passwordFilled !== $confirmFilled){
            return back()->with('error', 'Complete both password fields to change password.');
        }

        if($passwordFilled){
            if($currentPassword === ''){
                return back()->with('error', 'Enter your current password to change your password.');
            }

            $request->validate([
                'pass' => 'string|min:8|max:255',
                'confirmpass' => 'string|min:8|max:255',
            ]);

            if($password !== $confirmPassword){
                return back()->with('error', 'Passwords do not match.');
            }
        }

        $user = User::where('id', $id)->first();

        if(!$user){
            return back()->with('error', 'Unable to update profile.');
        }

        if($passwordFilled && !Hash::check($currentPassword, $user->password)){
            return back()->with('error', 'Current password is incorrect.');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($passwordFilled){
            $updateData['password'] = Hash::make($password);
        }

        $user->update($updateData);
        session(['user' => $user->fresh()]);

        return back()->with('success', 'Profile updated successfully.');
    }

    function updateProfilePicture(Request $request, $id){
        $request->validate([
            'profile' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = User::where('id', $id)->first();

        if(!$user){
            return back()->with('error', 'Unable to update profile picture.');
        }

        if($user->profile_picture){
            $existingPath = public_path($user->profile_picture);

            if(file_exists($existingPath)){
                unlink($existingPath);
            }
        }

        $file = $request->file('profile');
        $filename = time() . '_' . uniqid() . '.' . $file->extension();
        $file->move(public_path('images'), $filename);

        $user->update([
            'profile_picture' => 'images/' . $filename,
        ]);

        session(['user' => $user->fresh()]);

        return back()->with('success', 'Profile picture updated successfully.');
    }


}
