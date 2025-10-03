<?php

namespace App\Http\Controllers;

use App\Models\ReviewAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewAnswerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReviewAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $reviewAnswers = ReviewAnswer::paginate();

        return view('review-answer.index', compact('reviewAnswers'))
            ->with('i', ($request->input('page', 1) - 1) * $reviewAnswers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reviewAnswer = new ReviewAnswer();

        return view('review-answer.create', compact('reviewAnswer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewAnswerRequest $request): RedirectResponse
    {
        ReviewAnswer::create($request->validated());

        return Redirect::route('review-answers.index')
            ->with('success', 'ReviewAnswer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reviewAnswer = ReviewAnswer::find($id);

        return view('review-answer.show', compact('reviewAnswer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reviewAnswer = ReviewAnswer::find($id);

        return view('review-answer.edit', compact('reviewAnswer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewAnswerRequest $request, ReviewAnswer $reviewAnswer): RedirectResponse
    {
        $reviewAnswer->update($request->validated());

        return Redirect::route('review-answers.index')
            ->with('success', 'ReviewAnswer updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ReviewAnswer::find($id)->delete();

        return Redirect::route('review-answers.index')
            ->with('success', 'ReviewAnswer deleted successfully');
    }
}
