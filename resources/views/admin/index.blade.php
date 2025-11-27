@extends('layout')

@section('content')
    {{-- SPACE BELOW FIXED NAVBAR --}}
    <div class="pt-5"></div>

    <div class="max-w-7xl mx-auto py-6 px-4">

        {{-- TITLE --}}
        <h1 class="text-3xl font-bold mb-6">Admin Panel</h1>

        {{-- UPLOAD XML --}}
        <div class="bg-white p-6 shadow rounded mb-10">
            <h2 class="text-xl font-semibold mb-4">Upload XML File</h2>
            <form action="{{ route('admin.uploadXml') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" name="xml_file" class="w-full border-gray-300 rounded mb-4">

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Upload XML
                </button>
            </form>
        </div>


        {{-- TABLE --}}
        <div class="bg-white p-6 shadow rounded mb-6">
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Code</th>
                        <th class="border px-4 py-2 text-left">Title</th>
                        <th class="border px-4 py-2 text-left">Category</th>
                        <th class="border px-4 py-2 text-left">Duration</th>
                        <th class="border px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($procedures as $p)
                        <tr class="border-b">
                            <td class="border px-4 py-2">{{ $p['code'] }}</td>
                            <td class="border px-4 py-2">{{ $p['title'] }}</td>
                            <td class="border px-4 py-2">{{ $p['category'] }}</td>
                            <td class="border px-4 py-2">{{ $p['duration'] }} min</td>

                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.edit', $p['code']) }}"
                                    class="text-blue-600 hover:underline mr-3">Edit</a>

                                <a href="{{ route('admin.delete', $p['code']) }}" class="text-red-600 hover:underline"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- PAGINATION --}}
            <div class="mt-4">
                {{ $procedures->links('vendor.pagination.tailwind-custom') }}
            </div>
        </div>


        {{-- STAT CARDS --}}
        <div class="grid grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="font-semibold text-lg">Total Procedures</h3>
                <p class="text-3xl mt-3">{{ $stats['total'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="font-semibold text-lg">Average Duration</h3>
                <p class="text-3xl mt-3">{{ number_format($stats['avgDuration'], 1) }} min</p>
            </div>

            <div class="bg-white p-6 shadow rounded text-center">
                <h3 class="font-semibold text-lg">Categories</h3>
                <p class="text-3xl mt-3">{{ count($stats['byCategory']) }}</p>
            </div>
        </div>


        {{-- CHARTS --}}

        <div class="grid grid-cols-2 gap-6 mb-10">

            {{-- CATEGORY PIE --}}
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-xl font-semibold mb-4">Procedures by Category</h3>
                <div class="w-full h-96">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            {{-- DURATION OVER TIME --}}
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-xl font-semibold mb-4">Duration over Time</h3>
                <div class="w-full h-96">
                    <canvas id="durationOverTimeChart"></canvas>
                </div>
            </div>

        </div>

    </div>


    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // DATA FROM CONTROLLER
        const categoryData = @json($stats['byCategory']);
        const procedureNames = @json($stats['titles']);
        const procedureDurations = @json($stats['durations']);
        const updatedDates = @json($stats['updatedDates']);

        // PIE
        new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(categoryData),
                datasets: [{
                    data: Object.values(categoryData),
                    backgroundColor: ['#3b82f6', '#16a34a', '#dc2626', '#f59e0b', '#9333ea', '#0ea5e9',
                        '#14b8a6'
                    ]
                }]
            }
        });


        // LINE
        new Chart(document.getElementById('durationOverTimeChart'), {
            type: 'line',
            data: {
                labels: updatedDates,
                datasets: [{
                    label: "Duration",
                    data: procedureDurations,
                    borderColor: '#10b981',
                    tension: 0.3
                }]
            }
        });
    </script>
@endsection
