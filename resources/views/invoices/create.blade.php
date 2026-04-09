<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('invoices.index') }}" class="p-2 text-roofing-blue hover:bg-blue-50 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-black text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                {{ __('Create New Invoice') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-8 md:p-12">
                    @if($tradies->isEmpty())
                        <div class="p-10 bg-warning-yellow/10 border-2 border-dashed border-warning-yellow rounded-2xl text-center">
                            <div class="flex flex-col items-center max-w-sm mx-auto">
                                <div class="bg-warning-yellow p-4 rounded-full text-white mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 15.667c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black text-roofing-blue uppercase tracking-tight mb-2">No Tradies Found!</h3>
                                <p class="text-secondary-text font-medium text-sm mb-6">You need to add at least one tradie to your directory before you can issue an invoice.</p>
                                <a href="{{ route('tradies.create') }}" class="px-8 py-3 bg-construction-orange text-white font-black rounded-xl shadow-lg hover:shadow-orange-100 transition-all uppercase tracking-widest text-xs">
                                    Onboard a Tradie
                                </a>
                            </div>
                        </div>
                    @else
                    <form action="{{ route('invoices.store') }}" method="POST" 
                        x-data="{ 
                            items: [{ description: '', amount: 0 }],
                            tax_percentage: {{ $defaultTaxRate ?? 0 }},
                            is_saving_tax: false,
                            show_tax_success: false,
                            addItem() {
                                this.items.push({ description: '', amount: 0 });
                            },
                            removeItem(index) {
                                if (this.items.length > 1) {
                                    this.items.splice(index, 1);
                                }
                            },
                            subtotal() {
                                return this.items.reduce((acc, item) => acc + parseFloat(item.amount || 0), 0);
                            },
                            taxAmount() {
                                return (this.subtotal() * this.tax_percentage) / 100;
                            },
                            total() {
                                return this.subtotal() + this.taxAmount();
                            },
                            async setPermanentTax() {
                                this.is_saving_tax = true;
                                try {
                                    const response = await fetch('{{ route('settings.tax-rate') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ rate: this.tax_percentage })
                                    });
                                    const data = await response.json();
                                    if (data.success) {
                                        this.show_tax_success = true;
                                        setTimeout(() => { this.show_tax_success = false; }, 3000);
                                    } else {
                                        alert('Error: ' + (data.message || 'Unknown error'));
                                    }
                                } catch (e) {
                                    console.error('Error saving tax rate:', e);
                                    alert('Failed to save tax rate. Please check your connection.');
                                } finally {
                                    this.is_saving_tax = false;
                                }
                            }
                        }"
                        class="max-w-6xl mx-auto space-y-4 md:space-y-6"
                    >
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-6">
                            <!-- Left Column: Primary Details -->
                            <div class="lg:col-span-4 space-y-4 md:space-y-6">
                                <!-- Section: Customer & Invoice Details -->
                                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-5 md:p-6 space-y-5">
                                    <div class="border-b border-slate-50 pb-3 flex items-center gap-3">
                                        <div class="p-1.5 bg-blue-50 text-roofing-blue rounded-lg">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        </div>
                                        <h3 class="text-[11px] font-black text-roofing-blue uppercase tracking-widest">Client & ID</h3>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <input type="hidden" name="tax_percentage" x-model="tax_percentage">
                                        
                                        <div class="grid grid-cols-2 gap-3">
                                            <div class="group">
                                                <x-input-label for="invoice_number" :value="__('Invoice #')" class="text-[9px] font-bold uppercase text-slate-400 mb-1" />
                                                <x-text-input id="invoice_number" class="block w-full border-slate-200 bg-slate-50/30 focus:bg-white text-xs font-bold py-2" type="text" name="invoice_number" :value="old('invoice_number', '#KR-' . rand(1000, 9999))" required />
                                            </div>
                                            <div class="group">
                                                <x-input-label for="date" :value="__('Date')" class="text-[9px] font-bold uppercase text-slate-400 mb-1" />
                                                <x-text-input id="date" class="block w-full border-slate-200 bg-slate-50/30 focus:bg-white text-xs font-bold text-roofing-blue py-2" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                                            </div>
                                        </div>

                                        <!-- Tax Configuration: Compact -->
                                        <div class="bg-blue-50/30 rounded-xl p-3 border border-blue-100/50">
                                             <div class="flex items-center justify-between mb-1.5">
                                                <x-input-label for="tax_input" :value="__('Tax (%)')" class="text-[8px] font-black uppercase text-roofing-blue" />
                                                <button type="button" @click="setPermanentTax()" 
                                                    class="text-[7px] font-black uppercase tracking-widest text-roofing-blue hover:text-construction-orange transition-colors"
                                                    :disabled="is_saving_tax">
                                                    <span x-text="is_saving_tax ? '...' : 'Set Permanent'"></span>
                                                </button>
                                             </div>
                                             <x-text-input id="tax_input" class="block w-full border-white bg-white/80 focus:bg-white text-xs font-black text-roofing-blue py-1.5" type="number" step="0.1" x-model="tax_percentage" />
                                         </div>

                                        <div class="group">
                                            <x-input-label for="customer_name" :value="__('Customer')" class="text-[9px] font-bold uppercase text-slate-400 mb-1" />
                                            <x-text-input id="customer_name" class="block w-full border-slate-200 bg-slate-50/30 focus:bg-white text-xs font-bold py-2" type="text" name="customer_name" :value="old('customer_name')" required placeholder="Steve Smith" />
                                        </div>

                                        <div class="group">
                                            <x-input-label for="customer_address" :value="__('Address')" class="text-[9px] font-bold uppercase text-slate-400 mb-1" />
                                            <textarea id="customer_address" name="customer_address" rows="2" class="block w-full border-slate-200 bg-slate-50/30 focus:bg-white focus:border-construction-orange focus:ring-construction-orange rounded-xl text-xs font-bold transition-all py-2" required placeholder="Street, City, P.C.">{{ old('customer_address') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Line Items & Summary -->
                            <div class="lg:col-span-8 flex flex-col gap-4 md:gap-6">
                                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-5 md:p-6 flex-1 flex flex-col min-h-[400px]">
                                    <div class="border-b border-slate-50 pb-3 flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="p-1.5 bg-orange-50 text-construction-orange rounded-lg">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </div>
                                            <h3 class="text-[11px] font-black text-roofing-blue uppercase tracking-widest">Work Breakdown</h3>
                                        </div>
                                        <button type="button" @click="addItem()" class="flex items-center gap-2 px-3 py-1.5 bg-blue-50 text-roofing-blue text-[10px] font-black rounded-lg hover:bg-roofing-blue hover:text-white transition-all transform active:scale-95 uppercase tracking-tighter">
                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                                            Add Service
                                        </button>
                                    </div>

                                    <!-- Service Table Header (Hidden on Mobile) -->
                                    <div class="hidden md:grid grid-cols-12 gap-3 px-4 mb-2">
                                        <div class="col-span-1 text-[8px] font-black text-slate-400 uppercase">S.N.</div>
                                        <div class="col-span-8 text-[8px] font-black text-slate-400 uppercase">Description of Service</div>
                                        <div class="col-span-2 text-[8px] font-black text-slate-400 uppercase text-right">Amount ($)</div>
                                        <div class="col-span-1"></div>
                                    </div>

                                    <!-- Scrollable Items Area -->
                                    <div class="space-y-2 flex-1 overflow-y-auto pr-1 custom-scrollbar" style="max-height: 450px;">
                                        <template x-for="(item, index) in items" :key="index">
                                            <div class="group flex flex-col md:grid md:grid-cols-12 md:items-center gap-2 md:gap-3 p-3 md:p-2 bg-slate-50/50 md:bg-transparent rounded-xl md:rounded-none border border-slate-100 md:border-0 md:border-b md:border-slate-50 relative hover:bg-slate-50/80 transition-colors">
                                                <!-- MOBILE LABELS & S.N. -->
                                                <div class="md:col-span-1 flex items-center justify-between">
                                                    <span class="text-[10px] md:text-xs font-black text-slate-300" x-text="(index + 1) + '.'"></span>
                                                    <span class="md:hidden text-[7px] font-black uppercase text-slate-400">Item Details</span>
                                                </div>

                                                <!-- DESCRIPTION -->
                                                <div class="md:col-span-8">
                                                    <input type="text" :name="`items[${index}][description]`" x-model="item.description" required
                                                        class="block w-full bg-white border-slate-200 focus:border-construction-orange focus:ring-1 focus:ring-construction-orange rounded-lg text-xs font-bold py-2 px-3 transition-all"
                                                        placeholder="e.g. Roof Inspection & Repair">
                                                </div>

                                                <!-- AMOUNT -->
                                                <div class="md:col-span-2 flex items-center gap-2">
                                                    <span class="md:hidden text-[7px] font-black uppercase text-slate-400">Amount:</span>
                                                    <div class="relative w-full">
                                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-300">$</span>
                                                        <input type="number" step="0.01" :name="`items[${index}][amount]`" x-model="item.amount" required
                                                            class="block w-full bg-slate-50 border-slate-200 focus:border-construction-orange focus:ring-1 focus:ring-construction-orange rounded-lg text-[13px] font-black text-roofing-blue text-right py-2 pl-7 pr-3 transition-all"
                                                            placeholder="0.00">
                                                    </div>
                                                </div>

                                                <!-- REMOVE ACTION -->
                                                <div class="md:col-span-1 flex justify-end">
                                                    <button type="button" @click="removeItem(index)" x-show="items.length > 1"
                                                        class="p-1.5 text-slate-300 hover:text-error-red transition-colors rounded-lg hover:bg-red-50">
                                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Summary Row inside Card -->
                                    <div class="mt-4 pt-4 border-t border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div class="flex gap-4 items-center">
                                            <div class="text-right">
                                                <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest">Subtotal</p>
                                                <p class="text-xs font-black text-roofing-blue">$<span x-text="subtotal().toLocaleString(undefined, {minimumFractionDigits: 2})">0.00</span></p>
                                            </div>
                                            <div class="text-right border-l border-slate-100 pl-4">
                                                <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest">Tax (<span x-text="tax_percentage"></span>%)</p>
                                                <p class="text-xs font-black text-roofing-blue">$<span x-text="taxAmount().toLocaleString(undefined, {minimumFractionDigits: 2})">0.00</span></p>
                                            </div>
                                        </div>

                                        <div class="bg-roofing-blue rounded-2xl px-6 py-3 text-white flex items-center justify-between md:justify-end md:gap-8 flex-1 md:flex-none">
                                            <span class="text-[8px] font-black uppercase tracking-widest opacity-60">Grand Total</span>
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-xs font-bold opacity-40">$</span>
                                                <span class="text-xl font-black tracking-tighter" x-text="total().toLocaleString(undefined, {minimumFractionDigits: 2})">0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-center justify-end gap-3 md:gap-6 pb-10">
                            <a href="{{ route('invoices.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-roofing-blue transition-colors">Cancel Draft</a>
                            <x-primary-button class="w-full md:w-auto px-12 py-3.5 shadow-xl shadow-orange-100 rounded-2xl text-xs">
                                {{ __('Generate & Save Invoice') }}
                            </x-primary-button>
                        </div>

                        <!-- Success Toast Notification -->
                        <div x-show="show_tax_success" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-4"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform translate-y-4"
                             class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50 bg-roofing-blue text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-white/10"
                             x-cloak>
                            <div class="p-2 bg-construction-orange rounded-full text-white">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-black uppercase tracking-widest">Settings Saved</span>
                                <span class="text-[10px] font-bold opacity-70">Tax rate updated permanently.</span>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

