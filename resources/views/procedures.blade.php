@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- TITLE -->
    <h1 class="text-3xl font-bold mb-6">Procedures</h1>

    <!-- SEARCH + FILTERS -->
    <form method="GET" class="bg-white p-4 rounded-lg shadow mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">

        <!-- Search -->
        <div class="md:col-span-2">
            <label class="text-sm font-semibold text-gray-600">Search</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by title, code, description..."
                   class="w-full border rounded p-2">
        </div>

        <!-- Category -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Category</label>
            <select name="category" class="w-full border rounded p-2">
                <option value="">All</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" @selected(request('category') === $cat)>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Min Duration -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Min Duration</label>
            <input type="number" name="min_duration" value="{{ request('min_duration') }}" class="w-full border rounded p-2">
        </div>

        <!-- Max Duration -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Max Duration</label>
            <input type="number" name="max_duration" value="{{ request('max_duration') }}" class="w-full border rounded p-2">
        </div>

        <div class="md:col-span-4 flex justify-end mt-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Apply Filters
            </button>
        </div>
    </form>

    <!-- RESULTS -->
    @if ($procedures->isEmpty())
        <p class="text-gray-600 text-center">No procedures found.</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($procedures as $p)
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition border border-gray-100">

            <!-- Title -->
            <h2 class="text-xl font-bold mb-2">{{ $p['title'] }}</h2>

            <!-- Category -->
            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mb-3">
                {{ $p['category'] }}
            </span>

            <!-- Code -->
            <p class="text-sm text-gray-600"><strong>Code:</strong> {{ $p['code'] }}</p>

            <!-- Duration -->
            <p class="text-sm text-gray-600"><strong>Duration:</strong> {{ $p['duration'] }} minutes</p>

            <!-- Short Description -->
            @if (!empty($p['description']))
                <p class="text-gray-700 mt-3 text-sm line-clamp-3">
                    {{ $p['description'] }}
                </p>
            @endif

            <!-- Button -->
            <a href="{{ url('/procedures/' . $p['code']) }}"
               class="block mt-4 text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                View Details
            </a>

        </div>
        @endforeach

    </div>
</div>

<!-- Utility for truncating text -->
<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@endsection