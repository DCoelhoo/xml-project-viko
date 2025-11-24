@extends('layout')

@section('content')
<h1 class="text-3xl font-bold mb-6">Procedures</h1>

<!-- Filtros -->
<form method="GET" action="{{ route('procedures.index') }}" class="grid md:grid-cols-5 gap-3 mb-6">
    <input
        type="text"
        name="search"
        placeholder="Search in title/code/category..."
        value="{{ request('search') }}"
        class="border rounded px-3 py-2 w-full shadow-sm focus:ring-blue-400 focus:border-blue-400"
    >

    <input
        type="text"
        name="code"
        placeholder="Code"
        value="{{ request('code') }}"
        class="border rounded px-3 py-2 w-full shadow-sm focus:ring-blue-400 focus:border-blue-400"
    >

    <select
        name="category"
        class="border rounded px-3 py-2 w-full shadow-sm focus:ring-blue-400 focus:border-blue-400"
    >
        <option value="">All categories</option>
        @isset($categories)
            @foreach($categories as $cat)
                <option value="{{ $cat }}" @selected(request('category') === $cat)>
                    {{ $cat }}
                </option>
            @endforeach
        @endisset
    </select>

    <input
        type="number"
        name="min_duration"
        placeholder="Min duration"
        value="{{ request('min_duration') }}"
        class="border rounded px-3 py-2 w-full shadow-sm focus:ring-blue-400 focus:border-blue-400"
    >

    <input
        type="number"
        name="max_duration"
        placeholder="Max duration"
        value="{{ request('max_duration') }}"
        class="border rounded px-3 py-2 w-full shadow-sm focus:ring-blue-400 focus:border-blue-400"
    >

    <div class="md:col-span-5 flex gap-3">
        <button class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Apply filters
        </button>
        <a href="{{ route('procedures.index') }}" class="px-4 py-2 rounded border">
            Clear
        </a>
    </div>
</form>

<!-- Tabela -->
<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border text-left">Code</th>
                <th class="p-3 border text-left">Title</th>
                <th class="p-3 border text-left">Category</th>
                <th class="p-3 border text-left">Duration</th>
                <th class="p-3 border text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($procedures as $p)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $p['code'] }}</td>
                    <td class="p-3 border">{{ $p['title'] }}</td>
                    <td class="p-3 border">{{ $p['category'] ?: '—' }}</td>
                    <td class="p-3 border">{{ $p['duration'] }} min</td>
                    <td class="p-3 border text-right">
                        <a href="{{ route('procedures.show', $p['code']) }}"
                           class="text-blue-600 hover:underline text-sm">
                            View details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        No procedures found with the current filters.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection