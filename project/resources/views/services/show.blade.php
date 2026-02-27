<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Service Details</h2>
    </x-slot>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">

                                @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                    {{-- Service Details --}}
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

                    {{-- Reviews Section --}}
                    <hr class="my-6">

                    <h3 class="font-semibold text-lg mb-4">Reviews:</h3>

                    @foreach($service->reviews as $review)
                        <div class="border p-3 mb-3 rounded-md bg-gray-50">
                            <p class="font-semibold">{{ $review->user?->name ?? 'Guest' }}</p>
                            @if($review->description)
                                <p>{{ $review->description }}</p>
                            @endif
                            <p class="text-sm">
                                Noise: {{ $review->noise_rating ?? 'N/A' }} | 
                                Lighting: {{ $review->lighting_rating ?? 'N/A' }} | 
                                Crowd: {{ $review->crowd_rating ?? 'N/A' }}
                            </p>
                        </div>
                    @endforeach

                    {{-- Add Review Form --}}
                    <h4 class="font-semibold text-md mb-2">Add a Review:</h4>

                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <div>
                            <label for="description" class="block font-medium">Review</label>
                            <textarea name="description" id="description" rows="3" class="border rounded w-full p-2" placeholder="Write your review here..."></textarea>
                        </div>

                        <div class="flex gap-2">
                            <div>
                                <label for="noise_rating" class="block font-medium">Noise</label>
                                <select name="noise_rating" id="noise_rating" class="border rounded p-1 w-full">
                                    <option value="">Select</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div>
                                <label for="lighting_rating" class="block font-medium">Lighting</label>
                                <select name="lighting_rating" id="lighting_rating" class="border rounded p-1 w-full">
                                    <option value="">Select</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div>
                                <label for="crowd_rating" class="block font-medium">Crowd</label>
                                <select name="crowd_rating" id="crowd_rating" class="border rounded p-1 w-full">
                                    <option value="">Select</option>
                                    <option value="dim">Dim</option>
                                    <option value="normal">Normal</option>
                                    <option value="bright">Bright</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Review</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>