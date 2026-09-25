<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\TradeCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobPostingController extends Controller
{
    /**
     * Browse open jobs — filtered to the viewer's trade if they're a
     * tradesperson, otherwise shows everything.
     */
    public function index(Request $request): View
    {
        $query = JobPosting::with('customer', 'tradeCategory')
            ->where('status', 'open')
            ->latest();

        $tradespersonProfile = auth()->user()->tradespersonProfile;
        if ($tradespersonProfile) {
            $query->where('trade_category_id', $tradespersonProfile->trade_category_id);
        }

        $jobs = $query->paginate(15);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form to post a new job (customer side).
     */
    public function create(): View
    {
        $categories = TradeCategory::orderBy('name')->get();

        return view('jobs.create', compact('categories'));
    }

    /**
     * Store a newly posted job.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'trade_category_id' => ['required', 'exists:trade_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $job = auth()->user()->jobsPosted()->create($validated);

        return redirect()
            ->route('jobs.show', $job)
            ->with('status', 'Job posted. Tradespeople in this category can now respond.');
    }

    /**
     * Show a single job.
     */
    public function show(JobPosting $job): View
    {
        $job->load('customer', 'tradesperson', 'tradeCategory');

        return view('jobs.show', compact('job'));
    }

    /**
     * A tradesperson responds to (claims) an open job.
     */
    public function respond(JobPosting $job): RedirectResponse
    {
        $profile = auth()->user()->tradespersonProfile;

        abort_unless($profile, 403, 'Only tradespeople can respond to jobs.');
        abort_unless($job->isOpen(), 409, 'This job is no longer open.');
        abort_unless(
            $profile->trade_category_id === $job->trade_category_id,
            403,
            'This job is not in your trade category.'
        );

        $job->update([
            'tradesperson_id' => auth()->id(),
            'status' => 'assigned',
        ]);

        return redirect()
            ->route('jobs.show', $job)
            ->with('status', 'You have been assigned to this job.');
    }

    /**
     * Customer marks a job as completed.
     */
    public function complete(JobPosting $job): RedirectResponse
    {
        abort_unless($job->customer_id === auth()->id(), 403);
        abort_unless($job->status === 'assigned', 409, 'Job must be assigned before it can be completed.');

        $job->update(['status' => 'completed']);

        return redirect()
            ->route('jobs.show', $job)
            ->with('status', 'Job marked as completed. Ratings coming in a later phase.');
    }
}