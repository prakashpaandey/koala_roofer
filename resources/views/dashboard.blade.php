<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
                    <div>
                        <p class="text-sm font-bold text-secondary-text uppercase tracking-widest">Total Tradies</p>
                        <p class="text-5xl font-black text-roofing-blue mt-1 tracking-tighter">{{ $tradieCount }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl text-roofing-blue group-hover:bg-roofing-blue group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
                    <div>
                        <p class="text-sm font-bold text-secondary-text uppercase tracking-widest">Total Invoices</p>
                        <p class="text-5xl font-black text-construction-orange mt-1 tracking-tighter">{{ $invoiceCount }}</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-xl text-construction-orange group-hover:bg-construction-orange group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-black text-roofing-blue uppercase tracking-tight mb-6 text-center md:text-left">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('tradies.create') }}" class="group relative overflow-hidden bg-construction-orange p-6 rounded-xl text-white font-bold text-xl shadow-lg hover:shadow-orange-200 transition-all duration-300 active:scale-95">
                        <div class="relative z-10 flex items-center justify-between">
                            <span>Add New Tradie</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </a>

                    <a href="{{ route('invoices.create') }}" class="group relative overflow-hidden bg-roofing-blue p-6 rounded-xl text-white font-bold text-xl shadow-lg hover:shadow-blue-200 transition-all duration-300 active:scale-95">
                         <div class="relative z-10 flex items-center justify-between">
                            <span>Create New Invoice</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                         <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

