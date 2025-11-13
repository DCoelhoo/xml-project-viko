@extends('layout')

@section('content')
<h1 class="text-3xl font-bold mb-6">Procedures</h1>

<!-- Search bar -->
<form method="GET" class="mb-6 flex gap-3">
    <input type="text" name="search" placeholder="Search procedures..."
           value="{{ request('search') }}"
           class="border rounded px-3 py-2 w-64 shadow-sm focus:ring-blue-400 focus:border-blue-400">

    <button class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        Search
    </button>
</form>

<!-- Table -->
<div class="overflow-hidden rounded shadow-lg">
    <table class="w-full border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left border">Code</th>
                <th class="p-3 text-left border">Title</th>
                <th class="p-3 text-left border">Category</th>
                <th class="p-3 text-left border">Duration</th>
            </tr>
        </thead>

        <tbody class="bg-white">
            @forelse ($procedures as $p)
            <tr class="hover:bg-gray-50">
                <td class="p-3 border">{{ $p['code'] }}</td>
                <td class="p-3 border">{{ $p['title'] }}</td>
                <td class="p-3 border">{{ $p['category'] }}</td>
                <td class="p-3 border">{{ $p['duration'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">No procedures found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection