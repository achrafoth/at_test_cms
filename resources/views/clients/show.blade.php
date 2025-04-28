<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Details') }}
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
                        <h3 class="text-lg font-semibold">Client Information</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('clients.edit', $client) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Full Name</p>
                                <p class="text-base">{{ $client->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Age</p>
                                <p class="text-base">{{ $client->age ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Gender</p>
                                <p class="text-base">{{ ucfirst($client->gender) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Disability Type</p>
                                <p class="text-base">{{ $client->disability_type ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nationality</p>
                                <p class="text-base">{{ $client->nationality ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Contact Phone</p>
                                <p class="text-base">{{ $client->contact_phone ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-base">{{ $client->email ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="text-base">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $client->status === 'active' ? 'bg-green-100 text-green-800' : 
                                           ($client->status === 'inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($client->status) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Assigned Trusted Specialist</p>
                                <p class="text-base">
                                    @if($client->assigned_trusted_specialist_id && $client->trustedSpecialist)
                                        {{ $client->trustedSpecialist->name }}
                                    @else
                                        Not assigned
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Assigned AT Expert</p>
                                <p class="text-base">
                                    @if($client->assigned_at_expert_id && $client->atExpert)
                                        {{ $client->atExpert->name }}
                                    @else
                                        Not assigned
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Equipment Provisions</h4>
                        @if($client->provisions && $client->provisions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Equipment</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Provision Date</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($client->provisions as $provision)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $provision->equipment->name ?? 'Unknown Equipment' }}
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $provision->provision_date }}
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <a href="{{ route('provisions.show', $provision) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">No equipment provisions found for this client.</p>
                        @endif
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Equipment Loans</h4>
                        @if($client->loans && $client->loans->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Equipment</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Start Date</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Expected Return</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($client->loans as $loan)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $loan->equipment->name ?? 'Unknown Equipment' }}
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $loan->start_date }}
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    {{ $loan->expected_return_date }}
                                                </td>
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
                            <p class="text-gray-500">No equipment loans found for this client.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
