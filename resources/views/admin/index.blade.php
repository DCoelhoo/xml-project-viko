@extends('layout')

@section('content')
<h1 class="text-3xl font-bold mb-6">Admin Panel</h1>

<a href="/admin/create"
   class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Add New Procedure
</a>

@if(session('success'))
    <p class="text-green-700 mb-4">{{ session('success') }}</p>
@endif

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
        @foreach ($procedures as $p)
        <tr>
            <td class="p-3 border">{{ $p['code'] }}</td>
            <td class="p-3 border">{{ $p['title'] }}</td>
            <td class="p-3 border">{{ $p['category'] }}</td>
            <td class="p-3 border">{{ $p['duration'] }}</td>
            <td class="p-3 border flex gap-3">
                <a href="/admin/edit/{{ $p['code'] }}"
                   class="text-blue-600 hover:underline">Edit</a>

                <form method="POST" action="/admin/delete/{{ $p['code'] }}">
                    @csrf
                    <button class="text-red-600 hover:underline"
                            onclick="return confirm('Delete this?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection