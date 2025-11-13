@extends('layout')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Admin Login</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="/admin/login" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Username</label>
            <input type="text" name="username" required
                class="w-full border-gray-300 rounded p-2 border" />
        </div>

        <div>
            <label class="block font-semibold">Password</label>
            <input type="password" name="password" required
                class="w-full border-gray-300 rounded p-2 border" />
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Login
        </button>
    </form>
</div>
@endsection