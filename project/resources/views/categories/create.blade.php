<x-app-layout>

    <div class="max-w-xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-bold mb-4">Create New Category</h1>

        @if(session('success'))
            <p class="text-green-600 mb-3">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <div class="text-red-600 mb-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Category Name:</label>
                <input 
                    type="text" 
                    name="name" 
                    required 
                    value="{{ old('name') }}"
                    class="w-full border rounded px-3 py-2"
                >
            </div>

            <div>
                <label class="block font-semibold mb-1">Description:</label>
                <textarea 
                    name="description"
                    class="w-full border rounded px-3 py-2"
                >{{ old('description') }}</textarea>
            </div>

            <button 
                type="submit"
                class="bg-[#9773B3] text-white px-4 py-2 rounded hover:bg-purple-700 transition"
            >
                Create Category
            </button>
        </form>

    </div>

</x-app-layout>