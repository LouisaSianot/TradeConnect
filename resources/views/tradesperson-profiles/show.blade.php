<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $profile->user->name }} — {{ $profile->tradeCategory->name }}
        </h2>
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
                        {{ $profile->verification_status === 'verified' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($profile->verification_status) }}
                    </span>

                    @if ($profile->user_id === auth()->id())
                        <a href="{{ route('tradesperson-profile.edit', $profile) }}" class="text-sm underline text-gray-600">
                            {{ __('Edit') }}
                        </a>
                    @endif
                </div>

                <dl class="mt-4 space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">{{ __('Trade') }}</dt>
                        <dd class="text-gray-900">{{ $profile->tradeCategory->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">{{ __('Location') }}</dt>
                        <dd class="text-gray-900">{{ $profile->location }}</dd>
                    </div>
                    @if ($profile->hourly_rate)
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('Hourly Rate') }}</dt>
                            <dd class="text-gray-900">PGK {{ number_format($profile->hourly_rate, 2) }}</dd>
                        </div>
                    @endif
                    @if ($profile->bio)
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('Bio') }}</dt>
                            <dd class="text-gray-900">{{ $profile->bio }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>