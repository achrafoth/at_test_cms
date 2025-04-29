<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Equipment Provision Details') }}
            </h2>
            <div>
                <a href="{{ route('provisions.edit', $provision) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('provisions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Provision Information</h3>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">ID</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $provision->id }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">Provision Date</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $provision->provision_date->format('Y-m-d') }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">Cost</p>
                                <p class="mt-1 text-sm text-gray-900">{{ number_format($provision->cost, 2) }} QAR</p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">Notes</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $provision->notes ?? 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Related Information</h3>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">Client</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    <a href="{{ route('clients.show', $provision->client) }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $provision->client->full_name }}
                                    </a>
                                </p>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">Equipment</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    <a href="{{ route('at-equipment.show', $provision->equipment) }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $provision->equipment->name }} ({{ $provision->equipment->model ?? 'No Model' }})
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <form class="inline-block" action="{{ route('provisions.destroy', $provision) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this provision?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Delete Provision') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
