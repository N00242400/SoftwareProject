<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Service Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Service Details Component --}}
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

                    {{-- Reviews Loop --}}
                    @foreach($service->reviews as $review)
                        <div 
                            class="border p-3 mb-3 rounded-md bg-gray-50 review-item" 
                            data-review-id="{{ $review->id }}" 
                            x-data="{ editing: false }"
                        >
                            <p class="font-semibold">{{ $review->user?->name ?? 'Guest' }}</p>

                            <!-- Review display (view mode) -->
                            <div x-show="!editing" class="review-display">
                                @if($review->description)
                                    <p class="review-text">{{ $review->description }}</p>
                                @endif
                                <p class="text-sm">
                                    Noise: <span class="review-noise">{{ $review->noise_rating ?? 'N/A' }}</span> |
                                    Lighting: <span class="review-lighting">{{ $review->lighting_rating ?? 'N/A' }}</span> |
                                    Crowd: <span class="review-crowd">{{ $review->crowd_rating ?? 'N/A' }}</span>
                                </p>
                            </div>

                            {{-- Edit/Delete buttons --}}
                            @auth
                                @if(auth()->id() === $review->user_id || auth()->user()->role === 'admin')
                                    <div class="mt-2 flex gap-2 review-buttons">
                                        <button 
                                            type="button" 
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 transition" 
                                            @click="editing = true" 
                                            x-show="!editing"
                                        >
                                            Edit
                                        </button>
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this review?');"
                                              x-show="!editing"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth

                            <!-- edit mode -->
                            <form 
                                action="{{ route('reviews.update', $review) }}" 
                                method="POST" 
                                class="inline-edit-form mt-3 space-y-2" 
                                x-show="editing"
                            >
                                @csrf
                                @method('PUT')

                                <textarea name="description" rows="3" class="border rounded w-full p-2">{{ $review->description }}</textarea>

                                <div class="flex gap-2">
                                    <select name="noise_rating" class="border rounded p-1 w-full">
                                        <option value="">Noise</option>
                                        <option value="low" {{ $review->noise_rating === 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ $review->noise_rating === 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ $review->noise_rating === 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                    <select name="lighting_rating" class="border rounded p-1 w-full">
                                        <option value="">Lighting</option>
                                        <option value="low" {{ $review->lighting_rating === 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ $review->lighting_rating === 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ $review->lighting_rating === 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                    <select name="crowd_rating" class="border rounded p-1 w-full">
                                        <option value="">Crowd</option>
                                        <option value="dim" {{ $review->crowd_rating === 'dim' ? 'selected' : '' }}>Dim</option>
                                        <option value="normal" {{ $review->crowd_rating === 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="bright" {{ $review->crowd_rating === 'bright' ? 'selected' : '' }}>Bright</option>
                                    </select>
                                </div>

                                <div class="flex gap-2">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-700 transition">Update</button>
                                    <button 
                                        type="button" 
                                        class="cancel-edit-btn bg-gray-300 text-gray-700 px-4 py-1 rounded hover:bg-gray-400 transition" 
                                        @click="editing = false"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </form>
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
                                <select name="noise_rating" id="noise_rating" class="border rounded p-1 pr-8 w-full">
                                    <option value="">Select</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div>
                                <label for="lighting_rating" class="block font-medium">Lighting</label>
                                <select name="lighting_rating" id="lighting_rating" class="border rounded p-1 pr-8 w-full">
                                    <option value="">Select</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div>
                                <label for="crowd_rating" class="block font-medium">Crowd</label>
                                <select name="crowd_rating" id="crowd_rating" class="border rounded p-1 pr-8 w-full">
                                    <option value="">Select</option>
                                    <option value="dim">Dim</option>
                                    <option value="normal">Normal</option>
                                    <option value="bright">Bright</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Submit Review
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>