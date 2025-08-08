<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;

class RegisterController extends Controller{
    public function showForm()
    {
        return Inertia::render('Register');}
    public function register(Request $request){
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'password' => 'required|confirmed|min:6',]);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'password' => Hash::make($request->password),]);
        Auth::login($user);
        return redirect()->route('dashboard');}
}

?>