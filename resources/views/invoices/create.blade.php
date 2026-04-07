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
                        <form action="{{ route('invoices.store') }}" method="POST" class="max-w-4xl mx-auto space-y-12">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                <!-- Left Column: Core Invoice Info -->
                                <div class="space-y-8">
                                    <div class="border-b border-gray-100 pb-4">
                                        <h3 class="text-lg font-black text-roofing-blue uppercase tracking-tight">Invoice Details</h3>
                                        <p class="text-xs text-secondary-text mt-1 font-medium">Basic billing identification</p>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <x-input-label for="tradie_id" :value="__('Select Tradie')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue" />
                                            <select id="tradie_id" name="tradie_id" class="block mt-1 w-full border-gray-200 focus:border-construction-orange focus:ring-construction-orange rounded-xl shadow-sm transition-all" required>
                                                <option value="">-- Choose a Tradie --</option>
                                                @foreach($tradies as $tradie)
                                                    <option value="{{ $tradie->id }}" {{ old('tradie_id') == $tradie->id ? 'selected' : '' }}>{{ $tradie->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('tradie_id')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-input-label for="invoice_number" :value="__('Invoice Number')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue" />
                                            <x-text-input id="invoice_number" class="block mt-1 w-full border-gray-200 focus:border-construction-orange focus:ring-construction-orange shadow-sm" type="text" name="invoice_number" :value="old('invoice_number', 'KR-' . date('YmdHis'))" required />
                                            <x-input-error :messages="$errors->get('invoice_number')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-input-label for="date" :value="__('Invoice Date')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue" />
                                            <x-text-input id="date" class="block mt-1 w-full border-gray-200 focus:border-construction-orange focus:ring-construction-orange shadow-sm font-bold text-roofing-blue" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Description & Amount -->
                                <div class="space-y-8">
                                    <div class="border-b border-gray-100 pb-4">
                                        <h3 class="text-lg font-black text-roofing-blue uppercase tracking-tight">Financials</h3>
                                        <p class="text-xs text-secondary-text mt-1 font-medium">Work description and billing amount</p>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <x-input-label for="work_description" :value="__('Work Description')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue" />
                                            <textarea id="work_description" name="work_description" rows="5" class="block mt-1 w-full border-gray-200 focus:border-construction-orange focus:ring-construction-orange rounded-xl shadow-sm transition-all" placeholder="Describe the service provided..." required>{{ old('work_description') }}</textarea>
                                            <x-input-error :messages="$errors->get('work_description')" class="mt-2" />
                                        </div>

                                        <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
                                            <x-input-label for="amount" :value="__('Total Billing Amount ($)')" class="text-xs font-black uppercase tracking-wider text-roofing-blue mb-2" />
                                            <div class="relative group">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-roofing-blue/50 font-black text-xl">$</div>
                                                <input id="amount" class="block pl-9 w-full bg-white border-gray-200 focus:border-construction-orange focus:ring-construction-orange rounded-xl shadow-sm font-black text-2xl text-roofing-blue transition-all" type="number" step="0.01" name="amount" :value="old('amount')" required placeholder="0.00" />
                                            </div>
                                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-100">
                                <a href="{{ route('invoices.index') }}" class="px-6 py-3 text-sm font-bold text-secondary-text hover:text-roofing-blue transition-colors">Discard Draft</a>
                                <x-primary-button class="px-10 py-3 shadow-xl hover:shadow-orange-200 active:scale-95 transition-all">
                                    {{ __('Generate Invoice') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

