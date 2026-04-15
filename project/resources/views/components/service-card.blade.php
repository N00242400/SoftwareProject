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

    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden flex flex-col h-full">

        {{-- Image --}}
        <a href="{{ $link }}" class="relative">
            <img
                src="{{ asset('images/services/' . $image) }}"
                alt="{{ $name }}"
                class="w-full h-56 object-cover"
            >

            {{-- Category badge --}}
            @if($category)
            <span class="absolute top-3 left-3 bg-white px-3 py-1 rounded-full text-xs font-semibold text-purple-700 shadow-sm border">
                {{ $category }}
            </span>
            @endif
        </a>

        {{-- Content --}}
        <div class="p-5 flex flex-col flex-1">

            {{-- Title --}}
            <h3 class="text-lg font-bold text-gray-900 mb-1">
                {{ $name }}
            </h3>

            {{-- Description --}}
            @if($description)
                <p class="text-gray-600 text-sm leading-relaxed mb-3">
                    {{ Str::limit($description, 100) }}
                </p>
            @endif

            {{-- Sensory badges --}}
            <div class="flex flex-wrap gap-2 mb-4">

                @if($noise_level)
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                        Noise: {{ ucfirst($noise_level) }}
                    </span>
                @endif

                @if($lighting_level)
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                        Lighting: {{ ucfirst($lighting_level) }}
                    </span>
                @endif

                @if($crowd_level)
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                        Crowd: {{ ucfirst($crowd_level) }}
                    </span>
                @endif

            </div>

            {{-- Bottom section --}}
            <div class="mt-auto">

{{-- Favourite Button (AJAX - no page refresh) --}}
{{-- 
AJAX = sending data to the server without refreshing the page.
Here we use fetch() to save/remove favourites in the background,
so the UI updates instantly instead of reloading.
--}}
@auth
<div 
    x-data="{ 
        favourited: {{ $service->favouriteForUser() ? 'true' : 'false' }},
        showMessage: false,
        message: ''
    }"
>

    <button
        @click.prevent="
            fetch(favourited 
                ? '{{ route('favourites.destroy', $service->id) }}'
                : '{{ route('favourites.store') }}',
            {
                method: favourited ? 'DELETE' : 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ service_id: {{ $service->id }} })
            })
            .then(() => {

                // decide message BEFORE flipping state
                message = favourited 
                    ? 'Removed from favourites' 
                    : 'Saved to favourites'

                // toggle state
                favourited = !favourited

                // show message
                showMessage = true

                // hide after 2 seconds
                setTimeout(() => showMessage = false, 2000)
            })
        "

        class="w-full py-2 mt-2 rounded-full text-sm font-semibold transition duration-200"
        :class="favourited 
            ? 'bg-[#9773B3]/20 text-[#9773B3]' 
            : 'bg-[#9773B3] text-white hover:bg-purple-700'"
    >
        <span x-text="favourited ? 'Saved' : 'Save'"></span>
    </button>

    {{-- Success Message --}}
    <p 
        x-show="showMessage"
        x-transition
        x-text="message"
        class="text-xs mt-2 text-center text-green-600"
    ></p>

</div>
@endauth

                {{-- Admin Controls --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <div class="flex gap-2 mt-3">
                            <a href="{{ route('services.edit', $service) }}"
                               class="flex-1 text-center py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded">
                                Edit
                            </a>

                            <form action="{{ route('services.destroy', $service) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded">
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