<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Procedures</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white px-6 py-4 shadow-md">
        <div class="flex space-x-6 text-lg font-medium">
            <a href="/" class="hover:text-gray-200">Home</a>
            <a href="/procedures" class="hover:text-gray-200">Procedures</a>
            <a href="/contact" class="hover:text-gray-200">Contact</a>
        </div>
    </nav>

    <!-- Page content -->
    <main class="p-6 max-w-6xl mx-auto">
        @yield('content')
    </main>

</body>
</html>