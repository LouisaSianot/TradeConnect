<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Post a Job') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('jobs.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="trade_category_id" :value="__('Trade Needed')" />
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
                        <x-input-label for="title" :value="__('Job Title')" />
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full"
                            :value="old('title')" required placeholder="e.g. Fix leaking kitchen tap" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="5" maxlength="2000" required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" name="location" type="text" class="block mt-1 w-full"
                            :value="old('location')" required placeholder="e.g. Eriku, Lae" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-primary-button>{{ __('Post Job') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>