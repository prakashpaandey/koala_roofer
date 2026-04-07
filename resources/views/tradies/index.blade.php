<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tradie Management') }}
            </h2>
            <a href="{{ route('tradies.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Tradie
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700 shadow-sm rounded-r-md">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6 md:table-cell hidden">Contact</th>
                                    <th scope="col" class="py-3 px-6 md:table-cell hidden">Address</th>
                                    <th scope="col" class="py-3 px-6">Documents</th>
                                    <th scope="col" class="py-3 px-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($tradies as $tradie)
                                    <tr class="bg-white hover:bg-gray-50 transition-colors">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center shrink-0">
                                                @if($tradie->photo_path)
                                                    <img class="w-10 h-10 rounded-full mr-3 object-cover shadow-sm ring-1 ring-gray-100" src="{{ asset('storage/' . $tradie->photo_path) }}" alt="{{ $tradie->name }}">
                                                @else
                                                    <div class="w-10 h-10 rounded-full mr-3 bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold shadow-sm">
                                                        {{ strtoupper(substr($tradie->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div class="flex flex-col">
                                                    <span>{{ $tradie->name }}</span>
                                                    <span class="md:hidden text-xs text-gray-400 mt-0.5">{{ $tradie->contact_number }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="py-4 px-6 md:table-cell hidden">
                                            {{ $tradie->contact_number }}
                                        </td>
                                        <td class="py-4 px-6 md:table-cell hidden max-w-xs truncate">
                                            {{ $tradie->address }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex gap-2">
                                                @if($tradie->passport_path)
                                                    <a href="{{ asset('storage/' . $tradie->passport_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-1.5 rounded-md transition-colors" title="View Passport">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                        </svg>
                                                    </a>
                                                @endif
                                                @if($tradie->additional_document_path)
                                                    <a href="{{ asset('storage/' . $tradie->additional_document_path) }}" target="_blank" class="text-emerald-600 hover:text-emerald-900 bg-emerald-50 p-1.5 rounded-md transition-colors" title="View Document">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('tradies.edit', $tradie) }}" class="p-2 text-indigo-600 hover:text-white hover:bg-indigo-600 rounded-md transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('tradies.destroy', $tradie) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tradie? This action cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-rose-600 hover:text-white hover:bg-rose-600 rounded-md transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-gray-400 font-medium italic bg-gray-50/30">
                                            No tradies found. Start by adding one!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $tradies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
