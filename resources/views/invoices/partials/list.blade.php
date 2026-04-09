<!-- Mobile Card Layout (Premium Compact) -->
<div class="grid grid-cols-1 gap-4 md:hidden mb-6">
    @forelse($invoices as $invoice)
        <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 p-5 group transition-all duration-500 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] hover:-translate-y-1 relative">
            
            <!-- Floating Delete Action -->
            <button 
                @click="deleteUrl = '{{ route('invoices.destroy', $invoice) }}'; $dispatch('open-modal', 'confirm-delete')"
                class="absolute top-4 right-4 p-2 text-error-red/40 hover:text-error-red hover:bg-red-50 rounded-xl transition-all active:scale-90"
                title="Delete Invoice"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>

            <!-- Card Header (Side-by-Side Meta) -->
            <div class="mb-4 pr-10">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[8px] font-black uppercase tracking-widest rounded transition-colors group-hover:bg-blue-50/50">Invoice</span>
                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">{{ \Carbon\Carbon::parse($invoice->date)->format('M d, Y') }}</span>
                </div>
                <div class="text-lg font-black text-roofing-blue tracking-tighter break-all leading-tight">
                    {{ $invoice->invoice_number }}
                </div>
            </div>

            <!-- Amount Section (Construction Orange Focus) -->
            <div class="bg-orange-50/50 rounded-2xl p-4 flex items-center justify-between border border-orange-100/30 mb-4 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]">
                <span class="text-[10px] font-black text-roofing-blue/40 uppercase tracking-widest">Amount Due</span>
                <span class="text-2xl font-black text-construction-orange tracking-tighter transition-transform group-hover:scale-105 duration-500">${{ number_format($invoice->amount, 2) }}</span>
            </div>

            <!-- Customer Info (Blue Branded) -->
            <div class="flex items-center p-3 bg-slate-50/50 rounded-2xl mb-5 border border-dashed border-slate-200/60">
                <div class="h-8 w-8 rounded-xl flex items-center justify-center bg-white text-roofing-blue text-[10px] font-black border border-slate-100 shadow-sm mr-3">
                    {{ strtoupper(substr($invoice->customer_name ?? $invoice->tradie->name ?? '?', 0, 1)) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-[8px] font-black uppercase tracking-widest text-slate-400 mb-0.5">Customer</span>
                    <span class="text-sm font-extrabold text-roofing-blue tracking-tight">{{ $invoice->customer_name ?? $invoice->tradie->name }}</span>
                </div>
            </div>

            <!-- Action Row (Premium UI) -->
            <div class="flex items-center gap-2.5 pt-4 border-t border-slate-50">
                <a href="{{ route('invoices.show', $invoice) }}" class="flex-1 flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-roofing-blue to-[#2a4d7a] text-white text-[9px] uppercase font-black rounded-2xl hover:shadow-lg hover:shadow-blue-100 transition-all active:scale-[0.97]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View
                </a>
                <a href="{{ route('invoices.download', $invoice) }}" class="flex-1 flex items-center justify-center gap-2 py-3 bg-white text-construction-orange text-[9px] uppercase font-black rounded-2xl border border-orange-100 hover:bg-orange-50 transition-all active:scale-[0.97] shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    PDF
                </a>
            </div>
        </div>
    @empty
        <div class="bg-white p-12 text-center rounded-[2rem] border border-dashed border-slate-200 text-slate-400 italic uppercase font-bold text-[10px] tracking-widest shadow-sm">
            No invoices found for your search.
        </div>
    @endforelse
</div>

<!-- Table View (Desktop Only) -->
<div class="hidden md:block bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] border border-slate-100/50">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-roofing-blue text-white uppercase text-[10px] tracking-widest font-black">
                    <th class="px-8 py-5">Invoice #</th>
                    <th class="px-8 py-5">Customer</th>
                    <th class="px-8 py-5">Issue Date</th>
                    <th class="px-8 py-5 text-center">Total Amount</th>
                    <th class="px-8 py-5 text-right whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($invoices as $invoice)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <th class="px-8 py-5 font-black text-roofing-blue tracking-tight text-sm">
                            {{ $invoice->invoice_number }}
                        </th>
                        <td class="px-8 py-5">
                            <div class="flex items-center">
                                <div class="h-9 w-9 flex-shrink-0 rounded-xl bg-slate-50 flex items-center justify-center text-roofing-blue font-black text-[11px] border border-slate-100 uppercase tracking-tighter">
                                    {{ strtoupper(substr($invoice->customer_name ?? $invoice->tradie->name ?? '?', 0, 1)) }}
                                </div>
                                <span class="ml-4 text-[13px] font-bold text-slate-700">{{ $invoice->customer_name ?? $invoice->tradie->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-xs text-slate-500 font-medium">
                            {{ \Carbon\Carbon::parse($invoice->date)->format('M d, Y') }}
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="text-[17px] font-extrabold text-roofing-blue tracking-tighter">
                                ${{ number_format($invoice->amount, 2) }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('invoices.show', $invoice) }}" class="p-2.5 text-roofing-blue hover:bg-roofing-blue hover:text-white rounded-xl transition-all duration-300 shadow-sm border border-slate-100" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('invoices.download', $invoice) }}" class="p-2.5 text-construction-orange hover:bg-construction-orange hover:text-white rounded-xl transition-all duration-300 shadow-sm border border-slate-100" title="Download PDF">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                                <button 
                                    @click="deleteUrl = '{{ route('invoices.destroy', $invoice) }}'; $dispatch('open-modal', 'confirm-delete')"
                                    class="p-2.5 text-error-red/50 hover:bg-error-red hover:text-white rounded-xl transition-all duration-300 shadow-sm border border-slate-100"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-16 text-center text-slate-400 italic font-bold bg-slate-50/20 uppercase tracking-widest text-[10px]">No invoices found matching your criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($invoices->hasPages())
    <div class="mt-8 px-4 md:px-0">
        {{ $invoices->links() }}
    </div>
@endif
