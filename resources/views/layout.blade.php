<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
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

            <div class="space-x-6 text-white font-medium flex items-center">

                {{-- IF NOT LOGGED IN → SHOW PUBLIC LINKS --}}
                @if (!session()->has('admin'))
                    <a href="/" class="hover:text-gray-200">Home</a>
                    <a href="/how-it-works" class="hover:text-gray-200">How it works</a>
                    <a href="/contact" class="hover:text-gray-200">Contact</a>
                    <a href="/about" class="hover:text-gray-200">About</a>

                    {{-- LOGIN --}}
                    <a href="{{ url('/admin/login') }}" class="hover:text-gray-200">
                        Login
                    </a>
                @else
                    {{-- LOGGED IN (ADMIN) → ONLY SHOW ADMIN LINKS --}}
                    <a href="{{ route('admin.create') }}" class="hover:text-gray-200">
                        Create Procedure
                    </a>

                    <a href="{{ url('/admin') }}" class="hover:text-gray-200">
                        Admin Panel
                    </a>

                    <form action="{{ route('admin.logout') }}" method="GET" class="inline">
                        <button type="submit" class="hover:text-gray-200 cursor-pointer">
                            Logout
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main
        class="
    @if (request()->is('admin/login')) flex items-center justify-center min-h-[calc(100vh-200px)]
    @else
        max-w-6xl mx-auto p-6 my-6 bg-white shadow-lg rounded-lg @endif
        ">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer
        class="bg-gray-800 text-gray-300 text-center py-4
        @if (request()->is('admin/login') || request()->is('contact')) fixed bottom-0 left-0 w-full @endif">
        <p>© {{ date('Y') }} XML Project. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
