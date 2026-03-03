<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Review
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reviews.update', $review) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="description" class="block font-medium">Review</label>
                        <textarea name="description" id="description" rows="4" class="border rounded w-full p-2">{{ old('description', $review->description) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <div>
                            <label for="noise_rating" class="block font-medium">Noise</label>
                            <select name="noise_rating" id="noise_rating" class="border rounded p-1 w-full">
                                <option value="">Select</option>
                                <option value="low" {{ old('noise_rating', $review->noise_rating) === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('noise_rating', $review->noise_rating) === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('noise_rating', $review->noise_rating) === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div>
                            <label for="lighting_rating" class="block font-medium">Lighting</label>
                            <select name="lighting_rating" id="lighting_rating" class="border rounded p-1 w-full">
                                <option value="">Select</option>
                                <option value="low" {{ old('lighting_rating', $review->lighting_rating) === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('lighting_rating', $review->lighting_rating) === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('lighting_rating', $review->lighting_rating) === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div>
                            <label for="crowd_rating" class="block font-medium">Crowd</label>
                            <select name="crowd_rating" id="crowd_rating" class="border rounded p-1 w-full">
                                <option value="">Select</option>
                                <option value="dim" {{ old('crowd_rating', $review->crowd_rating) === 'dim' ? 'selected' : '' }}>Dim</option>
                                <option value="normal" {{ old('crowd_rating', $review->crowd_rating) === 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="bright" {{ old('crowd_rating', $review->crowd_rating) === 'bright' ? 'selected' : '' }}>Bright</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Update Review
                        </button>

                        <a href="{{ route('services.show', $review->service_id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>