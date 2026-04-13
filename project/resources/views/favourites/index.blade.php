<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Favourites
        </h2>
    </x-slot>

    <!-- FULL PAGE BACKGROUND -->
    <div class="min-h-screen bg-gradient-to-b from-purple-100 to-purple-150 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if($favourites->isEmpty())
                <div class="bg-white p-6 shadow-sm sm:rounded-lg text-gray-700">
                    You have no favourites yet.
                </div>
            @else

                <!-- GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach($favourites as $favourite)
                        <div class="relative group">

                            <!-- SERVICE CARD -->
                            <x-service-card 
                                :service="$favourite->service"
                                :name="$favourite->service->name"
                                :image="$favourite->service->image"
                                :description="$favourite->service->description"
                                :link="route('services.show', $favourite->service)"
                                :category="$favourite->service->category->name ?? null"
                                :noise_level="$favourite->service->noise_level"
                                :lighting_level="$favourite->service->lighting_level"
                                :crowd_level="$favourite->service->crowd_level"
                            />

                           

                        </div>
                    @endforeach

                </div>

            @endif

        </div>
    </div>
</x-app-layout>