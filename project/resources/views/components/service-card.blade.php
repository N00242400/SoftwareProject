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

<div class="w-full h-full" x-data="{ showToast: false }">

    <div class="block w-full h-full">
        <div class="h-full border rounded-xl shadow-md bg-white overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col">

            {{-- Image --}}
            <a href="{{ $link }}">
                <img
                    src="{{ Str::startsWith($image, 'http') ? $image : asset('images/services/' . $image) }}"
                    alt="{{ $name }}"
                    class="w-full h-64 md:h-72 object-cover"
                >
            </a>

            {{-- Content --}}
            <div class="p-6 space-y-3 flex flex-col flex-1">

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

                {{-- Push bottom content down --}}
                <div class="mt-auto">

                    {{-- Favourite Button --}}
                    @auth
                        @php
                            $favourite = $service->favouriteForUser();
                        @endphp

                        <form
                            action="{{ $favourite ? route('favourites.destroy', $favourite) : route('favourites.store') }}"
                            method="POST"
                            onsubmit="showToast = true"
                            class="mt-2"
                        >
                            @csrf

                            @if($favourite)
                                @method('DELETE')
                            @else
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                            @endif

                            <button
                                type="submit"
                                class="w-full px-4 py-2 rounded-lg font-semibold text-sm transition
                                {{ $favourite
                                    ? 'bg-red-50 text-red-600 hover:bg-red-100'
                                    : 'bg-purple-600 text-white hover:bg-purple-700' }}"
                            >
                                {{ $favourite ? 'Remove from favourites' : 'Add to favourites' }}
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

        </div>
    </div>
</div>