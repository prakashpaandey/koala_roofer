<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 md:gap-4 px-4 md:px-0">
            <div>
                <h2 class="font-black text-xl md:text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                    {{ __('Tradies Directory') }}
                </h2>
                <p class="text-[10px] text-secondary-text font-bold uppercase tracking-widest mt-1">Manage your workforce</p>
            </div>
            <a href="{{ route('tradies.create') }}" class="inline-flex items-center justify-center px-4 md:px-5 py-2 md:py-2.5 bg-construction-orange border border-transparent rounded-xl font-bold text-[10px] md:text-xs text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-700 transition ease-in-out duration-150 shadow-lg shadow-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 md:h-4 md:w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Tradie
            </a>
        </div>
        
        <!-- Search Section -->
        <div class="mt-6 px-4 md:px-0">
            <form x-ref="searchForm" action="{{ route('tradies.index') }}" method="GET" class="flex items-center gap-2 group" 
                @submit.prevent="window.dispatchEvent(new CustomEvent('perform-search'))">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <!-- Dual-state Icon: Search or Spinner -->
                        <svg x-show="!searching" class="h-5 w-5 text-gray-400 group-focus-within:text-roofing-blue transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <div x-show="searching" style="display: none;" class="w-5 h-5 border-2 border-roofing-blue/20 border-t-roofing-blue rounded-full animate-spin"></div>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, contact or address..." 
                        class="block w-full pl-11 pr-12 py-3.5 bg-white border border-slate-100 rounded-[1.5rem] text-sm font-semibold text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-slate-100/50 focus:border-roofing-blue/30 transition-all shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]"
                        @input.debounce.500ms="window.dispatchEvent(new CustomEvent('perform-search'))">
                    
                    @if(request('search'))
                        <a href="{{ route('tradies.index') }}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-error-red transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
                
                <button type="submit" class="hidden sm:flex items-center justify-center px-6 py-3.5 bg-roofing-blue text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-100 hover:bg-opacity-90 transition-all">
                    Search
                </button>
                
                <button type="submit" class="sm:hidden flex items-center justify-center w-12 h-12 bg-roofing-blue text-white rounded-2xl shadow-lg shadow-blue-100 active:scale-95 transition-all">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-4 md:py-6" 
        x-data="{ 
            deleteUrl: '',
            searching: false,
            viewingTradie: null,
            async performSearch() {
                this.searching = true;
                const searchForm = document.querySelector('[x-ref=\'searchForm\']');
                const formData = new FormData(searchForm);
                const query = new URLSearchParams(formData).toString();
                const url = `${searchForm.action}?${query}`;

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const html = await response.text();
                    document.getElementById('tradie-list-container').innerHTML = html;
                    window.history.pushState({}, '', url);
                } catch (error) {
                    console.error('AJAX Search failed:', error);
                } finally {
                    this.searching = false;
                }
            }
        }"
        x-on:perform-search.window="performSearch()"
    >
        <div class="max-w-7xl mx-auto px-4 md:px-0">
            @if(session('success'))
                <div class="mb-4 md:mb-6 p-4 bg-success-green/10 border-l-4 border-success-green text-success-green rounded-r-xl font-bold animate-pulse text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="relative min-h-[400px]">
                <div id="tradie-list-container" :class="searching ? 'opacity-50 transition-opacity' : 'opacity-100 transition-opacity'">
                    @include('tradies.partials.list')
                </div>
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

        <!-- View Details Modal (Premium) -->
        <x-modal name="view-tradie" maxWidth="lg" focusable>
            <div class="p-0 overflow-hidden rounded-[2rem]" x-if="viewingTradie">
                <div class="p-8">
                    <!-- Modal Header with Photo -->
                    <div class="flex items-start gap-6 mb-8 pb-8 border-b border-slate-100">
                        <div class="h-24 w-24 flex-shrink-0 rounded-3xl border-4 border-slate-50 overflow-hidden shadow-xl">
                            <template x-if="viewingTradie?.photo_path">
                                <img :src="'/storage/' + viewingTradie.photo_path" class="h-full w-full object-cover">
                            </template>
                            <template x-if="!viewingTradie?.photo_path">
                                <div class="h-full w-full flex items-center justify-center text-roofing-blue font-black bg-blue-50 text-3xl" x-text="viewingTradie?.name?.charAt(0).toUpperCase()"></div>
                            </template>
                        </div>
                        <div class="flex-1 pt-2">
                            <h3 class="text-2xl font-black text-roofing-blue uppercase tracking-tight mb-2" x-text="viewingTradie.name"></h3>
                            <div class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-widest rounded-lg border border-slate-200">
                                Onboarded in <span class="ml-1" x-text="new Date(viewingTradie.created_at).toLocaleDateString(undefined, { month: 'long', year: 'numeric' })"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-1">
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Contact Number</p>
                            <div class="flex items-center gap-3 text-slate-700">
                                <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center text-construction-orange">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                </div>
                                <p class="text-base font-bold" x-text="viewingTradie.contact_number"></p>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Current Address</p>
                            <div class="flex items-center gap-3 text-slate-700">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-roofing-blue">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                                <p class="text-[13px] font-semibold leading-snug" x-text="viewingTradie.address"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="space-y-4">
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-50 pb-2">Verification Documents</p>
                        <div class="grid grid-cols-2 gap-4">
                            <template x-if="viewingTradie.passport_path">
                                <a :href="'/storage/' + viewingTradie.passport_path" target="_blank" class="flex flex-col gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-orange-200 transition-all hover:bg-orange-50 group">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-roofing-blue">ID/Passport</span>
                                        <svg class="h-4 w-4 text-construction-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-500 group-hover:text-construction-orange transition-colors">Open Document</span>
                                </a>
                            </template>
                            <template x-if="viewingTradie.additional_document_path">
                                <a :href="'/storage/' + viewingTradie.additional_document_path" target="_blank" class="flex flex-col gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-green-200 transition-all hover:bg-green-50 group">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-roofing-blue">Support Doc</span>
                                        <svg class="h-4 w-4 text-success-green" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-500 group-hover:text-success-green transition-colors">Open Document</span>
                                </a>
                            </template>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="mt-10 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl px-8 py-3 text-[10px] font-black uppercase tracking-widest border-slate-200">
                            Close Profile
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </x-modal>
    </div>
</x-app-layout>


