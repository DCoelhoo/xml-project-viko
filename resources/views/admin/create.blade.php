@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow rounded">
    <h1 class="text-2xl font-bold mb-6">Create Procedure</h1>

    <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="font-semibold">Code</label>
            <input name="code" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Title</label>
            <input name="title" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Category</label>
            <input name="category" class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="font-semibold">Duration (minutes)</label>
            <input name="duration" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Description</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="4"></textarea>
        </div>

        <div>
            <label class="font-semibold">Requirements</label>
            <textarea name="requirements" class="w-full p-2 border rounded" rows="3"></textarea>
        </div>

        <div>
            <label class="font-semibold">Level</label>
            <input name="level" class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="font-semibold">Equipment</label>
            <textarea name="equipment" class="w-full p-2 border rounded" rows="3"></textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create
        </button>
    </form>
</div>
@endsection