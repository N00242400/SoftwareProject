@props([
    'name',
    'description',
    'image',
    'email' => null,
    'phone' => null,
    'address' => null,
    'noise_level' => null,
    'lighting_level' => null,
    'crowd_level' => null,
    'autism_friendly_hours' => null,
    'category_id' => null
])

<div class="max-w-xl mx-auto border rounded-xl shadow-lg bg-white overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
    
    <!-- Gradient Accent Bar -->
    <div class="h-1 bg-gradient-to-r from-purple-500 to-purple-700"></div>

    <!-- Image -->

        <img
            src="{{ asset('images/services/' . $image) }}"
            alt="{{ $name }}"
         class="w-full h-64 md:h-72 object-cover">

    <div class="p-6 space-y-4">

        <!-- Name -->
        <h2 class="text-2xl font-bold text-gray-800">{{ $name }}</h2>

        <!-- Category -->
        @if($category_id)
            <span class="inline-block bg-purple-100 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full">
                Category: {{ $category_id }}
            </span>
        @endif

        <!-- Description -->
        @if($description)
            <p class="text-gray-700 text-sm leading-relaxed mt-2">
                {{ Str::limit($description, 150) }}
            </p>
        @endif

        <!-- Contact Info -->
        <div class="space-y-1 text-gray-600 text-sm mt-3">
            @if($email)
                <p class="flex items-center gap-1"><svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v1l-8 5-8-5V4z" /></svg> <a href="mailto:{{ $email }}" class="text-purple-600 hover:underline">{{ $email }}</a></p>
            @endif
            @if($phone)
                <p class="flex items-center gap-1"><svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884l2.99-1.197c.204-.082.43-.053.603.077l2.1 1.758a.5.5 0 01.117.653l-1.197 2.99a.5.5 0 00.11.598l3.978 3.978a.5.5 0 00.598.11l2.99-1.197a.5.5 0 01.653.117l1.758 2.1c.13.173.159.398.077.603l-1.197 2.99a1 1 0 01-.934.606C5.373 19.944.056 14.626.003 8.886a1 1 0 01.606-.934z"/></svg> <a href="tel:{{ $phone }}" class="text-purple-600 hover:underline">{{ $phone }}</a></p>
            @endif
            @if($address)
                <p class="flex items-center gap-1"><svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg> {{ $address }}</p>
            @endif
        </div>

        <!-- Levels -->
        <div class="grid grid-cols-3 gap-3 mt-4 text-center">
            @if($noise_level)
                <div class="bg-purple-50 text-purple-700 rounded-lg p-2">
                    <p class="text-xs">Noise</p>
                    <p class="font-semibold">{{ $noise_level }}</p>
                </div>
            @endif
            @if($lighting_level)
                <div class="bg-yellow-50 text-yellow-700 rounded-lg p-2">
                    <p class="text-xs">Lighting</p>
                    <p class="font-semibold">{{ $lighting_level }}</p>
                </div>
            @endif
            @if($crowd_level)
                <div class="bg-green-50 text-green-700 rounded-lg p-2">
                    <p class="text-xs">Crowd</p>
                    <p class="font-semibold">{{ $crowd_level }}</p>
                </div>
            @endif
        </div>

        <!-- Autism Friendly Hours -->
        @if($autism_friendly_hours)
            <div class="mt-4 bg-purple-50 p-2 rounded">
                <p class="text-xs text-gray-500">Autism Friendly Hours:</p>
                <p class="font-medium text-gray-800">{{ $autism_friendly_hours }}</p>
            </div>
        @endif

    </div>
</div>