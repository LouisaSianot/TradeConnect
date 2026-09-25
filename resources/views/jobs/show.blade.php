<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $job->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @class([
                            'bg-blue-100 text-blue-800' => $job->status === 'open',
                            'bg-yellow-100 text-yellow-800' => $job->status === 'assigned',
                            'bg-green-100 text-green-800' => $job->status === 'completed',
                            'bg-gray-100 text-gray-800' => $job->status === 'cancelled',
                        ])">
                        {{ ucfirst($job->status) }}
                    </span>
                    <span class="text-sm text-gray-500">{{ $job->tradeCategory->name }}</span>
                </div>

                <dl class="mt-4 space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">{{ __('Posted by') }}</dt>
                        <dd class="text-gray-900">{{ $job->customer->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">{{ __('Location') }}</dt>
                        <dd class="text-gray-900">{{ $job->location }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">{{ __('Description') }}</dt>
                        <dd class="text-gray-900 whitespace-pre-line">{{ $job->description }}</dd>
                    </div>
                    @if ($job->tradesperson)
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('Assigned to') }}</dt>
                            <dd class="text-gray-900">{{ $job->tradesperson->name }}</dd>
                        </div>
                    @endif
                </dl>

                <div class="mt-6 flex gap-3">
                    @if ($job->isOpen() && auth()->user()->tradespersonProfile)
                        <form method="POST" action="{{ route('jobs.respond', $job) }}">
                            @csrf
                            <x-primary-button>{{ __('Respond to this Job') }}</x-primary-button>
                        </form>
                    @endif

                    @if ($job->status === 'assigned' && $job->customer_id === auth()->id())
                        <form method="POST" action="{{ route('jobs.complete', $job) }}">
                            @csrf
                            <x-primary-button>{{ __('Mark as Completed') }}</x-primary-button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>