@extends('layout')

@section('content')
    {{-- HERO SECTION --}}
    <section class="text-center py-20 px-6 bg-white rounded-lg shadow mb-10">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-6">
            Welcome to the XML Procedures Manager
        </h1>

        <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-8">
            A simple, fast, and secure platform that allows administrators to upload, manage,
            and visualize training procedures directly from XML files — all in one place.
        </p>

        <a href="{{ route('how.it.works') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
            Learn How It Works
        </a>
    </section>


    {{-- FEATURES SECTION --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">

        <div class="bg-white p-8 rounded-lg shadow text-center">
            <h3 class="text-xl font-bold mb-3">📄 Upload XML Files</h3>
            <p class="text-gray-600">
                Import procedure lists instantly using the XML upload tool available on the admin panel.
            </p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow text-center">
            <h3 class="text-xl font-bold mb-3">🛠️ Manage Procedures</h3>
            <p class="text-gray-600">
                Edit, delete, or create new procedures with a clean and easy-to-use interface.
            </p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow text-center">
            <h3 class="text-xl font-bold mb-3">📊 Visual Dashboards</h3>
            <p class="text-gray-600">
                View rich charts showing procedure categories, evolution over time, and statistics.
            </p>
        </div>

    </section>


    {{-- CALL TO ACTION --}}
    <section class="bg-blue-600 text-white py-16 px-6 rounded-lg shadow text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to manage your procedures?</h2>

        <p class="text-lg opacity-90 mb-6">
            Log in to access the full management dashboard.
        </p>

        <a href="{{ route('admin.login') }}"
            class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition">
            Go to Login
        </a>
    </section>
@endsection
