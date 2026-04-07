<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8">
                    @if($tradies->isEmpty())
                        <div class="p-6 bg-amber-50 border-l-4 border-amber-400 text-amber-700 rounded-md">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 15.667c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="font-bold">No Tradies Found!</p>
                                    <p class="text-sm">You need to add at least one tradie before you can create an invoice. <a href="{{ route('tradies.create') }}" class="underline font-bold">Add one here.</a></p>
                                </div>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Left Column: Core Invoice Info -->
                                <div class="space-y-6">
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Invoice Details</h3>
                                    
                                    <div>
                                        <x-input-label for="tradie_id" :value="__('Select Tradie')" />
                                        <select id="tradie_id" name="tradie_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                            <option value="">-- Choose a Tradie --</option>
                                            @foreach($tradies as $tradie)
                                                <option value="{{ $tradie->id }}" {{ old('tradie_id') == $tradie->id ? 'selected' : '' }}>{{ $tradie->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('tradie_id')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="invoice_number" :value="__('Invoice Number')" />
                                        <x-text-input id="invoice_number" class="block mt-1 w-full" type="text" name="invoice_number" :value="old('invoice_number', 'KR-' . date('YmdHis'))" required />
                                        <x-input-error :messages="$errors->get('invoice_number')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="date" :value="__('Invoice Date')" />
                                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Right Column: Description & Amount -->
                                <div class="space-y-6">
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Work & Financials</h3>
                                    
                                    <div>
                                        <x-input-label for="work_description" :value="__('Work Description')" />
                                        <textarea id="work_description" name="work_description" rows="5" class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm" placeholder="Briefly describe the work completed..." required>{{ old('work_description') }}</textarea>
                                        <x-input-error :messages="$errors->get('work_description')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="amount" :value="__('Total Amount ($)')" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">$</div>
                                            <x-text-input id="amount" class="block pl-7 w-full font-bold text-lg text-emerald-700 bg-emerald-50 border-emerald-200" type="number" step="0.01" name="amount" :value="old('amount')" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t font-semibold">
                                <a href="{{ route('invoices.index') }}" class="text-gray-600 hover:text-gray-900 mx-4 transition-colors">Cancel</a>
                                <x-primary-button class="ml-4 bg-emerald-600 hover:bg-emerald-700 shadow-md">
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
