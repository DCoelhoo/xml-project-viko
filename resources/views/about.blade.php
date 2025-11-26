@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto px-6">

    <!-- HEADER -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">About This Platform</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            This website was developed as part of a training project focused on web development,
            XML data integration, and the creation of dynamic, responsive interfaces using modern technologies.
        </p>
    </div>


    <!-- CARDS SECTION -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-20">

        <div class="bg-white p-8 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Project Goal</h3>
            <p class="text-gray-600">
                The main objective of this project is to provide a simple and intuitive way to browse,
                search and visualize training procedures stored in an XML structure.
                The system reads, filters and displays the data dynamically in a user-friendly format.
            </p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Technologies Used</h3>
            <p class="text-gray-600">
                This project was built with Laravel, PHP and TailwindCSS.
                It also includes an XML-based data source and a small admin interface for managing procedures.
                The goal was to practice full-stack development principles.
            </p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-3">Learning Outcomes</h3>
            <p class="text-gray-600">
                Throughout the development of this project, skills such as XML parsing,
                backend logic, route handling, responsive design and CRUD operations were practiced
                and consolidated.
            </p>
        </div>

    </div>


    <!-- BIG BANNER -->
    <div class="bg-blue-600 text-white p-10 rounded-2xl shadow text-center mb-20">
        <h2 class="text-2xl font-bold mb-3">A Simple and Efficient Training Procedure Explorer</h2>
        <p class="text-blue-100 max-w-2xl mx-auto">
            This platform demonstrates how structured data can be organized and visualized in a modern
            web application. It combines both backend logic and frontend design into an integrated experience.
        </p>
    </div>

</div>
@endsection