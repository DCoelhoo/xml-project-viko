@extends('layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Admin Panel</h1>

    <a href="/admin/create" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + Add New Procedure
    </a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- UPLOAD XML -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h2 class="text-xl font-semibold mb-4">Upload XML File</h2>

        <form action="{{ route('admin.uploadXml') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <input type="file" name="xml_file" accept=".xml" class="border p-2 rounded w-full" required>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Upload XML
            </button>
        </form>
    </div>

    <!-- TABLE -->
    <table class="w-full border-collapse bg-white rounded shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border">Code</th>
                <th class="p-3 border">Title</th>
                <th class="p-3 border">Category</th>
                <th class="p-3 border">Duration</th>
                <th class="p-3 border">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($procedures->items() as $p)
                <tr>
                    <td class="p-3 border">{{ $p['code'] }}</td>
                    <td class="p-3 border">{{ $p['title'] }}</td>
                    <td class="p-3 border">{{ $p['category'] }}</td>
                    <td class="p-3 border">{{ $p['duration'] }}</td>

                    <td class="p-3 border flex gap-3">
                        <a class="text-blue-600 hover:underline" href="/admin/edit/{{ $p['code'] }}">Edit</a>

                        <form method="POST" action="/admin/delete/{{ $p['code'] }}">
                            @csrf
                            <button class="text-red-600 hover:underline" onclick="return confirm('Delete this?')">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $procedures->links() }}
    </div>

    <!-- DASHBOARD -->
    <div class="grid grid-cols-3 gap-6 mb-10 mt-10">

        <div class="bg-white p-6 shadow rounded">
            <h3 class="font-semibold text-lg">Total Procedures</h3>
            <p class="text-3xl mt-3">{{ $stats['total'] }}</p>
        </div>

        <div class="bg-white p-6 shadow rounded">
            <h3 class="font-semibold text-lg">Average Duration</h3>
            <p class="text-3xl mt-3">{{ $stats['avgDuration'] }} min</p>
        </div>

        <div class="bg-white p-6 shadow rounded">
            <h3 class="font-semibold text-lg">Categories</h3>
            <canvas id="categoryChart"></canvas>
        </div>

    </div>

    <!-- CHART -->
    <script>
        const catLabels = @json(array_keys($stats['byCategory']->toArray()));
        const catCounts = @json(array_values($stats['byCategory']->toArray()));

        new Chart(document.getElementById('categoryChart'), {
            type: 'pie',
            data: {
                labels: catLabels,
                datasets: [{
                    data: catCounts,
                    backgroundColor: ["#4F46E5","#16A34A","#DC2626","#F59E0B","#0EA5E9"]
                }]
            }
        });
    </script>
@endsection