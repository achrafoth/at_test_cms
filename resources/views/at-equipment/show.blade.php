<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AT Equipment Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Equipment Information</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('at-equipment.edit', $atEquipment) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <a href="{{ route('at-equipment.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="text-base">{{ $atEquipment->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Model</p>
                                <p class="text-base">{{ $atEquipment->model ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Category</p>
                                <p class="text-base">{{ $atEquipment->category->name ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Supplier</p>
                                <p class="text-base">{{ $atEquipment->supplier->name ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Serial Number</p>
                                <p class="text-base">{{ $atEquipment->serial_number ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Quantity</p>
                                <p class="text-base">{{ $atEquipment->quantity }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500">Description</p>
                                <p class="text-base">{{ $atEquipment->description ?? 'No description available' }}</p>
                            </div>
                            @if($atEquipment->photo)
                                <div class="col-span-2">
                                    <p class="text-sm font-medium text-gray-500">Photo</p>
                                    <img src="{{ asset('storage/' . $atEquipment->photo) }}" alt="{{ $atEquipment->name }}" class="mt-1 h-48 w-auto">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Provision History</h4>
                        @if($atEquipment->provisions && $atEquipment->provisions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Provision Date</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Notes</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($atEquipment->provisions as $provision)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $provision->client->full_name }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $provision->provision_date->format('Y-m-d') }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $provision->notes ?? 'No notes' }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <a href="{{ route('provisions.show', $provision) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">No provision history for this equipment.</p>
                        @endif
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Loan History</h4>
                        @if($atEquipment->loans && $atEquipment->loans->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Start Date</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Expected Return</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($atEquipment->loans as $loan)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $loan->client->full_name }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $loan->start_date->format('Y-m-d') }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $loan->expected_return_date->format('Y-m-d') }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        {{ $loan->status === 'on_loan' ? 'bg-blue-100 text-blue-800' : 
                                                           ($loan->status === 'returned' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $loan->status)) }}
                                                    </span>
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <a href="{{ route('loans.show', $loan) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">No loan history for this equipment.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
