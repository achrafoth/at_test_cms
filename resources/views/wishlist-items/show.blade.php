<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Wishlist Item Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('wishlist-items.edit', $wishlistItem) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('wishlist-items.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                        <h3 class="text-lg font-semibold mb-2">Client Information</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Name:</strong> {{ $wishlistItem->client->full_name }}</p>
                            <p><strong>Contact:</strong> {{ $wishlistItem->client->contact_phone ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $wishlistItem->client->email ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Item Details</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Type:</strong> 
                                @if($wishlistItem->equipment)
                                    Equipment
                                @elseif($wishlistItem->software)
                                    Software
                                @else
                                    N/A
                                @endif
                            </p>
                            
                            @if($wishlistItem->equipment)
                                <p><strong>Equipment:</strong> {{ $wishlistItem->equipment->name }}</p>
                                <p><strong>Model:</strong> {{ $wishlistItem->equipment->model ?? 'N/A' }}</p>
                                <p><strong>Category:</strong> {{ $wishlistItem->equipment->category->name ?? 'N/A' }}</p>
                            @endif
                            
                            @if($wishlistItem->software)
                                <p><strong>Software:</strong> {{ $wishlistItem->software->name }}</p>
                                <p><strong>Version:</strong> {{ $wishlistItem->software->version ?? 'N/A' }}</p>
                                <p><strong>Type:</strong> {{ $wishlistItem->software->type ?? 'N/A' }}</p>
                            @endif
                            
                            <p><strong>Approximate Value:</strong> {{ number_format($wishlistItem->approximate_value, 2) }} QAR</p>
                            <p><strong>Priority:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($wishlistItem->priority == 'high') bg-red-100 text-red-800 
                                    @elseif($wishlistItem->priority == 'medium') bg-yellow-100 text-yellow-800 
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($wishlistItem->priority) }}
                                </span>
                            </p>
                            <p><strong>Requested By:</strong> {{ $wishlistItem->requestedByUser->name ?? 'N/A' }}</p>
                            <p><strong>Requested On:</strong> {{ $wishlistItem->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                    @if($wishlistItem->notes)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Notes</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p>{{ $wishlistItem->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6">
                        <form action="{{ route('wishlist-items.destroy', $wishlistItem) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this wishlist item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Wishlist Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
