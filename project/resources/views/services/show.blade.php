<x-app-layout>
    <x-slot name="header">
   
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Service Details:</h3>

                    <x-service-details
                        :name="$service->name"
                        :image="$service->image"
                        :description="$service->description"
                        :email="$service->email"
                        :phone="$service->phone"
                        :address="$service->address"
                        :noise_level="$service->noise_level"
                        :lighting_level="$service->lighting_level"
                        :crowd_level="$service->crowd_level"
                        :autism_friendly_hours="$service->autism_friendly_hours"
                        :category_id="$service->category_id"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>