<?php


namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
      
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'description' => 'nullable|string|max:1000',
            'noise_rating' => 'nullable|in:low,medium,high',
            'lighting_rating' => 'nullable|in:low,medium,high',
            'crowd_rating' => 'nullable|in:dim,normal,bright',
        ]);
    
    
        Review::create([
            'service_id' => $request->service_id,
            'user_id' => auth()->id(), 
            'description' => $request->description,
            'noise_rating' => $request->noise_rating,
            'lighting_rating' => $request->lighting_rating,
            'crowd_rating' => $request->crowd_rating,
        ]);
    
     
        return redirect()->back()->with('success', 'Review added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
