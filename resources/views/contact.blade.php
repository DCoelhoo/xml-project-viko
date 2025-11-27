@extends('layout')

@section('content')

<div class="min-h-[75vh] flex flex-col justify-start"> 
    {{-- PAGE TITLE --}}
    <h1 class="text-3xl font-bold text-center mb-4">Contact</h1>

    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-10">
        If you have questions about the project, suggestions for improvement, or simply want to reach out,
        you can use the contact details or the message form below.
    </p>

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- LEFT SIDE: CONTACT INFO --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Contact Information</h2>

            <p class="mb-2"><strong>📍 Location:</strong><br>Training & Development Platform<br>Educational Environment</p>
            <p class="mb-2"><strong>📞 Phone:</strong><br>+351 900 000 000</p>
            <p class="mb-2"><strong>📧 Email:</strong><br>info@training-platform.example</p>

            <p class="text-gray-600 mt-4">
                Feel free to reach out if you'd like to know more about how the system works
                or if you want to provide feedback to help improve the platform.
            </p>
        </div>

        {{-- RIGHT SIDE: CONTACT FORM --}}
        <div class="bg-white p-6 rounded shadow">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-xl font-semibold mb-4">Contact Us</h2>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-semibold">Your Name</label>
                    <input type="text" name="name" required class="w-full border-gray-300 rounded p-2 border">
                </div>

                <div>
                    <label class="block font-semibold">Your Email</label>
                    <input type="email" name="email" required class="w-full border-gray-300 rounded p-2 border">
                </div>

                <div>
                    <label class="block font-semibold">Message</label>
                    <textarea name="message" rows="4" required class="w-full border-gray-300 rounded p-2 border"></textarea>
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Send Message
                </button>
            </form>
        </div>

    </div>
</div>

@endsection