<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Equipment Item for') }} {{ $atEquipment->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('at-equipment.items.store', $atEquipment) }}">
                        @csrf

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Equipment Details</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p><strong>Name:</strong> {{ $atEquipment->name }}</p>
                                <p><strong>Model:</strong> {{ $atEquipment->model ?? 'N/A' }}</p>
                                <p><strong>Category:</strong> {{ $atEquipment->category->name ?? 'N/A' }}</p>
                                <p><strong>Supplier:</strong> {{ $atEquipment->supplier->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-gray-700">Serial Number</label>
                            <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('serial_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="purchase_value" class="block text-sm font-medium text-gray-700">Purchase Value (QAR)</label>
                            <input type="number" step="0.01" min="0" name="purchase_value" id="purchase_value" value="{{ old('purchase_value') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('purchase_value')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="loan" {{ old('status') == 'loan' ? 'selected' : '' }}>On Loan</option>
                                <option value="provision" {{ old('status') == 'provision' ? 'selected' : '' }}>Provisioned</option>
                                <option value="procured" {{ old('status') == 'procured' ? 'selected' : '' }}>Being Procured</option>
                            </select>
                            @error('status')
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
                            <a href="{{ route('at-equipment.items.index', $atEquipment) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
