<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Equipment Item Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('at-equipment.items.edit', [$atEquipment, $item]) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('at-equipment.items.index', $atEquipment) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
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

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Equipment Details</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Name:</strong> {{ $atEquipment->name }}</p>
                            <p><strong>Model:</strong> {{ $atEquipment->model ?? 'N/A' }}</p>
                            <p><strong>Category:</strong> {{ $atEquipment->category->name ?? 'N/A' }}</p>
                            <p><strong>Supplier:</strong> {{ $atEquipment->supplier->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Item Details</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Serial Number:</strong> {{ $item->serial_number ?? 'N/A' }}</p>
                            <p><strong>Purchase Value:</strong> {{ number_format($item->purchase_value, 2) }} QAR</p>
                            <p><strong>Status:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($item->status == 'available') bg-green-100 text-green-800 
                                    @elseif($item->status == 'loan') bg-blue-100 text-blue-800 
                                    @elseif($item->status == 'provision') bg-purple-100 text-purple-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </p>
                            <p><strong>Created At:</strong> {{ $item->created_at->format('Y-m-d H:i') }}</p>
                            <p><strong>Updated At:</strong> {{ $item->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                    @if($item->notes)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Notes</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p>{{ $item->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6">
                        <form action="{{ route('at-equipment.items.destroy', [$atEquipment, $item]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
