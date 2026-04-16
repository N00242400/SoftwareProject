<x-app-layout>

    <div class="min-h-screen bg-gradient-to-b from-purple-100 to-purple-150 py-10">

        <div class="max-w-5xl mx-auto px-4">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#9773B3]">Categories</h1>

                <a href="{{ route('categories.create') }}"
                   class="bg-[#9773B3] text-white px-4 py-2 rounded-full hover:bg-purple-700">
                    + Add Category
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <p class="text-green-600 mb-4">{{ session('success') }}</p>
            @endif

            <!-- Category List -->
            <div class="bg-white rounded-2xl shadow-md divide-y">

                @forelse($categories as $category)
                    <div class="flex justify-between items-center p-4">

                        <!-- Category Info -->
                        <div>
                            <h2 class="font-semibold text-lg">{{ $category->name }}</h2>
                            <p class="text-sm text-gray-500">
                                {{ $category->description ?? 'No description' }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">

                            <!-- Edit -->
                            <a href="{{ route('categories.edit', $category) }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-600">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-full text-sm hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>
                @empty
                    <p class="p-4 text-gray-500">No categories found.</p>
                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>