<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Software Details') }}: {{ $atSoftware->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('at-software.edit', $atSoftware) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('at-software.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Software Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="mb-4">
                                    <span class="text-gray-600 font-medium">Name:</span>
                                    <span class="ml-2">{{ $atSoftware->name }}</span>
                                </div>
                                <div class="mb-4">
                                    <span class="text-gray-600 font-medium">Version:</span>
                                    <span class="ml-2">{{ $atSoftware->version ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-4">
                                    <span class="text-gray-600 font-medium">Description:</span>
                                    <p class="mt-1">{{ $atSoftware->description ?? 'No description available.' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-2">License Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="mb-4">
                                    <span class="text-gray-600 font-medium">License Key:</span>
                                    <span class="ml-2">{{ $atSoftware->license_key ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-4">
                                    <span class="text-gray-600 font-medium">Number of Licenses:</span>
                                    <span class="ml-2">{{ $atSoftware->number_of_licenses }}</span>
                                </div>
                                <div class="mb-4">
                                    <span class="text-gray-600 font-medium">Expiry Date:</span>
                                    <span class="ml-2">{{ $atSoftware->expiry_date ? $atSoftware->expiry_date->format('Y-m-d') : 'N/A' }}</span>
                                </div>
                                <div class="mb-4">
                                    <span class="text-gray-600 font-medium">Supplier:</span>
                                    <span class="ml-2">{{ $atSoftware->supplier->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 border-t pt-4">
                        <form action="{{ route('at-software.destroy', $atSoftware) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this software?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Software
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
