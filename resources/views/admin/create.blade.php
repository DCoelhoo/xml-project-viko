@extends('layout')

@section('content')
<h1 class="text-3xl font-bold mb-6">Add New Procedure</h1>

<form method="POST" action="/admin/store" class="space-y-4">
    @csrf

    <div>
        <label>Code:</label>
        <input type="text" name="code" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
        <label>Title:</label>
        <input type="text" name="title" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
        <label>Category:</label>
        <input type="text" name="category" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
        <label>Duration:</label>
        <input type="text" name="duration" class="border px-3 py-2 rounded w-full">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Create
    </button>
</form>
@endsection