<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-black text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                {{ __('Billing & Invoices') }}
            </h2>
            <a href="{{ route('invoices.create') }}" class="inline-flex items-center px-6 py-3 bg-construction-orange border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-700 transition ease-in-out duration-150 shadow-lg shadow-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create New Invoice
            </a>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ deleteUrl: '' }">
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
                                <th class="px-6 py-4">Invoice #</th>
                                <th class="px-6 py-4">Tradie</th>
                                <th class="px-6 py-4">Issue Date</th>
                                <th class="px-6 py-4 text-center">Total Amount</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($invoices as $invoice)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <th class="px-6 py-4 font-black text-roofing-blue tracking-tight">
                                        #{{ $invoice->invoice_number }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 flex-shrink-0 rounded-lg bg-gray-100 flex items-center justify-center text-roofing-blue font-black text-[10px] border border-gray-200 uppercase tracking-tighter">
                                                {{ strtoupper(substr($invoice->tradie->name, 0, 1)) }}
                                            </div>
                                            <span class="ml-3 text-sm font-bold text-primary-text">{{ $invoice->tradie->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-secondary-text font-medium">
                                        {{ \Carbon\Carbon::parse($invoice->date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-base font-black text-roofing-blue tracking-tighter">
                                            ${{ number_format($invoice->amount, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('invoices.show', $invoice) }}" class="p-2 text-roofing-blue hover:bg-roofing-blue hover:text-white rounded-lg transition-all duration-200 shadow-sm border border-gray-100" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('invoices.download', $invoice) }}" class="p-2 text-construction-orange hover:bg-construction-orange hover:text-white rounded-lg transition-all duration-200 shadow-sm border border-gray-100" title="Download">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </a>
                                            
                                            <button 
                                                @click="deleteUrl = '{{ route('invoices.destroy', $invoice) }}'; $dispatch('open-modal', 'confirm-delete')"
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
                                    <td colspan="5" class="px-6 py-12 text-center text-secondary-text italic font-medium bg-gray-50/50 uppercase tracking-widest text-xs">No invoices generated yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($invoices->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $invoices->links() }}
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
