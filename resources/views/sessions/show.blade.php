<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Session Details') }}
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
                        <h3 class="text-lg font-semibold">Session Information</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('sessions.edit', $session) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <a href="{{ route('sessions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Client</p>
                                <p class="text-base">
                                    <a href="{{ route('clients.show', $session->client) }}" class="text-blue-600 hover:text-blue-900">
                                        {{ $session->client->full_name }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Trusted Specialist</p>
                                <p class="text-base">{{ $session->trustedSpecialist->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">AT Expert</p>
                                <p class="text-base">{{ $session->atExpert->name ?? 'Not assigned' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Session Type</p>
                                <p class="text-base">{{ $session->session_type }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Date and Time</p>
                                <p class="text-base">{{ $session->session_date->format('Y-m-d H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Duration</p>
                                <p class="text-base">{{ $session->session_duration }} minutes</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500">Notes</p>
                                <p class="text-base">{{ $session->notes ?? 'No notes available' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500">Outcome</p>
                                <p class="text-base">{{ $session->outcome ?? 'No outcome recorded' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Client Information</h4>
                        <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Full Name</p>
                                    <p class="text-base">{{ $session->client->full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Age</p>
                                    <p class="text-base">{{ $session->client->age ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Gender</p>
                                    <p class="text-base">{{ ucfirst($session->client->gender) ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Disability Type</p>
                                    <p class="text-base">{{ $session->client->disability_type ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Contact Phone</p>
                                    <p class="text-base">{{ $session->client->contact_phone ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="text-base">{{ $session->client->email ?? 'Not specified' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
