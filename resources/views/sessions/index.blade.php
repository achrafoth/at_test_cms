<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sessions') }}
            </h2>
            <a href="{{ route('sessions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create New Session
            </a>
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

                    @if(request()->has('client_id'))
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Sessions for Client: {{ \App\Models\Client::find(request()->client_id)->full_name }}</h3>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Specialist</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Session Type</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Duration</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sessions as $session)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <a href="{{ route('clients.show', $session->client) }}" class="text-blue-600 hover:text-blue-900">
                                                {{ $session->client->full_name }}
                                            </a>
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $session->trustedSpecialist->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $session->session_type }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $session->session_date->format('Y-m-d H:i') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $session->session_duration }} min</td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('sessions.show', $session) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                <a href="{{ route('sessions.edit', $session) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                                <form method="POST" action="{{ route('sessions.destroy', $session) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this session?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 border-b border-gray-200 text-center">No sessions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $sessions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
