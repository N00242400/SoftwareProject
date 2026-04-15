<x-app-layout>

    <div class="min-h-screen bg-gradient-to-b from-purple-100 to-purple-150 py-12">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Messages --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
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

            {{-- Reviews --}}
            <div class="mt-10">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Reviews</h3>

                @foreach($service->reviews as $review)
                    <div class="bg-white p-4 mb-4 rounded-2xl shadow-sm" x-data="{ editing: false }">

                        <p class="font-semibold text-gray-800">
                            {{ $review->user?->name ?? 'Guest' }}
                        </p>

                        {{-- View mode --}}
                        <div x-show="!editing">
                            @if($review->description)
                                <p class="text-gray-600 mt-1">{{ $review->description }}</p>
                            @endif

                            <div class="flex flex-wrap gap-2 mt-2">

                                @if($review->noise_rating)
                                    <span class="px-3 py-1 rounded-full text-xs bg-purple-100 text-purple-700">
                                        Noise: {{ ucfirst($review->noise_rating) }}
                                    </span>
                                @endif

                                @if($review->lighting_rating)
                                    <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                        Lighting: {{ ucfirst($review->lighting_rating) }}
                                    </span>
                                @endif

                                @if($review->crowd_rating)
                                    <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                        Crowd: {{ ucfirst($review->crowd_rating) }}
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- Buttons --}}
                        @auth
                            @if(auth()->id() === $review->user_id || auth()->user()->role === 'admin')
                                <div class="mt-3 flex gap-2" x-show="!editing">

                                    <button 
                                        type="button"
                                        class="bg-[#9773B3] text-white px-3 py-1 rounded-full hover:bg-purple-700 transition"
                                        @click="editing = true"
                                    >
                                        Edit
                                    </button>

                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button 
                                            type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            @endif
                        @endauth

                        {{-- Edit mode --}}
                        <form 
                            action="{{ route('reviews.update', $review) }}" 
                            method="POST"
                            class="mt-3 space-y-2"
                            x-show="editing"
                        >
                            @csrf
                            @method('PUT')

                            <textarea name="description" rows="3" class="border rounded-lg w-full p-2">
                                {{ $review->description }}
                            </textarea>

                            <div class="flex gap-2">
                                <select name="noise_rating" class="border rounded-full p-2 w-full">
                                    <option value="">Noise</option>
                                    <option value="low" {{ $review->noise_rating === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $review->noise_rating === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $review->noise_rating === 'high' ? 'selected' : '' }}>High</option>
                                </select>

                              
                                <select name="lighting_rating" class="border rounded-full p-2 w-full">
                                    <option value="">Lighting</option>
                                    <option value="dim" {{ $review->lighting_rating === 'dim' ? 'selected' : '' }}>Dim</option>
                                    <option value="normal" {{ $review->lighting_rating === 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="bright" {{ $review->lighting_rating === 'bright' ? 'selected' : '' }}>Bright</option>
                                </select>

                                <select name="crowd_rating" class="border rounded-full p-2 w-full">
                                    <option value="">Crowd</option>
                                    <option value="low" {{ $review->crowd_rating === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $review->crowd_rating === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $review->crowd_rating === 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <div class="flex gap-2">
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-1 rounded-full hover:bg-green-600 transition">
                                    Update
                                </button>

                                <button type="button"
                                    class="bg-gray-300 text-gray-700 px-4 py-1 rounded-full"
                                    @click="editing = false">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Add Review --}}
            <div class="mt-10 bg-white p-6 rounded-2xl shadow-sm">
                <h4 class="font-semibold text-lg mb-3">Add a Review</h4>

                <form action="{{ route('reviews.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <textarea name="description" rows="3"
                        class="border rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        placeholder="Write your review..."></textarea>

                    <div class="flex gap-2">
                        <select name="noise_rating" class="border rounded-full p-2 w-full">
                            <option value="">Noise</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>

                        {{-- FIXED --}}
                        <select name="lighting_rating" class="border rounded-full p-2 w-full">
                            <option value="">Lighting</option>
                            <option value="dim">Dim</option>
                            <option value="normal">Normal</option>
                            <option value="bright">Bright</option>
                        </select>

                        <select name="crowd_rating" class="border rounded-full p-2 w-full">
                            <option value="">Crowd</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="bg-[#9773B3] text-white px-4 py-2 rounded-full hover:bg-purple-700 transition font-semibold">
                        Submit Review
                    </button>
                </form>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</x-app-layout>