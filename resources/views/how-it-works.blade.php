@extends('layout')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- TITLE -->
        <h1 class="text-4xl font-bold text-center mb-10 mt-6">
            How This Application Works
        </h1>

        <!-- INTRO -->
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
            This platform allows administrators to manage training procedures easily and efficiently.
            Using the secure admin panel, you can upload XML files, create new procedures,
            edit existing ones, delete outdated records, and view analytics such as category distribution,
            average duration, and activity over time.
        </p>

        <!-- FEATURES -->
        <div class="bg-white shadow p-6 rounded-lg mb-10">
            <h2 class="text-2xl font-semibold mb-4">What you can do as an Admin:</h2>

            <ul class="list-disc ml-6 space-y-2 text-gray-700">
                <li>Upload XML files containing procedure data</li>
                <li>Create new procedures manually</li>
                <li>Edit procedure name, duration, and category</li>
                <li>Delete outdated or incorrect procedures</li>
                <li>View statistics like total procedures, average duration, and categories count</li>
                <li>See graphical insights about categories and trends over time</li>
                <li>Automatic logout after inactivity for increased security</li>
            </ul>
        </div>

        <!-- IMAGE PREVIEW -->
        <div class="bg-white p-6 rounded-xl shadow text-center mb-10">
            <h2 class="text-2xl font-semibold mb-4">Admin Dashboard Preview</h2>
            <p class="text-gray-600 mb-4">Here is an example of what the admin dashboard looks like:</p>

            <img src="{{ asset('images/dashboard-example.png') }}" alt="Dashboard Preview"
                class="rounded-lg shadow-lg mx-auto">
        </div>

        <!-- CALL TO ACTION -->
        <div class="text-center mt-12">
            <a href="{{ route('admin.login') }}"
                class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg shadow hover:bg-blue-700 transition">
                Go to Admin Login
            </a>
        </div>

    </div>
@endsection
