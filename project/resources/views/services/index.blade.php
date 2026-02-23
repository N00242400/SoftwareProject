<x-app-layout>
    <x-slot name="header">
        <h2 class ="font-semibold text-xl text-gray-800 leading-tight">
            {{__('All Services')}}

        </h2>

            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflown-hidden shadow0sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class = "font-semibold text-lg mb-4">List of Services:</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($services as $service)
                                <a href =" {{route ('services.show', $service)}}">
                                    <x-service-card
                                        :name="$service->name"
                                        :image="$service->image"
                                        />
                                </a>
                                @endforeach
                            </div>
                        </div>
                     </div>
                 </div>
                </div>
</x-app-layout>




