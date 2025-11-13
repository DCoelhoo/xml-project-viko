@extends('layout')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Procedure</h1>

<form method="POST" action="/admin/update/{{ $procedure->code }}" class="space-y-4">
    @csrf

    <div>
        <label>Title:</label>
        <input type="text" name="title" value="{{ $procedure->title }}"
               class="border px-3 py-2 rounded w-full">
    </div>

    <div>
        <label>Category:</label>
        <input type="text" name="category" value="{{ $procedure->category }}"
               class="border px-3 py-2 rounded w-full">
    </div>

    <div>
        <label>Duration:</label>
        <input type="text" name="duration" value="{{ $procedure->duration }}"
               class="border px-3 py-2 rounded w-full">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Save Changes
    </button>
</form>
@endsection