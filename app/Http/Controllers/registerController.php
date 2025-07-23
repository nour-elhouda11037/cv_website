<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required|integer|min:1',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect('/dashboard');
    }
}
?>