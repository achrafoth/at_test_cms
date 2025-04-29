<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Session') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('sessions.update', $session) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                            <select name="client_id" id="client_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Select Client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $session->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="trusted_specialist_id" class="block text-sm font-medium text-gray-700">Trusted Specialist</label>
                            <select name="trusted_specialist_id" id="trusted_specialist_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Select Specialist --</option>
                                @foreach($specialists as $specialist)
                                    <option value="{{ $specialist->id }}" {{ old('trusted_specialist_id', $session->trusted_specialist_id) == $specialist->id ? 'selected' : '' }}>
                                        {{ $specialist->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('trusted_specialist_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="at_expert_id" class="block text-sm font-medium text-gray-700">AT Expert (Optional)</label>
                            <select name="at_expert_id" id="at_expert_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- None --</option>
                                @foreach($experts as $expert)
                                    <option value="{{ $expert->id }}" {{ old('at_expert_id', $session->at_expert_id) == $expert->id ? 'selected' : '' }}>
                                        {{ $expert->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('at_expert_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="session_type" class="block text-sm font-medium text-gray-700">Session Type</label>
                            <select name="session_type" id="session_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Select Type --</option>
                                @foreach($sessionTypes as $type)
                                    <option value="{{ $type }}" {{ old('session_type', $session->session_type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('session_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="session_date" class="block text-sm font-medium text-gray-700">Session Date and Time</label>
                            <input type="datetime-local" name="session_date" id="session_date" value="{{ old('session_date', $session->session_date->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('session_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="session_duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                            <input type="number" name="session_duration" id="session_duration" value="{{ old('session_duration', $session->session_duration) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('session_duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $session->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="outcome" class="block text-sm font-medium text-gray-700">Outcome (Optional)</label>
                            <textarea name="outcome" id="outcome" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('outcome', $session->outcome) }}</textarea>
                            @error('outcome')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('sessions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Session
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
