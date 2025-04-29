<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Software Provision Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('software-provisions.edit', $softwareProvision) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('software-provisions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                            <p><strong>Name:</strong> {{ $softwareProvision->client->full_name }}</p>
                            <p><strong>Contact:</strong> {{ $softwareProvision->client->contact_phone ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $softwareProvision->client->email ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Software Details</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Name:</strong> {{ $softwareProvision->software->name }}</p>
                            <p><strong>Version:</strong> {{ $softwareProvision->software->version ?? 'N/A' }}</p>
                            <p><strong>Type:</strong> {{ $softwareProvision->software->type ?? 'N/A' }}</p>
                            <p><strong>Description:</strong> {{ $softwareProvision->software->description ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Provision Details</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Provision Date:</strong> {{ $softwareProvision->provision_date->format('Y-m-d') }}</p>
                            <p><strong>Cost:</strong> {{ number_format($softwareProvision->cost, 2) }} QAR</p>
                            <p><strong>Created At:</strong> {{ $softwareProvision->created_at->format('Y-m-d H:i') }}</p>
                            <p><strong>Updated At:</strong> {{ $softwareProvision->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                    @if($softwareProvision->notes)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Notes</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p>{{ $softwareProvision->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6">
                        <form action="{{ route('software-provisions.destroy', $softwareProvision) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this software provision?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Software Provision
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
