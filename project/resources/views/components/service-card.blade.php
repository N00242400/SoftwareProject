@props([
    'service',       
    'name' => null,
    'image' => null,
    'description' => null,
    'link' => '#',       
    'category' => null,
    'noise_level' => null,
    'lighting_level' => null,
    'crowd_level' => null
])

<div class="w-full">
    <a href="{{ $link }}" class="block w-full">
        <div class="border rounded-xl shadow-md bg-white overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col">

            <!-- Image -->
            <img src="{{ asset('images/services/' . $image) }}" 
                 alt="{{ $name }}" 
                 class="w-full h-64 md:h-72 object-cover">

            <!-- Content -->
            <div class="p-6 space-y-3 flex flex-col">

                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $name }}</h3>

                    @if($category)
                        <span class="inline-block bg-purple-100 text-purple-700 text-sm font-semibold px-3 py-1 rounded-full mt-1">
                            {{ $category }}
                        </span>
                    @endif

                    @if($description)
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mt-2">
                            {{ Str::limit($description, 180) }}
                        </p>
                    @endif

                    <div class="flex gap-3 mt-3 flex-wrap">
                        @if($noise_level)
                            <span class="bg-purple-50 text-purple-700 text-sm font-semibold px-3 py-1 rounded-full">
                                Noise: {{ $noise_level }}
                            </span>
                        @endif
                        @if($lighting_level)
                            <span class="bg-yellow-50 text-yellow-700 text-sm font-semibold px-3 py-1 rounded-full">
                                Lighting: {{ $lighting_level }}
                            </span>
                        @endif
                        @if($crowd_level)
                            <span class="bg-green-50 text-green-700 text-sm font-semibold px-3 py-1 rounded-full">
                                Crowd: {{ $crowd_level }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Favourite Toggle --}}
                @auth
                    @php
                        $favourite = $service->favouriteForUser();
                    @endphp

<form action="{{ $favourite 
? route('favourites.destroy', $favourite) 
: route('favourites.store') }}" 
method="POST">

@csrf

@if($favourite)
    @method('DELETE')
@else
    <input type="hidden" name="service_id" value="{{ $service->id }}">
@endif

<button type="submit" class="group transition duration-200 hover:scale-110">
    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 24 24"
         class="w-7 h-7 transition group-hover:scale-110"
         fill="{{ $favourite ? '#9773B3' : 'none' }}"
         stroke="#9773B3"
         stroke-width="2">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 21l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                 C13.09 3.81 14.76 3 16.5 3
                 19.58 3 22 5.42 22 8.5
                 c0 3.78-3.4 6.86-8.55 11.18L12 21z"/>
    </svg>
</button>
</form>
                @endauth

                {{-- Admin Controls --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <div class="flex gap-3 mt-4">
                            <a href="{{ route('services.edit', $service) }}" 
                               class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded">
                               Edit
                            </a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth

            </div>
        </div>
    </a>
</div>