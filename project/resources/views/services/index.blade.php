<!DOCTYPE html>
<html>
    <head>
        <title>Services</title>
        <style>
            body { font-family: sans-serif; padding: 20px; background: #f9f9f9; }
            h1 { margin-bottom: 20px; }
            .service { 
                background: #fff; 
                padding: 15px; 
                margin-bottom: 15px; 
                border-radius: 6px; 
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .service img { max-width: 100%; height: auto; border-radius: 4px; margin-bottom: 10px; }
            .service h2 { margin: 0 0 5px 0; font-size: 1.2em; }
            .service p { margin: 0 0 5px 0; color: #555; }
        </style>
    </head>
    <body>
        <h1>All Services</h1>

        @foreach($services as $service)
        <div class="service">
            <img src="{{ asset('images/services/' . $service->image) }}" alt="{{ $service->name }}">
            <h2>{{ $service->name }}</h2>
            <p>{{ $service->description }}</p>
            <p><strong>Email:</strong> {{ $service->email }} | <strong>Phone:</strong> {{ $service->phone }}</p>
            <p><strong>Address:</strong> {{ $service->address }}</p>
        </div>
        @endforeach

    </body>
</html>