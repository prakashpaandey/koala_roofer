<!-- Mobile Card Layout -->
<div class="grid grid-cols-1 gap-4 md:hidden mb-6">
    @forelse($tradies as $tradie)
        <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 p-5 group transition-all duration-500 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] hover:-translate-y-1 relative">
            <!-- Top Header Row (Restructured with Delete) -->
            <div class="flex items-start justify-between mb-5">
                <div class="flex items-center">
                    <div class="h-14 w-14 flex-shrink-0 rounded-2xl border-2 border-slate-50 overflow-hidden bg-slate-50 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] transition-transform duration-500 group-hover:scale-105">
                        @if($tradie->photo_path)
                            <img src="{{ asset('storage/' . $tradie->photo_path) }}" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-roofing-blue font-black bg-blue-50/50 text-base">
                                {{ strtoupper(substr($tradie->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="ml-4">
                        <div class="text-[17px] font-extrabold text-roofing-blue tracking-tight leading-tight mb-1">{{ $tradie->name }}</div>
                        <div class="inline-flex items-center px-2 py-0.5 bg-slate-100/80 backdrop-blur-sm text-slate-500 text-[8px] font-bold uppercase tracking-widest rounded-md border border-slate-100">
                            Joined {{ $tradie->created_at->format('M Y') }}
                        </div>
                    </div>
                </div>
                
                <!-- Top-level Delete Action -->
                <button 
                    @click="deleteUrl = '{{ route('tradies.destroy', $tradie) }}'; $dispatch('open-modal', 'confirm-delete')"
                    class="p-2 text-error-red/40 hover:text-error-red hover:bg-red-50 rounded-xl transition-all active:scale-90"
                    title="Delete Record"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

            <!-- Info Area (Side-by-Side Details) -->
            <div class="flex items-center justify-between mb-5 px-1 bg-slate-50/30 p-3 rounded-2xl border border-dashed border-slate-100">
                <!-- Phone -->
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-xl bg-orange-50/80 flex items-center justify-center mr-2.5 text-construction-orange shadow-sm border border-orange-100/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <span class="text-[12px] text-slate-700 font-bold tracking-tight">{{ $tradie->contact_number }}</span>
                </div>
                
                <!-- Divider -->
                <div class="h-4 w-px bg-slate-200 mx-2"></div>

                <!-- Location -->
                <div class="flex items-center flex-1 justify-end min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-blue-50/80 flex items-center justify-center mr-2.5 text-roofing-blue shadow-sm border border-blue-100/50 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] text-slate-500 font-semibold truncate">{{ $tradie->address }}</span>
                </div>
            </div>

            <!-- Documents Row (Compact Refined) -->
            @if($tradie->passport_path || $tradie->additional_document_path)
                <div class="flex items-center gap-2.5 p-3 bg-slate-50/50 rounded-2xl mb-5 border border-slate-100/50">
                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 mr-1 ml-1">Docs</span>
                    <div class="flex gap-2">
                        @if($tradie->passport_path)
                            <a href="{{ asset('storage/' . $tradie->passport_path) }}" target="_blank" class="px-3 py-1 bg-white text-construction-orange text-[9px] font-extrabold rounded-lg shadow-sm border border-slate-100 hover:bg-orange-50 transition-colors">
                                ID
                            </a>
                        @endif
                        @if($tradie->additional_document_path)
                            <a href="{{ asset('storage/' . $tradie->additional_document_path) }}" target="_blank" class="px-3 py-1 bg-white text-success-green text-[9px] font-extrabold rounded-lg shadow-sm border border-slate-100 hover:bg-green-50 transition-colors">
                                Support
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Main Actions (Premium Redesign) -->
            <div class="grid grid-cols-2 gap-3 pt-5 border-t border-slate-50">
                <a href="{{ route('tradies.edit', $tradie) }}" class="flex items-center justify-center gap-2 py-3 bg-white text-roofing-blue border border-slate-200 text-[10px] uppercase font-black rounded-2xl hover:bg-slate-50 hover:border-slate-300 transition-all active:scale-[0.97] shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <button 
                    @click="viewingTradie = {{ json_encode($tradie) }}; $dispatch('open-modal', 'view-tradie')"
                    class="flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-roofing-blue to-[#2a4d7a] text-white text-[10px] uppercase font-black rounded-2xl hover:shadow-lg hover:shadow-blue-100 transition-all active:scale-[0.97]"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View Details
                </button>
            </div>
        </div>
    @empty
        <div class="bg-white p-12 text-center rounded-2xl border border-dashed border-gray-200 text-secondary-text italic uppercase font-bold text-xs tracking-widest">
            No tradies found for your search.
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
                        <td colspan="5" class="px-6 py-12 text-center text-secondary-text italic font-medium bg-gray-50/50 uppercase tracking-widest text-xs">No tradies found for your search.</td>
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
