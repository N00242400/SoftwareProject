<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Favourites</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if($favourites->isEmpty())
                <div class="bg-white p-6 shadow-sm sm:rounded-lg text-gray-700">
                    You have no favourites yet.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($favourites as $favourite)
                        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold mb-2">{{ $favourite->service->name }}</h3>
                            <p class="text-gray-600 mb-3">{{ $favourite->service->description }}</p>

                            <p class="text-sm text-gray-500 mb-2">
                                Email: {{ $favourite->service->email }}<br>
                                Phone: {{ $favourite->service->phone }}<br>
                                Address: {{ $favourite->service->address }}
                            </p>

                            {{-- Remove Favourite Button --}}
                            <form action="{{ route('favourites.destroy', $favourite) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                    Remove from Favourites
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>