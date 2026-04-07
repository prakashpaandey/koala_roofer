<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-black text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                {{ __('Tradies Directory') }}
            </h2>
            <a href="{{ route('tradies.create') }}" class="inline-flex items-center px-6 py-3 bg-construction-orange border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-700 transition ease-in-out duration-150 shadow-lg shadow-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New Tradie
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 p-4 bg-success-green/10 border-l-4 border-success-green text-success-green rounded-r-xl font-bold animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-roofing-blue text-white uppercase text-xs tracking-widest font-black">
                                <th class="px-6 py-4">Tradie</th>
                                <th class="px-6 py-4">Contact Detail</th>
                                <th class="px-6 py-4">Address</th>
                                <th class="px-6 py-4 text-center">Documents</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($tradies as $tradie)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-12 w-12 flex-shrink-0 rounded-full border-2 border-gray-100 overflow-hidden bg-gray-50">
                                                @if($tradie->photo_path)
                                                    <img src="{{ asset('storage/' . $tradie->photo_path) }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-roofing-blue font-black bg-blue-50">
                                                        {{ strtoupper(substr($tradie->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-black text-roofing-blue tracking-tight">{{ $tradie->name }}</div>
                                                <div class="text-xs text-secondary-text">Joined {{ $tradie->created_at->format('M Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-primary-text font-bold">
                                        {{ $tradie->contact_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-secondary-text max-w-xs truncate">{{ $tradie->address }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2">
                                            @if($tradie->passport_path)
                                                <a href="{{ asset('storage/' . $tradie->passport_path) }}" target="_blank" class="p-1.5 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition-colors shadow-sm" title="Passport">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if($tradie->additional_document_path)
                                                <a href="{{ asset('storage/' . $tradie->additional_document_path) }}" target="_blank" class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors shadow-sm" title="Doc">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2 text-primary">
                                            <a href="{{ route('tradies.edit', $tradie) }}" class="p-2 text-roofing-blue hover:bg-roofing-blue hover:text-white rounded-lg transition-all duration-200 shadow-sm border border-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('tradies.destroy', $tradie) }}" method="POST" onsubmit="return confirm('Delete this tradie?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-error-red hover:bg-error-red hover:text-white rounded-lg transition-all duration-200 shadow-sm border border-gray-100">
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
                                    <td colspan="5" class="px-6 py-12 text-center text-secondary-text italic font-medium bg-gray-50/50">No tradies linked yet. Click "Add New Tradie" to start.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($tradies->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $tradies->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

