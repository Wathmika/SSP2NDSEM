@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Dope Diecast</title>
</head>

<body class="bg-gray-300 min-h-screen flex flex-col justify-between">
    
    <div class="max-w-screen mx-auto mt-6 flex justify-center">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3330.576567113723!2d79.9318653487166!3d6.921015765215893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1737309203818!5m2!1sen!2slk" width="1125" height="480" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <section class="container mx-auto mt-8 grid md:grid-cols-2 gap-4 px-4">
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-lg font-bold">Shop</h3>
            <p class="text-sm">164/3/G, Himbutana Lane, Mulleriyawa</p>
            <p class="text-sm">Phone: +94776892573</p>
            <p class="text-sm">Email: wathmikasilva@gmail.com</p>
        </div>
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-lg font-bold">Office</h3>
            <p class="text-sm">164/3/G, Himbutana Lane, Mulleriyawa</p>
            <p class="text-sm">Phone: +94776892573</p>
            <p class="text-sm">Email: wathmikasilva@gmail.com</p>
        </div>
    </section>
    
    <div class="max-w-screen mx-auto mt-10 px-6 flex flex-col md:flex-row justify-between items-start">
        <div class="w-full md:w-2/3 flex flex-col">
            <h2 class="text-xl font-bold">Drop Us a Line</h2>
            <p class="text-sm mb-4">Your email address will not be published. Required fields are marked *</p>
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" placeholder="First Name" class="p-3 border rounded w-full">
                <input type="text" placeholder="Last Name" class="p-3 border rounded w-full">
                <input type="text" placeholder="Your Phone" class="p-3 border rounded w-full">
                <input type="text" placeholder="Subject" class="p-3 border rounded w-full">
                <textarea placeholder="Message" class="p-3 border rounded w-full col-span-2 h-40"></textarea>
                <button type="submit" class="bg-black text-white px-6 py-3 rounded col-span-2">Send Message</button>
            </form>
        </div>
        <div class="w-full md:w-1/3 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="https://wallpapercave.com/wp/wp10417241.jpg" alt="Car Image" class="border border-gray-300 max-w-full h-auto p-6">
        </div>
    </div>
</body>
@endsection
