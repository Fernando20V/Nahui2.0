<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $reviews = Review::paginate();

        return view('review.index', compact('reviews'))
            ->with('i', ($request->input('page', 1) - 1) * $reviews->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $review = new Review();

        return view('review.create', compact('review'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request): RedirectResponse
    {
        Review::create($request->validated());

        return Redirect::route('reviews.index')
            ->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $review = Review::find($id);

        return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $review = Review::find($id);

        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review): RedirectResponse
    {
        $review->update($request->validated());

        return Redirect::route('reviews.index')
            ->with('success', 'Review updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Review::find($id)->delete();

        return Redirect::route('reviews.index')
            ->with('success', 'Review deleted successfully');
    }
}
