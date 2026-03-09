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
                        : route('favourites.store') }}" method="POST" class="mt-4">
                        @csrf
                        @if($favourite)
                            @method('DELETE')
                        @else
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                        @endif

                        <button type="submit" 
                            class="bg-{{ $favourite ? 'red' : 'blue' }}-500 text-white px-4 py-2 rounded hover:bg-{{ $favourite ? 'red' : 'blue' }}-700 transition">
                            {{ $favourite ? 'Remove from Favourites' : 'Add to Favourites' }}
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