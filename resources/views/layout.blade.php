<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'XML Procedures Project' }}</title>
    @vite('resources/css/app.css')
</head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@yield('scripts')
<body class="bg-gray-100 text-gray-900">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">XML Project</h1>

            <div class="space-x-6 text-white font-medium">
                <a href="/" class="hover:text-gray-200">Home</a>
                <a href="/procedures" class="hover:text-gray-200">Procedures</a>
                <a href="/contact" class="hover:text-gray-200">Contact</a>
                <a href="/about" class="hover:text-gray-200">About</a>

                {{-- LOGIN / ADMIN BUTTONS --}}
                @if (!session()->has('admin'))
                    <a href="{{ url('/admin/login') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Login
                    </a>
                @else
                    <a href="{{ url('/admin') }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Admin Panel
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main class="max-w-6xl mx-auto p-6 my-6 bg-white shadow-lg rounded-lg">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-gray-300 text-center py-4 mt-12">
        <p>© {{ date('Y') }} XML Project. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
