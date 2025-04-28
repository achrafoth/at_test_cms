<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Equipment Provision') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('provisions.store') }}">
                        @csrf

                        <!-- Client -->
                        <div class="mb-4">
                            <x-input-label for="client_id" :value="__('Client')" />
                            <select id="client_id" name="client_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Select Client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>

                        <!-- Equipment -->
                        <div class="mb-4">
                            <x-input-label for="at_equipment_id" :value="__('Equipment')" />
                            <select id="at_equipment_id" name="at_equipment_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Select Equipment --</option>
                                @foreach($equipment as $item)
                                    <option value="{{ $item->id }}" {{ old('at_equipment_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} ({{ $item->model ?? 'No Model' }}) - Available: {{ $item->quantity }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('at_equipment_id')" class="mt-2" />
                        </div>

                        <!-- Provision Date -->
                        <div class="mb-4">
                            <x-input-label for="provision_date" :value="__('Provision Date')" />
                            <x-text-input id="provision_date" class="block mt-1 w-full" type="date" name="provision_date" :value="old('provision_date', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('provision_date')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('provisions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create Provision') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
