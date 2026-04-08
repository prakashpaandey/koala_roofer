<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 md:gap-4 px-4 md:px-0">
            <h2 class="font-black text-xl md:text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                {{ __('Tradies Directory') }}
            </h2>
            <a href="{{ route('tradies.create') }}" class="inline-flex items-center justify-center px-4 md:px-6 py-2 md:py-3 bg-construction-orange border border-transparent rounded-xl font-bold text-xs md:text-sm text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-700 transition ease-in-out duration-150 shadow-lg shadow-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New Tradie
            </a>
        </div>
    </x-slot>

    <div class="py-4 md:py-6" x-data="{ deleteUrl: '' }">
        <div class="max-w-7xl mx-auto px-4 md:px-0">
            @if(session('success'))
                <div class="mb-4 md:mb-6 p-4 bg-success-green/10 border-l-4 border-success-green text-success-green rounded-r-xl font-bold animate-pulse text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mobile Card Layout -->
            <div class="grid grid-cols-1 gap-4 md:hidden mb-6">
                @forelse($tradies as $tradie)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 group transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0 rounded-full border-2 border-gray-100 overflow-hidden bg-gray-50">
                                    @if($tradie->photo_path)
                                        <img src="{{ asset('storage/' . $tradie->photo_path) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-roofing-blue font-black bg-blue-50 text-xs">
                                            {{ strtoupper(substr($tradie->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-black text-roofing-blue tracking-tight leading-tight">{{ $tradie->name }}</div>
                                    <div class="text-[10px] text-secondary-text font-bold uppercase tracking-widest mt-0.5">Added {{ $tradie->created_at->format('M Y') }}</div>
                                </div>
                            </div>
                            
                            <!-- Small Floating Docs Indicators -->
                            <div class="flex gap-1.5 focus:outline-none">
                                @if($tradie->passport_path)
                                    <a href="{{ asset('storage/' . $tradie->passport_path) }}" target="_blank" class="p-1.5 bg-orange-50 text-construction-orange rounded-lg shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4" />
                                        </svg>
                                    </a>
                                @endif
                                @if($tradie->additional_document_path)
                                    <a href="{{ asset('storage/' . $tradie->additional_document_path) }}" target="_blank" class="p-1.5 bg-green-50 text-success-green rounded-lg shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center text-sm text-primary-text font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $tradie->contact_number }}
                            </div>
                            <div class="flex items-start text-xs text-secondary-text font-medium leading-relaxed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2.5 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $tradie->address }}
                            </div>
                        </div>

                        <div class="flex items-center gap-2 pt-4 border-t border-gray-50">
                            <a href="{{ route('tradies.edit', $tradie) }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-gray-50 text-roofing-blue text-[10px] uppercase font-black rounded-xl hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <button 
                                @click="deleteUrl = '{{ route('tradies.destroy', $tradie) }}'; $dispatch('open-modal', 'confirm-delete')"
                                class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-red-50 text-error-red text-[10px] uppercase font-black rounded-xl hover:bg-red-100 transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 text-center rounded-2xl border border-dashed border-gray-200 text-secondary-text italic uppercase font-bold text-xs tracking-widest">
                        No tradies onboarded yet.
                    </div>
                @endforelse
            </div>

            <!-- Table View (Desktop Only) -->
            <div class="hidden md:block bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-roofing-blue text-white uppercase text-xs tracking-widest font-black">
                                <th class="px-6 py-4">Tradie</th>
                                <th class="px-6 py-4">Contact Number</th>
                                <th class="px-6 py-4">Address</th>
                                <th class="px-6 py-4 text-center">Docs</th>
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
                                                <div class="text-xs text-secondary-text font-medium uppercase tracking-widest">Added {{ $tradie->created_at->format('M Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-primary-text font-bold">
                                        {{ $tradie->contact_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-secondary-text max-w-xs truncate font-medium">{{ $tradie->address }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2">
                                            @if($tradie->passport_path)
                                                <a href="{{ asset('storage/' . $tradie->passport_path) }}" target="_blank" class="p-1.5 bg-orange-50 text-construction-orange rounded-lg hover:bg-orange-100 transition-colors shadow-sm" title="Passport">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if($tradie->additional_document_path)
                                                <a href="{{ asset('storage/' . $tradie->additional_document_path) }}" target="_blank" class="p-1.5 bg-green-50 text-success-green rounded-lg hover:bg-green-100 transition-colors shadow-sm" title="Doc">
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
                                            
                                            <button 
                                                @click="deleteUrl = '{{ route('tradies.destroy', $tradie) }}'; $dispatch('open-modal', 'confirm-delete')"
                                                class="p-2 text-error-red hover:bg-error-red hover:text-white rounded-lg transition-all duration-200 shadow-sm border border-gray-100"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-secondary-text italic font-medium bg-gray-50/50 uppercase tracking-widest text-xs">No tradies onboarded yet.</td>
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

        <!-- Custom Delete Confirmation Modal -->
        <x-modal name="confirm-delete" maxWidth="md" focusable>
            <form :action="deleteUrl" method="POST" class="p-6">
                @csrf
                @method('DELETE')

                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-red-50 text-error-red rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 15.667c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-roofing-blue uppercase tracking-tight">Confirm Deletion</h2>
                        <p class="text-[10px] text-secondary-text font-bold uppercase tracking-widest">This action is permanent</p>
                    </div>
                </div>

                <p class="text-secondary-text text-sm font-medium mb-6 leading-relaxed">
                    Are you sure you want to delete this tradie record? All data will be permanently removed.
                </p>

                <div class="flex justify-end gap-3">
                    <x-secondary-button x-on:click="$dispatch('close')" class="px-6 py-2 text-[10px]">
                        Cancel
                    </x-secondary-button>

                    <x-danger-button class="px-6 py-2 text-[10px] shadow-lg shadow-red-100 border-none">
                        Delete
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>


