<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <h3 class="font-semibold text-lg mb-4">
                        Update Category:
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <form action="{{ route('categories.update', $category) }}" method="POST"
                              class="space-y-4 col-span-1 sm:col-span-2 lg:col-span-1">

                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div>
                                <label class="block font-semibold mb-1">Category Name</label>
                                <input type="text" name="name"
                                       value="{{ $category->name }}"
                                       class="w-full border rounded p-2"
                                       required>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block font-semibold mb-1">Description (optional)</label>
                                <textarea name="description" rows="4"
                                          class="w-full border rounded p-2">{{ $category->description }}</textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-3">
                                <button type="submit"
                                        class="bg-[#9773B3] text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                                    Update Category
                                </button>

                                <a href="{{ route('categories.index') }}"
                                   class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition">
                                    Cancel
                                </a>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>