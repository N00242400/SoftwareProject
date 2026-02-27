@props([
    'action', 'method' => 'POST', 'categories' => [], 'service' => null  ])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

{{--
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded">
        <strong>There were some problems:</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
--}}

    {{-- name form --}}
    <div class="mb-4">
        <label for="name" class="block text-sm text-gray-700">Name</label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $service->name ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        />
        @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- description form --}}
    <div class="mb-4">
        <label for="description" class="block text-sm text-gray-700">Description</label>
        <textarea
            name="description"
            id="description"
            rows="4"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        >{{ old('description', $service->description ?? '') }}</textarea>
        @error('description')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

        {{-- image form --}}
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Service image</label>
        <input
            type="file"
            name="image"
            id="image"
            {{ isset($service) ? '' : 'required' }}
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('image')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

        {{-- email form --}}
    <div class="mb-4">
        <label for="email" class="block text-sm text-gray-700">Email</label>
        <input
            type="varchar"
            name="email"
            id="email"
            value="{{ old('email', $service->email ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        />
        @error('email')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

     {{-- Address --}}
    <div>
        <label for="address" class="block text-sm text-gray-700">Address</label>
        <input
            type="text"
            name="address"
            id="address"
            value="{{ old('address', $service->address ?? '') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        />
        @error('address') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    
        {{-- phone form --}}
    <div class="mb-4">
        <label for="phone" class="block text-sm text-gray-700">Phone Number</label>
        <input
            type="varchar"
            name="phone"
            id="phone"
            value="{{ old('phone', $service->phone ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        />
        @error('phone')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
{{-- Light level --}}
<div class="mb-4">
    <label for="lighting_level" class="block text-sm text-gray-700">Light Level</label>
    <select name="lighting_level" id="lighting_level" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @php
            $lighting_levels = ['dim','normal','bright'];
        @endphp

        @foreach($lighting_levels as $lighting_level)
            <option value="{{ $lighting_level }}" {{ old('lighting_level', $service->lighting_level ?? '') === $lighting_level ? 'selected' : '' }}>
                {{ ucfirst($lighting_level) }}
            </option>
        @endforeach
    </select>
    @error('lighting_level')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Noise level --}}
<div class="mb-4">
    <label for="noise_level" class="block text-sm text-gray-700">Noise Level</label>
    <select name="noise_level" id="noise_level" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @php
            $noise_levels = ['low','medium','high'];
        @endphp

        @foreach($noise_levels as $noise_level)
            <option value="{{ $noise_level }}" {{ old('noise_level', $service->noise_level ?? '') === $noise_level ? 'selected' : '' }}>
                {{ ucfirst($noise_level) }}
            </option>
        @endforeach
    </select>
    @error('noise_level')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Crowd level --}}
<div class="mb-4">
    <label for="crowd_level" class="block text-sm text-gray-700">Crowd Level</label>
    <select name="crowd_level" id="crowd_level" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @php
            $crowd_levels = ['low','medium','high'];
        @endphp

        @foreach($crowd_levels as $crowd_level)
            <option value="{{ $crowd_level }}" {{ old('crowd_level', $service->crowd_level ?? '') === $crowd_level ? 'selected' : '' }}>
                {{ ucfirst($crowd_level) }}
            </option>
        @endforeach
    </select>
    @error('crowd_level')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Category --}}
<div class="mb-4">
    <label for="category_id" class="block text-sm text-gray-700">
        Category
    </label>

    <select
        name="category_id"
        id="category_id"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
    >
        <option value="">Select a category</option>

        @foreach($categories as $category)
            <option 
                value="{{ $category->id }}"
                {{ old('category_id', $service->category_id ?? '') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="autism_friendly_hours" class="block text-sm text-gray-700">
        Autism Friendly Hours
    </label>
    <input
        type="text"
        name="autism_friendly_hours"
        id="autism_friendly_hours"
        value="{{ old('autism_friendly_hours', $service->autism_friendly_hours ?? '') }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
    />
    @error('autism_friendly_hours')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

        <div>
            <x-primary-button type="submit">
                {{ isset($service) ? 'Update Service' : 'Add Service' }}
            </x-primary-button>
               <!-- cancel / back button -->
            <a href="{{ route('services.index') }}" class="'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                Cancel
            </a>

    </div>


</form>
