<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="font-semibold text-lg mb-6">List of Services:</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($services as $service)

                            <div class="bg-white p-4 rounded-lg shadow">

                                <a href="{{ route('services.show', $service) }}">
                                    <x-service-card
                                        :name="$service->name"
                                        :image="$service->image"
                                        :description="$service->description"
                                    />
                                </a>

                                <!-- Buttons for Admin only -->
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <div class="mt-4 flex flex-row items-center gap-2">

                                            <a href="{{ route('services.edit', $service) }}"
                                               class="bg-orange-300 hover:bg-orange-700 text-gray-700 font-bold py-2 px-4 rounded transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('services.destroy', $service) }}" 
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this service?');"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    @endif
                                @endauth

                            </div>

                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>