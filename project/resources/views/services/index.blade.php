<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <div class="min-h-screen bg-gradient-to-b from-purple-100 to-purple-150">
    
        <!-- image-->
        <div class="w-full bg-cover bg-center bg-no-repeat py-28 lg:py-36 relative"
        style="background-image: url('/images/services/bg.jpg');">
          
    
            <!-- Content -->
            <div class="relative flex flex-col items-center text-center max-w-4xl mx-auto px-4 gap-8">
    
                <h1 class="font-nunito text-4xl sm:text-5xl lg:text-6xl font-bold text-[#9773B3]">
                    Find Sensory Friendly Services
                </h1>
    
                <p class="font-nunito text-lg sm:text-xl text-[#9773B3] max-w-xl mx-auto">
                    Search for places with suitable noise, lighting and crowd levels
                </p>
    
                <!-- Search -->
                <form action="{{ route('services.index') }}" method="GET" class="flex justify-center">
                    <div class="flex w-72 sm:w-80 lg:w-96 bg-white rounded-full overflow-hidden shadow-md">
    
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search services..."
                            class="flex-1 px-4 py-3 bg-transparent border-none focus:outline-none"
                        >
    
                        <button 
                            type="submit" 
                            class="bg-[#9773B3] hover:bg-purple-700 px-6 py-3 text-white text-sm font-semibold rounded-full m-1"
                        >
                            Search
                        </button>
    
                    </div>
                </form>
    
                <!-- Categories -->
                <div class="flex flex-wrap justify-center gap-3">
    
                    <a href="{{ route('services.index') }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold shadow-sm
                       {{ request('category')
                            ? 'bg-white text-gray-700 hover:bg-purple-700 hover:text-white'
                            : 'bg-[#9773B3] text-white hover:bg-purple-700' }}">
                        All
                    </a>
    
                    @foreach($categories as $cat)
                        <a href="{{ route('services.index', ['category' => $cat->id, 'search' => request('search')]) }}"
                           class="px-5 py-2 rounded-full text-sm font-semibold shadow-sm
                           {{ request('category') == $cat->id
                                ? 'bg-[#9773B3] text-white'
                                : 'bg-white text-gray-700 hover:bg-purple-700 hover:text-white' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
    
                </div>
    
            
    
            </div>
        </div>
    
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 flex items-start gap-8 mt-8">

            <!-- Filters Section -->
            <div class="w-full lg:w-1/4 flex justify-center">
                <div class="w-full max-w-xs bg-white p-5 rounded-2xl shadow-md space-y-4 h-fit sticky top-6">
                    <h3 class="font-bold text-lg mb-2">Sensory Filters</h3>

                    <form method="GET" action="{{ route('services.index') }}" class="space-y-4">

                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">

                        <!-- Noise -->
                        <div>
                            <label class="font-semibold">Noise Level</label>
                            <select name="noise_level" class="border rounded w-full p-2">
                                <option value="">Any</option>
                                <option value="low" {{ request('noise_level') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ request('noise_level') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ request('noise_level') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <!-- Lighting -->
                        <div>
                            <label class="font-semibold">Lighting</label>
                            <select name="lighting_level" class="border rounded w-full p-2">
                                <option value="">Any</option>
                                <option value="dim" {{ request('lighting_level') == 'dim' ? 'selected' : '' }}>Dim</option>
                                <option value="normal" {{ request('lighting_level') == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="bright" {{ request('lighting_level') == 'bright' ? 'selected' : '' }}>Bright</option>
                            </select>
                        </div>

                        <!-- Crowd -->
                        <div>
                            <label class="font-semibold">Crowd Level</label>
                            <select name="crowd_level" class="border rounded w-full p-2">
                                <option value="">Any</option>
                                <option value="low" {{ request('crowd_level') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ request('crowd_level') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ request('crowd_level') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-[#9773B3] text-white px-4 py-2 rounded-full w-full hover:bg-purple-700 transition duration-200 font-semibold">
                            Apply Filters
                        </button>
                    </form>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="w-full lg:w-3/4">
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

        </div> 

        <!-- Pagination -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 mt-6 pb-10">
            <div class="flex justify-center">
                {{ $services->links() }}
            </div>
        </div>

    </div>
</x-app-layout>