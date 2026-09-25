<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mb-6 flex flex-wrap gap-3">
    <a href="{{ route('jobs.index') }}"
        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
        {{ __('Browse Jobs') }}
    </a>

    <a href="{{ route('jobs.create') }}"
        class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-md text-sm hover:bg-gray-800">
        {{ __('Post a Job') }}
    </a>

    @if (auth()->user()->tradespersonProfile)
        <a href="{{ route('tradesperson-profile.show', auth()->user()->tradespersonProfile) }}"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
            {{ __('My Tradesperson Profile') }}
        </a>
    @else
        <a href="{{ route('tradesperson-profile.create') }}"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
            {{ __('Become a Tradesperson') }}
        </a>
    @endif
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
