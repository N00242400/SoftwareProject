<x-app-layout>

        <div class="min-h-screen bg-gradient-to-b from-purple-100 to-purple-150 py-12">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 flex items-start gap-8 mt-8">
    
                {{-- Filters --}}
                <div class="w-full lg:w-1/4 flex justify-center">
                    <div class="w-full max-w-xs bg-white p-5 rounded-2xl shadow-md space-y-4 h-fit sticky top-6">
                        <h3 class="font-bold text-lg mb-2">Filter Favourites</h3>
    
                        <form method="GET" action="{{ route('favourites.index') }}" class="space-y-4">
    
                            {{-- Noise --}}
                            <div>
                                <label class="font-semibold">Noise Level</label>
                                <select name="noise_level" class="border rounded-full w-full p-2">
                                    <option value="">Any</option>
                                    <option value="low" {{ request('noise_level') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ request('noise_level') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ request('noise_level') == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
    
                            {{-- Lighting --}}
                            <div>
                                <label class="font-semibold">Lighting</label>
                                <select name="lighting_level" class="border rounded-full w-full p-2">
                                    <option value="">Any</option>
                                    <option value="dim" {{ request('lighting_level') == 'dim' ? 'selected' : '' }}>Dim</option>
                                    <option value="normal" {{ request('lighting_level') == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="bright" {{ request('lighting_level') == 'bright' ? 'selected' : '' }}>Bright</option>
                                </select>
                            </div>
    
                            {{-- Crowd --}}
                            <div>
                                <label class="font-semibold">Crowd Level</label>
                                <select name="crowd_level" class="border rounded-full w-full p-2">
                                    <option value="">Any</option>
                                    <option value="low" {{ request('crowd_level') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ request('crowd_level') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ request('crowd_level') == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
    
                            {{-- Button --}}
                            <button type="submit"
                                class="bg-[#9773B3] text-white px-4 py-2 rounded-full w-full hover:bg-purple-700 transition font-semibold">
                                Apply Filters
                            </button>
    
                        </form>
                    </div>
                </div>
    
                {{-- Content --}}
                <div class="w-full lg:w-3/4">
    
                    {{-- Error --}}
                    @if(session('error'))
                        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
    
                    {{-- Empty state --}}
                    @if($favourites->isEmpty())
                        <div class="bg-white p-6 rounded-2xl shadow-sm text-center text-gray-600">
                            No favourites match your filters.
                        </div>
                    @else
    
                        {{-- Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    
                            @foreach($favourites as $favourite)
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
                            @endforeach
    
                        </div>
    
                    @endif
    
                </div>
    
            </div>
    
        </div>
    
    </x-app-layout>