@props(['name', 'image', 'description' => null, 'link'])


<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300">

    <h3 class="text-xl font-semibold text-gray-800 mb-2">
        {{ $name }}
    </h3>

    <img src="{{ asset('images/services/' . $image) }}" 
         alt="{{ $name }}" 
         class="w-full h-48 object-cover rounded">

  
        <p class="text-gray-600 text-sm leading-relaxed mt-3">
            {{ Str::limit($description, 100) }}
        </p>
  

 

</div>