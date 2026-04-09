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
                            addItem() {
                                this.items.push({ description: '', amount: 0 });
                            },
                            removeItem(index) {
                                if (this.items.length > 1) {
                                    this.items.splice(index, 1);
                                }
                            },
                            total() {
                                return this.items.reduce((acc, item) => acc + parseFloat(item.amount || 0), 0);
                            }
                        }"
                        class="max-w-5xl mx-auto space-y-8"
                    >
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Section: Customer & Invoice Details -->
                            <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 space-y-8 h-full">
                                <div class="border-b border-slate-50 pb-4 flex items-center gap-3">
                                    <div class="p-2 bg-blue-50 text-roofing-blue rounded-xl">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-black text-roofing-blue uppercase tracking-widest">Client & Identification</h3>
                                        <p class="text-[9px] text-secondary-text mt-0.5 font-bold uppercase tracking-wider">Who is this for?</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-6">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="group">
                                            <x-input-label for="invoice_number" :value="__('Invoice #')" class="text-[10px] font-black uppercase tracking-widest text-slate-400" />
                                            <x-text-input id="invoice_number" class="block mt-2 w-full border-slate-100 bg-slate-50/50 focus:bg-white text-sm font-bold" type="text" name="invoice_number" :value="old('invoice_number', '#KR-' . rand(10000, 99999))" required />
                                            <x-input-error :messages="$errors->get('invoice_number')" class="mt-2" />
                                        </div>

                                        <div class="group">
                                            <x-input-label for="date" :value="__('Date')" class="text-[10px] font-black uppercase tracking-widest text-slate-400" />
                                            <x-text-input id="date" class="block mt-2 w-full border-slate-100 bg-slate-50/50 focus:bg-white text-sm font-bold text-roofing-blue" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="group">
                                        <x-input-label for="customer_name" :value="__('Customer Name')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-focus-within:text-construction-orange transition-colors" />
                                        <x-text-input id="customer_name" class="block mt-2 w-full border-slate-100 bg-slate-50/50 focus:bg-white text-sm font-bold" type="text" name="customer_name" :value="old('customer_name')" required placeholder="e.g. Steve Smith" />
                                        <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                                    </div>

                                    <div class="group">
                                        <x-input-label for="customer_address" :value="__('Customer Address')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-focus-within:text-construction-orange transition-colors" />
                                        <textarea id="customer_address" name="customer_address" rows="3" class="block mt-2 w-full border-slate-100 bg-slate-50/50 focus:bg-white focus:border-construction-orange focus:ring-construction-orange rounded-2xl shadow-sm text-sm font-bold transition-all transition-colors duration-200" required placeholder="Street, City, Postcode">{{ old('customer_address') }}</textarea>
                                        <x-input-error :messages="$errors->get('customer_address')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Line Items & Summary -->
                            <div class="flex flex-col gap-6">
                                <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 flex-1">
                                    <div class="border-b border-slate-50 pb-4 flex items-center justify-between mb-8">
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-orange-50 text-construction-orange rounded-xl">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </div>
                                            <h3 class="text-sm font-black text-roofing-blue uppercase tracking-widest">Work Details</h3>
                                        </div>
                                        <button type="button" @click="addItem()" class="p-2 bg-blue-50 text-roofing-blue rounded-xl hover:bg-roofing-blue hover:text-white transition-all transform active:scale-95">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                        </button>
                                    </div>

                                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                        <template x-for="(item, index) in items" :key="index">
                                            <div class="flex items-start gap-3 p-4 bg-slate-50/50 rounded-2xl border border-slate-100 relative group">
                                                <div class="flex-1 space-y-3">
                                                    <div>
                                                        <label class="text-[8px] font-black uppercase text-slate-400">Description</label>
                                                        <input type="text" :name="`items[${index}][description]`" x-model="item.description" required
                                                            class="block w-full mt-1 bg-white border-slate-200 focus:border-construction-orange focus:ring-construction-orange rounded-xl text-xs font-bold transition-all py-2"
                                                            placeholder="e.g. Install Solar Panels">
                                                    </div>
                                                    <div>
                                                        <label class="text-[8px] font-black uppercase text-slate-400">Amount ($)</label>
                                                        <input type="number" step="0.01" :name="`items[${index}][amount]`" x-model="item.amount" required
                                                            class="block w-full mt-1 bg-white border-slate-200 focus:border-construction-orange focus:ring-construction-orange rounded-xl text-xs font-black text-roofing-blue py-2"
                                                            placeholder="0.00">
                                                    </div>
                                                </div>
                                                <button type="button" @click="removeItem(index)" x-show="items.length > 1"
                                                    class="mt-6 p-1.5 text-slate-300 hover:text-error-red transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Financial Summary Card -->
                                <div class="bg-roofing-blue rounded-[2rem] shadow-xl p-8 text-white relative overflow-hidden">
                                     <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-bl-full -mr-10 -mt-10"></div>
                                     <div class="relative">
                                         <p class="text-[10px] font-black uppercase tracking-widest opacity-60 mb-2">Grand Total Bill</p>
                                         <div class="flex items-baseline gap-1">
                                             <span class="text-xl font-bold opacity-40">$</span>
                                             <span class="text-4xl font-black tracking-tighter" x-text="total().toLocaleString(undefined, {minimumFractionDigits: 2})">0.00</span>
                                         </div>
                                     </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-6 pt-10 px-4 md:px-0">
                            <a href="{{ route('invoices.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-roofing-blue transition-colors">Cancel Draft</a>
                            <x-primary-button class="px-12 py-4 shadow-xl shadow-orange-100 rounded-2xl">
                                {{ __('Complete & Generate Invoice') }}
                            </x-primary-button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

