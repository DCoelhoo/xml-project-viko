@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto px-6">

    <!-- HEADER -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Contact</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            If you have questions about the project, suggestions for improvement, or simply want to reach out,
            you can use the contact details or the message form below.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- CONTACT DETAILS -->
        <div class="bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-6">Contact Information</h2>

            <p class="text-gray-700 mb-4">
                📍 <strong>Location:</strong><br>
                Training & Development Platform  
                Educational/Institutional Environment
            </p>

            <p class="text-gray-700 mb-4">
                📞 <strong>Phone:</strong><br>
                +351 900 000 000  
                
            </p>

            <p class="text-gray-700 mb-4">
                ✉️ <strong>Email:</strong><br>
                info@training-platform.example
            </p>

            <p class="text-gray-700">
                Feel free to reach out if you'd like to know more about how the system works,
                how the XML structure is handled, or if you want to provide feedback to help 
                improve the platform.
            </p>
        </div>

        <!-- CONTACT FORM -->
        <div class="bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-6">Send a Message</h2>

            <form>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Name</label>
                    <input type="text" class="w-full p-3 border rounded-lg" placeholder="Your name">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="text" class="w-full p-3 border rounded-lg" placeholder="Your email">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Message</label>
                    <textarea class="w-full p-3 border rounded-lg h-32" placeholder="Your message"></textarea>
                </div>

                <button class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                    Send Message
                </button>
            </form>
        </div>

    </div>

</div>
@endsection