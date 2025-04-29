<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Wishlist Item from Session') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Session Information</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Client:</strong> {{ $session->client->full_name }}</p>
                            <p><strong>Date:</strong> {{ $session->session_date->format('Y-m-d') }}</p>
                            <p><strong>Type:</strong> {{ $session->session_type }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('sessions.store-wishlist-item', $session) }}">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $session->client_id }}">

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Item Type</label>
                            <div class="mt-2">
                                <div class="flex items-center">
                                    <input type="radio" id="equipment_type" name="item_type" value="equipment" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('item_type', 'equipment') == 'equipment' ? 'checked' : '' }} onchange="toggleItemType()">
                                    <label for="equipment_type" class="ml-2 block text-sm text-gray-700">Equipment</label>
                                </div>
                                <div class="flex items-center mt-2">
                                    <input type="radio" id="software_type" name="item_type" value="software" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('item_type') == 'software' ? 'checked' : '' }} onchange="toggleItemType()">
                                    <label for="software_type" class="ml-2 block text-sm text-gray-700">Software</label>
                                </div>
                            </div>
                        </div>

                        <div id="equipment_section" class="mb-4">
                            <label for="at_equipment_id" class="block text-sm font-medium text-gray-700">Equipment</label>
                            <select name="at_equipment_id" id="at_equipment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Equipment</option>
                                @foreach($equipment as $item)
                                    <option value="{{ $item->id }}" {{ old('at_equipment_id') == $item->id ? 'selected' : '' }}>{{ $item->name }} ({{ $item->model ?? 'No Model' }})</option>
                                @endforeach
                            </select>
                            @error('at_equipment_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="software_section" class="mb-4" style="display: none;">
                            <label for="at_software_id" class="block text-sm font-medium text-gray-700">Software</label>
                            <select name="at_software_id" id="at_software_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Software</option>
                                @foreach($software as $item)
                                    <option value="{{ $item->id }}" {{ old('at_software_id') == $item->id ? 'selected' : '' }}>{{ $item->name }} ({{ $item->version ?? 'No Version' }})</option>
                                @endforeach
                            </select>
                            @error('at_software_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="approximate_value" class="block text-sm font-medium text-gray-700">Approximate Value (QAR)</label>
                            <input type="number" step="0.01" min="0" name="approximate_value" id="approximate_value" value="{{ old('approximate_value') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('approximate_value')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                            <select name="priority" id="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            @error('priority')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('sessions.show', $session) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add to Wishlist
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleItemType() {
            const equipmentType = document.getElementById('equipment_type');
            const equipmentSection = document.getElementById('equipment_section');
            const softwareSection = document.getElementById('software_section');
            
            if (equipmentType.checked) {
                equipmentSection.style.display = 'block';
                softwareSection.style.display = 'none';
                document.getElementById('at_software_id').value = '';
            } else {
                equipmentSection.style.display = 'none';
                softwareSection.style.display = 'block';
                document.getElementById('at_equipment_id').value = '';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            toggleItemType();
        });
    </script>
</x-app-layout>
