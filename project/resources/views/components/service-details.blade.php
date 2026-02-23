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

<div class="max-w-xl mx-auto border rounded-xl shadow-lg bg-white overflow-hidden hover:shadow-2xl transition duration-300">
    
    <!-- Image -->
    <img src="{{ asset('images/services/' . $image) }}" 
         alt="{{ $name }}" 
         class="w-full h-64 object-cover">

    <div class="p-6 space-y-4">

        <!-- Name -->
        <h2 class="text-2xl font-bold text-gray-800">{{ $name }}</h2>

        <!-- Category -->
        @if($category_id)
            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                Category: {{ $category_id }}
            </span>
        @endif

        <!-- Description -->
        @if($description)
            <p class="text-gray-700 text-sm leading-relaxed mt-2">
                {{ $description }}
            </p>
        @endif

        <!-- Contact Info -->
        <div class="space-y-1 text-gray-600 text-sm mt-3">
            @if($email)
                <p><strong>Email:</strong> <a href="mailto:{{ $email }}" class="text-blue-600 hover:underline">{{ $email }}</a></p>
            @endif
            @if($phone)
                <p><strong>Phone:</strong> <a href="tel:{{ $phone }}" class="text-blue-600 hover:underline">{{ $phone }}</a></p>
            @endif
            @if($address)
                <p><strong>Address:</strong> {{ $address }}</p>
            @endif
        </div>

        <!-- Levels -->
        <div class="grid grid-cols-3 gap-4 mt-4 text-center">
            @if($noise_level)
                <div class="bg-gray-100 rounded p-2">
                    <p class="text-gray-500 text-xs">Noise</p>
                    <p class="font-semibold">{{ $noise_level }}</p>
                </div>
            @endif
            @if($lighting_level)
                <div class="bg-gray-100 rounded p-2">
                    <p class="text-gray-500 text-xs">Lighting</p>
                    <p class="font-semibold">{{ $lighting_level }}</p>
                </div>
            @endif
            @if($crowd_level)
                <div class="bg-gray-100 rounded p-2">
                    <p class="text-gray-500 text-xs">Crowd</p>
                    <p class="font-semibold">{{ $crowd_level }}</p>
                </div>
            @endif
        </div>

        <!-- Autism Friendly Hours -->
        @if($autism_friendly_hours)
            <div class="mt-4">
                <p class="text-gray-500 text-xs">Autism Friendly Hours:</p>
                <p class="font-medium text-gray-800">{{ $autism_friendly_hours }}</p>
            </div>
        @endif

    </div>
</div>