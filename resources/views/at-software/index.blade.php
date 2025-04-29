<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Assistive Software Management') }}
            </h2>
            <a href="{{ route('at-software.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Software
            </a>
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

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Version
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Supplier
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Licenses
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Expiry Date
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($software as $item)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <a href="{{ route('at-software.show', $item) }}" class="text-blue-500 hover:text-blue-700">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $item->version ?? 'N/A' }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $item->supplier->name ?? 'N/A' }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $item->number_of_licenses }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $item->expiry_date ? $item->expiry_date->format('Y-m-d') : 'N/A' }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('at-software.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('at-software.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this software?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 border-b border-gray-200 text-center">
                                            No software found. <a href="{{ route('at-software.create') }}" class="text-blue-500">Add one now</a>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $software->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
