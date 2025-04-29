<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Equipment Provision to Session') }}
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

                    <form method="POST" action="{{ route('sessions.store-provision', $session) }}">
                        @csrf

                        <div class="mb-4">
                            <label for="at_equipment_id" class="block text-sm font-medium text-gray-700">Equipment</label>
                            <select name="at_equipment_id" id="at_equipment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required onchange="loadEquipmentItems()">
                                <option value="">Select Equipment</option>
                                @foreach($equipment as $item)
                                    <option value="{{ $item->id }}" {{ old('at_equipment_id') == $item->id ? 'selected' : '' }}>{{ $item->name }} ({{ $item->model ?? 'No Model' }})</option>
                                @endforeach
                            </select>
                            @error('at_equipment_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="at_equipment_item_id" class="block text-sm font-medium text-gray-700">Equipment Item</label>
                            <select name="at_equipment_item_id" id="at_equipment_item_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select Equipment First</option>
                            </select>
                            @error('at_equipment_item_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="provision_date" class="block text-sm font-medium text-gray-700">Provision Date</label>
                            <input type="date" name="provision_date" id="provision_date" value="{{ old('provision_date', $session->session_date->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('provision_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cost" class="block text-sm font-medium text-gray-700">Cost (QAR)</label>
                            <input type="number" step="0.01" min="0" name="cost" id="cost" value="{{ old('cost', '0.00') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('cost')
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
                                Add Provision
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadEquipmentItems() {
            const equipmentId = document.getElementById('at_equipment_id').value;
            const itemSelect = document.getElementById('at_equipment_item_id');
            
            itemSelect.innerHTML = '<option value="">Loading items...</option>';
            
            if (!equipmentId) {
                itemSelect.innerHTML = '<option value="">Select Equipment First</option>';
                return;
            }
            
            fetch(`/api/equipment/${equipmentId}/available-items`)
                .then(response => response.json())
                .then(data => {
                    itemSelect.innerHTML = '';
                    
                    if (data.length === 0) {
                        itemSelect.innerHTML = '<option value="">No available items</option>';
                        return;
                    }
                    
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.serial_number ? 
                            `${item.serial_number} (${item.purchase_value} QAR)` : 
                            `Item #${item.id} (${item.purchase_value} QAR)`;
                        itemSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading equipment items:', error);
                    itemSelect.innerHTML = '<option value="">Error loading items</option>';
                });
        }
    </script>
</x-app-layout>
