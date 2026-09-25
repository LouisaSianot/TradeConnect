<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Your Tradesperson Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tradesperson-profile.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="trade_category_id" :value="__('Trade')" />
                        <select id="trade_category_id" name="trade_category_id" required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">{{ __('Select a trade') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('trade_category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('trade_category_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Location (area/suburb)')" />
                        <x-text-input id="location" name="location" type="text" class="block mt-1 w-full"
                            :value="old('location')" required placeholder="e.g. Eriku, Lae" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="hourly_rate" :value="__('Hourly Rate (PGK, optional)')" />
                        <x-text-input id="hourly_rate" name="hourly_rate" type="number" step="0.01" min="0"
                            class="block mt-1 w-full" :value="old('hourly_rate')" />
                        <x-input-error :messages="$errors->get('hourly_rate')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="bio" :value="__('Short Bio (optional)')" />
                        <textarea id="bio" name="bio" rows="4" maxlength="1000"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('bio') }}</textarea>
                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-primary-button>{{ __('Create Profile') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>