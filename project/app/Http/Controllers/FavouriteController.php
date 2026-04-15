<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // start query (don’t get results yet)
        $query = auth()->user()->favourites()->with('service');
    
        // filter by noise
        if (request('noise_level')) {
            $query->whereHas('service', function ($q) {
                $q->where('noise_level', request('noise_level'));
            });
        }
    
        // filter by lighting
        if (request('lighting_level')) {
            $query->whereHas('service', function ($q) {
                $q->where('lighting_level', request('lighting_level'));
            });
        }
    
        // filter by crowd
        if (request('crowd_level')) {
            $query->whereHas('service', function ($q) {
                $q->where('crowd_level', request('crowd_level'));
            });
        }
    
       
        $favourites = $query->get();
    
        return view('favourites.index', compact('favourites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $user = auth()->user();
    $serviceId = $request->input('service_id');

    // check if the favourite already exists
    //firstOrCreate laravel Eloquent method
    $user->favourites()->firstOrCreate([
        'service_id' => $serviceId,
    ]);

    return back()->with('success', 'Service added to favourites!');
}
    /**
     * Display the specified resource.
     */
    public function show(Favourite $favourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favourite $favourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favourite $favourite)
    {
       
        if ($favourite->user_id !== auth()->id()) {
            return back()->with('error', 'You cannot remove this favourite.');
        }
    
        $favourite->delete();
    
        return back()->with('success', 'Service removed from favourites!');
    }
}
