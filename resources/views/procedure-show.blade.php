@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8">

    <a href="{{ route('procedures.index') }}"
       class="text-blue-600 hover:underline block mb-6">
        ← Back to Procedures
    </a>

    <h1 class="text-3xl font-bold mb-6">{{ $procedure['title'] }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <h2 class="font-semibold text-gray-700">Code</h2>
            <p class="mb-4">{{ $procedure['code'] }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Category</h2>
            <p class="mb-4">{{ $procedure['category'] }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Duration</h2>
            <p class="mb-4">{{ $procedure['duration'] }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Level</h2>
            <p class="mb-4">{{ $procedure['level'] ?: '—' }}</p>
        </div>

        <div class="md:col-span-2">
            <h2 class="font-semibold text-gray-700">Description</h2>
            <p class="mb-4 whitespace-pre-line">{{ $procedure['description'] }}</p>
        </div>

        <div class="md:col-span-2">
            <h2 class="font-semibold text-gray-700">Requirements</h2>
            <p class="mb-4 whitespace-pre-line">{{ $procedure['requirements'] }}</p>
        </div>

        <div class="md:col-span-2">
            <h2 class="font-semibold text-gray-700">Equipment</h2>
            <p class="mb-4 whitespace-pre-line">{{ $procedure['equipment'] }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Last Updated</h2>
            <p>{{ $procedure['updated_at'] ?: '—' }}</p>
        </div>

    </div>

</div>
@endsection