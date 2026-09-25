<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Open Jobs') }}</h2>
            <a href="{{ route('jobs.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-md text-sm">
                {{ __('Post a Job') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @forelse ($jobs as $job)
                <a href="{{ route('jobs.show', $job) }}"
                    class="block bg-white shadow-sm sm:rounded-lg p-5 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $job->tradeCategory->name }} · {{ $job->location }}
                            </p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </a>
            @empty
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-500">
                    {{ __('No open jobs right now.') }}
                </div>
            @endforelse

            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>