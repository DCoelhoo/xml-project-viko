@extends('layout')
@section('content')

<!-- HERO SECTION -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-24">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h1 class="text-4xl md:text-5xl font-extrabold mb-6">
            Procedure & Training Information Hub
        </h1>

        <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
            Explore, search, and learn from a structured collection of procedures
            and training descriptions—powered by XML technology.
        </p>

        <div class="mt-10">
            <a href="{{ url('/procedures') }}"
               class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-50">
                Browse Procedures
            </a>
        </div>

    </div>
</section>


<!-- FEATURES -->
<section class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center mb-12">What You Can Do</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- CARD 1 -->
            <div class="bg-white shadow rounded-xl p-8 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">
                    📄
                </div>
                <h3 class="text-xl font-bold mb-3">Browse Procedures</h3>
                <p class="text-gray-600">
                    View all training and procedure descriptions in a clean and organized interface.
                </p>
            </div>

            <!-- CARD 2 -->
            <div class="bg-white shadow rounded-xl p-8 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">
                    🔍
                </div>
                <h3 class="text-xl font-bold mb-3">Search & Filter</h3>
                <p class="text-gray-600">
                    Quickly find procedures by category, duration, or keywords.
                </p>
            </div>

            <!-- CARD 3 -->
            <div class="bg-white shadow rounded-xl p-8 hover:shadow-lg transition">
                <div class="text-blue-600 text-4xl mb-4">
                    🗂️
                </div>
                <h3 class="text-xl font-bold mb-3">XML Powered</h3>
                <p class="text-gray-600">
                    All content is dynamically loaded from an XML structure following the MCDT format.
                </p>
            </div>

        </div>
    </div>
</section>


<!-- CALL TO ACTION -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto text-center px-6">

        <h2 class="text-3xl font-bold mb-6">
            Ready to explore the procedures?
        </h2>

        <p class="text-gray-600 mb-10">
            Access detailed and structured XML-based data with a simple and modern interface.
        </p>

        <a href="{{ url('/procedures') }}"
           class="bg-blue-600 text-white px-8 py-3 rounded-lg shadow hover:bg-blue-700">
           View Procedures
        </a>

    </div>
</section>

@endsection