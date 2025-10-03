<?php

namespace App\Http\Controllers;

use App\Models\ReviewLike;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewLikeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReviewLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $reviewLikes = ReviewLike::paginate();

        return view('review-like.index', compact('reviewLikes'))
            ->with('i', ($request->input('page', 1) - 1) * $reviewLikes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reviewLike = new ReviewLike();

        return view('review-like.create', compact('reviewLike'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewLikeRequest $request): RedirectResponse
    {
        ReviewLike::create($request->validated());

        return Redirect::route('review-likes.index')
            ->with('success', 'ReviewLike created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reviewLike = ReviewLike::find($id);

        return view('review-like.show', compact('reviewLike'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reviewLike = ReviewLike::find($id);

        return view('review-like.edit', compact('reviewLike'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewLikeRequest $request, ReviewLike $reviewLike): RedirectResponse
    {
        $reviewLike->update($request->validated());

        return Redirect::route('review-likes.index')
            ->with('success', 'ReviewLike updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ReviewLike::find($id)->delete();

        return Redirect::route('review-likes.index')
            ->with('success', 'ReviewLike deleted successfully');
    }
}
