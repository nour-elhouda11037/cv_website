@extends('layouts.app')

@section('content')
<div>
    <h2>Create account</h2>

    @if ($errors->any())
        @foreach ($errors->all() as $e)
            <p style="color:red">{{ $e }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Username
            <input name="username" value="{{ old('username') }}" required>
        </label><br>

        <label>Your First Name
            <input name="first_name" value="{{ old('first_name') }}" required>
        </label><br>

        <label>Your Last Name
            <input name="last_name" value="{{ old('last_name') }}" required>
        </label><br>

        <label>Your Age
            <input name="age" type="number" value="{{ old('age') }}" required>
        </label><br>

        <label>Email
            <input name="email" type="email" value="{{ old('email') }}" required>
        </label><br>

        <label>Password
            <input name="password" type="password" required>
        </label><br>

        <label>Confirm
            <input name="password_confirmation" type="password" required>
        </label><br>

        <button type="submit">Register</button>

        <p>Already registered?
            <a href="{{ route('login') }}">Log in from here!</a>
        </p>
    </form>
</div>
@endsection