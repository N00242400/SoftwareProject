<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //fetch all services
        $services = Service::all();
        //pass services to view
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'noise_level' => 'required|in:low,medium,high',
        'lighting_level' => 'required|in:dim,normal,bright',   
        'crowd_level' => 'required|in:low,medium,high',  
        'autism_friendly_hours' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',    
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',      
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/services'), $imageName);
        $data['image'] = $imageName;
    }

    Service::create([
        'name' => $request->name,
        'description' => $request->description,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'noise_level' => $request->noise_level,
        'lighting_level' => $request->lighting_level,
        'crowd_level' => $request->crowd_level,
        'autism_friendly_hours' => $request->autism_friendly_hours,
         'image' => $imageName,
         'category_id' => $request->category_id,
         'created_at'=>now(),
         'updated_at'=>now()
    ]);

    return to_route('services.index')->with('success', 'Service created successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show')->with('service',$service);
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
