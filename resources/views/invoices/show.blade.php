<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Invoice Details') }}: <span class="text-indigo-600">{{ $invoice->invoice_number }}</span>
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Back to List
                </a>
                <a href="{{ route('invoices.download', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:border-emerald-900 focus:ring ring-emerald-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-0">
                    <!-- Invoice Header -->
                    <div class="bg-indigo-50 px-8 py-10 border-b border-indigo-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <h1 class="text-3xl font-extrabold text-indigo-900 uppercase tracking-tight">Invoice</h1>
                            <p class="text-indigo-600 font-medium mt-1">Koala Roofer</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Invoice #</p>
                            <p class="text-xl font-mono text-gray-900">{{ $invoice->invoice_number }}</p>
                            <p class="text-sm text-gray-500 uppercase font-bold tracking-wider mt-4">Date</p>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($invoice->date)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="p-8 space-y-10">
                        <!-- Addresses -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div>
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Bill From</h3>
                                <div class="text-gray-700">
                                    <p class="font-bold text-lg text-gray-900">Koala Roofer Management</p>
                                    <p>123 Roofer Ln</p>
                                    <p>Sydney, NSW 2000</p>
                                    <p class="mt-2 text-indigo-600">contact@koalaroofer.com</p>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">To (Tradie)</h3>
                                <div class="text-gray-700">
                                    <p class="font-bold text-lg text-gray-900">{{ $invoice->tradie->name }}</p>
                                    <p>{{ $invoice->tradie->address ?: 'No address provided' }}</p>
                                    <p class="mt-2 text-indigo-600">{{ $invoice->tradie->contact_number }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Work Description -->
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Work Completed</h3>
                            <div class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $invoice->work_description }}</div>
                        </div>

                        <!-- Financial Summary -->
                        <div class="flex justify-end pt-6 border-t border-gray-100">
                            <div class="w-full md:w-1/2 space-y-4">
                                <div class="flex justify-between items-center text-gray-500">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($invoice->amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-gray-500">
                                    <span>Tax (0%)</span>
                                    <span>$0.00</span>
                                </div>
                                <div class="flex justify-between items-center bg-indigo-600 text-white p-4 rounded-lg shadow-md font-bold text-xl">
                                    <span>Total Amount</span>
                                    <span>${{ number_format($invoice->amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 text-center text-gray-400 text-sm">
                        Thank you for your hard work and contribution to Koala Roofer projects.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
