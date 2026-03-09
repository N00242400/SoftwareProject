<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-purple-100 to-purple-150">
        <div class="relative flex flex-col lg:flex-row items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 py-12 lg:py-16 gap-8">

            <!-- Left side -->
            <div class="flex-1 text-center lg:text-left">
                <h1 class="font-nunito text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 text-[#9773B3]">
                    Find Sensory Friendly Services
                </h1>
                <p class="font-nunito text-lg sm:text-xl mb-6 text-[#9773B3]">
                    Search for places with suitable noise, lighting and crowd levels
                </p>

                <form action="{{ route('services.index') }}" method="GET" class="flex justify-center lg:justify-start mb-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search services..." 
                        class="w-72 sm:w-80 lg:w-96 px-4 py-3 rounded-l-lg border border-gray-300 focus:outline-none">
                    <button type="submit" class="bg-[#9773B3] hover:bg-purple-700 px-6 py-3 rounded-r-lg text-white text-lg">
                        Search
                    </button>
                </form>

                <div class="flex flex-wrap justify-center lg:justify-start gap-3">
                    <a href="{{ route('services.index') }}"
                       class="px-5 py-2 rounded {{ request('category') ? 'bg-gray-200' : 'bg-[#9773B3] text-white hover:bg-purple-700 ' }}">
                        All
                    </a>
                    <!-- loops through all $categories and creates a button for each category -->
                    @foreach($categories as $cat)
                        <a href="{{ route('services.index', ['category' => $cat->id, 'search' => request('search')]) }}"
                           class="px-5 py-2 rounded {{ request('category') == $cat->id ? 'bg-[#9773B3] text-white' : 'bg-gray-200' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Hero Image -->
            <div class="flex-1 flex justify-center lg:justify-end">
                <img src="/images/services/hero.png" alt="Autism friendly illustration" class="w-80 sm:w-96 lg:w-[28rem]">
            </div>

        </div>
    </div>

    <!-- Services Grid Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 -mt-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <x-service-card 
                :service="$service"   
                :name="$service->name"
                :image="$service->image"
                :description="$service->description"
                :link="route('services.show', $service)" 
                :category="$service->category->name ?? null"
                :noise_level="$service->noise_level"
                :lighting_level="$service->lighting_level"
                :crowd_level="$service->crowd_level"
            />
        @endforeach
        </div>
    </div>
</x-app-layout>