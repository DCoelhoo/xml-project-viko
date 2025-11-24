@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow rounded">
    <h1 class="text-2xl font-bold mb-6">Edit Procedure</h1>

    <form action="{{ url('/admin/update/' . $procedure->code) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="font-semibold">Code</label>
            <input class="w-full p-2 border rounded bg-gray-100" value="{{ $procedure->code }}" disabled>
        </div>

        <div>
            <label class="font-semibold">Title</label>
            <input name="title" class="w-full p-2 border rounded" value="{{ $procedure->title }}" required>
        </div>

        <div>
            <label class="font-semibold">Category</label>
            <input name="category" class="w-full p-2 border rounded" value="{{ $procedure->category }}">
        </div>

        <div>
            <label class="font-semibold">Duration (minutes)</label>
            <input name="duration" class="w-full p-2 border rounded" value="{{ $procedure->duration }}" required>
        </div>

        <div>
            <label class="font-semibold">Description</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="4">{{ $procedure->description }}</textarea>
        </div>

        <div>
            <label class="font-semibold">Requirements</label>
            <textarea name="requirements" class="w-full p-2 border rounded" rows="3">{{ $procedure->requirements }}</textarea>
        </div>

        <div>
            <label class="font-semibold">Level</label>
            <input name="level" class="w-full p-2 border rounded" value="{{ $procedure->level }}">
        </div>

        <div>
            <label class="font-semibold">Equipment</label>
            <textarea name="equipment" class="w-full p-2 border rounded" rows="3">{{ $procedure->equipment }}</textarea>
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Save Changes
        </button>
    </form>
</div>
@endsection