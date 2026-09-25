<?php

namespace App\Http\Controllers;

use App\Models\TradeCategory;
use App\Models\TradespersonProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TradespersonProfileController extends Controller
{
    /**
     * Show the form to create a profile (tradesperson onboarding).
     */
    public function create(): View|RedirectResponse
    {
        if (auth()->user()->tradespersonProfile) {
            return redirect()->route('tradesperson-profile.show', auth()->user()->tradespersonProfile);
        }

        $categories = TradeCategory::orderBy('name')->get();

        return view('tradesperson-profiles.create', compact('categories'));
    }

    /**
     * Store a newly created profile.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'trade_category_id' => ['required', 'exists:trade_categories,id'],
            'location' => ['required', 'string', 'max:255'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        $profile = auth()->user()->tradespersonProfile()->create($validated);

        return redirect()
            ->route('tradesperson-profile.show', $profile)
            ->with('status', 'Profile created. It will show as "pending" until verified.');
    }

    /**
     * Display a tradesperson's profile.
     */
    public function show(TradespersonProfile $tradespersonProfile): View
    {
        $tradespersonProfile->load('user', 'tradeCategory');

        return view('tradesperson-profiles.show', [
            'profile' => $tradespersonProfile,
        ]);
    }

    /**
     * Show the form to edit a profile.
     */
    public function edit(TradespersonProfile $tradespersonProfile): View
    {
        $this->authorizeOwner($tradespersonProfile);

        $categories = TradeCategory::orderBy('name')->get();

        return view('tradesperson-profiles.edit', [
            'profile' => $tradespersonProfile,
            'categories' => $categories,
        ]);
    }

    /**
     * Update a profile.
     */
    public function update(Request $request, TradespersonProfile $tradespersonProfile): RedirectResponse
    {
        $this->authorizeOwner($tradespersonProfile);

        $validated = $request->validate([
            'trade_category_id' => ['required', 'exists:trade_categories,id'],
            'location' => ['required', 'string', 'max:255'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        $tradespersonProfile->update($validated);

        return redirect()
            ->route('tradesperson-profile.show', $tradespersonProfile)
            ->with('status', 'Profile updated.');
    }

    /**
     * Simple ownership guard for a pilot — swap for a Policy once more roles exist.
     */
    protected function authorizeOwner(TradespersonProfile $profile): void
    {
        abort_unless($profile->user_id === auth()->id(), 403);
    }
}