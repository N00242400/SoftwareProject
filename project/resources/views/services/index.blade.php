<x-app-layout>
    
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-b from-purple-100 to-purple-150">
      <div class="relative flex items-center justify-center py-24 px-4 lg:px-16">
         <div class="max-w-7xl w-full flex flex-col lg:flex-row items-center justify-center">

            <!-- Left side -->
            <div class="flex-1 text-center lg:text-left lg:mr-4">
               <h1 class="font-nunito  lg:text-center text-5xl lg:text-6xl font-bold mb-4 text-[#9773B3]">
                Find Autism Friendly Services
              </h1>
    <p class="font-nunito mb-6  lg:text-center text-lg lg:text-xl text-[#9773B3]">
        Search for places with suitable noise, lighting and crowd levels
    </p>

         <form action="{{ route('services.index') }}" method="GET" class="flex justify-center mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search services..." 
               class="w-80 lg:w-96 px-4 py-3 rounded-l-lg border border-gray-300 focus:outline-none">
        <button type="submit" class="bg-[#9773B3] hover:bg-purple-700 px-6 py-3 rounded-r-lg text-white text-lg">
            Search
        </button>
    </form>

    <!-- Category buttons -->
    <div class="flex flex-wrap justify-center gap-3">
        <a href="{{ route('services.index') }}"
           class="px-5 py-2 rounded {{ request('category') ? 'bg-gray-200' : 'bg-[#9773B3] text-white hover:bg-purple-700 ' }}">
            All
        </a>

        @foreach($categories as $cat)
            <a href="{{ route('services.index', ['category' => $cat->id, 'search' => request('search')]) }}"
               class="px-5 py-2 rounded {{ request('category') == $cat->id ? 'bg-[#9773B3] text-white' : 'bg-gray-200'  }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>
</div>
            <!-- Image -->
            <div class="flex-1 flex justify-center lg:justify-end">
               <img src="/images/services/hero.png" alt="Autism friendly illustration" class="w-96 lg:w-[32rem] ">
            </div>

         </div>
      </div>
  
        <!-- Services-->
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <a href="{{ route('services.show', $service) }}">
                        <x-service-card
                            :name="$service->name"
                            :image="$service->image"
                            :description="$service->description"
                        />
                    </a>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>