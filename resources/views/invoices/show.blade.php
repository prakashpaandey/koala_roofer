<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('invoices.index') }}" class="p-2 text-roofing-blue hover:bg-blue-50 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h2 class="font-black text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                    {{ __('Invoice Details') }}: <span class="text-construction-orange">{{ $invoice->invoice_number }}</span>
                </h2>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('invoices.download', $invoice) }}" class="inline-flex items-center px-6 py-3 bg-construction-orange border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-700 transition ease-in-out duration-150 shadow-lg shadow-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-0">
                    <!-- Invoice Header Section -->
                    <div class="bg-roofing-blue px-10 py-12 text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-8 relative overflow-hidden">
                        <div class="relative z-10">
                            <img src="{{ asset('logo.png') }}" alt="Koala Roofer" class="h-16 w-auto mb-2 filter brightness-0 invert">
                            <div class="flex items-center gap-2 text-blue-200 font-bold uppercase tracking-widest text-[10px]">
                                <span class="w-8 h-px bg-construction-orange"></span>
                                Professional Management
                            </div>
                        </div>
                        <div class="text-left md:text-right relative z-10">
                            <div class="mb-4">
                                <p class="text-[10px] font-black uppercase tracking-widest text-blue-300 opacity-70">Invoice Number</p>
                                <p class="text-2xl font-black tracking-tight">{{ $invoice->invoice_number }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-blue-300 opacity-70">Date of Issue</p>
                                <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($invoice->date)->format('F d, Y') }}</p>
                            </div>
                        </div>
                        <!-- Abstract Background Element -->
                        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white opacity-5 rounded-full"></div>
                    </div>

                    <div class="p-10 space-y-12">
                        <!-- Addresses Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                            <div class="space-y-4">
                                <h3 class="text-xs font-black text-roofing-blue uppercase tracking-widest border-b border-gray-100 pb-2">Issued By</h3>
                                <div class="text-primary-text space-y-1">
                                    <p class="font-black text-xl text-roofing-blue">Koala Roofer</p>
                                    <p class="text-sm font-medium text-secondary-text">123 Narayani Way, Narayanghat</p>
                                    <p class="text-sm font-medium text-secondary-text">Bharatpur 4400, Nepal</p>
                                    <p class="pt-2 text-sm font-bold text-construction-orange">billing@koalaroofer.com</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <h3 class="text-xs font-black text-roofing-blue uppercase tracking-widest border-b border-gray-100 pb-2">Client Details</h3>
                                <div class="text-primary-text space-y-1">
                                    <p class="font-black text-xl text-roofing-blue">{{ $invoice->customer_name }}</p>
                                    <p class="text-sm font-medium text-secondary-text whitespace-pre-line">{{ $invoice->customer_address ?: 'No address provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Work Items Table -->
                        <div class="space-y-4">
                             <h3 class="text-xs font-black text-roofing-blue uppercase tracking-widest border-b border-gray-100 pb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Work Breakdown
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-soft-gray rounded-xl overflow-hidden">
                                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-roofing-blue rounded-l-xl">Service Description</th>
                                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-roofing-blue text-right rounded-r-xl w-32">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @if(is_array($invoice->items))
                                            @foreach($invoice->items as $item)
                                                <tr class="group hover:bg-slate-50 transition-colors">
                                                    <td class="px-6 py-5 text-sm font-bold text-roofing-blue/80">{{ $item['description'] }}</td>
                                                    <td class="px-6 py-5 text-sm font-black text-roofing-blue text-right">${{ number_format($item['amount'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="px-6 py-5 text-sm font-medium text-secondary-text italic">{{ $invoice->work_description }}</td>
                                                <td class="px-6 py-5 text-sm font-black text-roofing-blue text-right">${{ number_format($invoice->amount, 2) }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Financial Calculation -->
                        <div class="flex justify-end pt-8 border-t border-slate-50">
                            <div class="w-full md:w-80 space-y-3">
                                <div class="flex justify-between items-center text-secondary-text font-bold uppercase text-[9px] tracking-widest px-1">
                                    <span>Subtotal</span>
                                    <span class="text-primary-text font-black text-sm">${{ number_format($invoice->amount - $invoice->tax_amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-secondary-text font-bold uppercase text-[9px] tracking-widest px-1 pb-4 border-b border-slate-50">
                                    <span>Tax ({{ number_format($invoice->tax_percentage, 0) }}%)</span>
                                    <span class="text-primary-text font-black text-sm">${{ number_format($invoice->tax_amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center bg-roofing-blue text-white px-8 py-6 rounded-2xl shadow-xl shadow-blue-100 transform hover:scale-[1.02] transition-transform">
                                    <span class="text-[10px] font-black uppercase tracking-widest opacity-70">Total Bill</span>
                                    <span class="text-4xl font-black tracking-tighter">${{ number_format($invoice->amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Footer -->
                    <div class="px-10 py-8 bg-soft-gray/50 border-t border-gray-50 text-center">
                        <p class="text-xs font-bold text-secondary-text uppercase tracking-widest">
                            Thank you for your professionalism and hard work.
                        </p>
                        <p class="text-[10px] text-gray-400 mt-2">© {{ date('Y') }} Koala Roofer Management System. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

