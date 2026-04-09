<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 md:gap-4 px-4 md:px-0">
            <div>
                <h2 class="font-black text-xl md:text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                    {{ __('Billing & Invoices') }}
                </h2>
                <p class="text-[10px] text-secondary-text font-bold uppercase tracking-widest mt-1">Manage financial records</p>
            </div>
            <a href="{{ route('invoices.create') }}" class="inline-flex items-center justify-center px-4 md:px-5 py-2 md:py-2.5 bg-construction-orange border border-transparent rounded-xl font-bold text-[10px] md:text-xs text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-700 transition ease-in-out duration-150 shadow-lg shadow-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 md:h-4 md:w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                New Invoice
            </a>
        </div>
        
        <!-- Search Section -->
        <div class="mt-6 px-4 md:px-0">
            <form x-ref="searchForm" action="{{ route('invoices.index') }}" method="GET" class="flex items-center gap-2 group" 
                @submit.prevent="window.dispatchEvent(new CustomEvent('perform-search'))">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <!-- Dual-state Icon -->
                        <svg x-show="!searching" class="h-5 w-5 text-slate-400 group-focus-within:text-roofing-blue transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <div x-show="searching" style="display: none;" class="w-5 h-5 border-2 border-roofing-blue/20 border-t-roofing-blue rounded-full animate-spin"></div>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by invoice # or tradie name..." 
                        class="block w-full pl-11 pr-12 py-3.5 bg-white border border-slate-100 rounded-[1.5rem] text-sm font-semibold text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-slate-100/50 focus:border-roofing-blue/30 transition-all shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]"
                        @input.debounce.500ms="window.dispatchEvent(new CustomEvent('perform-search'))">
                    
                    @if(request('search'))
                        <a href="{{ route('invoices.index') }}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-300 hover:text-error-red transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </x-slot>

    <div class="py-4 md:py-6" 
        x-data="{ 
            deleteUrl: '',
            searching: false,
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
                    document.getElementById('invoice-list-container').innerHTML = html;
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
                <div id="invoice-list-container" :class="searching ? 'opacity-50 transition-opacity' : 'opacity-100 transition-opacity'">
                    @include('invoices.partials.list')
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
                        <p class="text-[10px] text-secondary-text font-bold uppercase tracking-widest">This cannot be undone</p>
                    </div>
                </div>

                <p class="text-secondary-text text-sm font-medium mb-6 leading-relaxed">
                    Are you sure you want to delete this invoice? This will permanently remove all associated financial data.
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
