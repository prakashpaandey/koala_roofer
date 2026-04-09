<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('tradies.index') }}" class="p-2 text-roofing-blue dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-800 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-black text-2xl text-roofing-blue dark:text-gray-100 leading-tight uppercase tracking-tight">
                {{ __('Edit Tradie') }}: <span class="text-construction-orange">{{ $tradie->name }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 md:px-0">
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-slate-800 transition-colors duration-300">
                <div class="p-8 md:p-12">
                    <form action="{{ route('tradies.update', $tradie) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto space-y-12">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <!-- Left Column: Personal info -->
                            <div class="space-y-8">
                                <div class="border-b border-gray-100 dark:border-slate-800 pb-4">
                                    <h3 class="text-lg font-black text-roofing-blue dark:text-blue-400 uppercase tracking-tight">Personal Information</h3>
                                    <p class="text-xs text-secondary-text dark:text-slate-500 mt-1 font-medium">Update the core contact details</p>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="name" :value="__('Full Name *')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
                                        <x-text-input id="name" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange shadow-sm" type="text" name="name" :value="old('name', $tradie->name)" required autofocus />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="contact_number" :value="__('Contact Number *')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
                                        <x-text-input id="contact_number" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange shadow-sm" type="text" name="contact_number" :value="old('contact_number', $tradie->contact_number)" required />
                                        <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="address" :value="__('Working Address *')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
                                        <textarea id="address" name="address" rows="4" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange rounded-xl shadow-sm transition-all" required>{{ old('address', $tradie->address) }}</textarea>
                                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Documents -->
                            <div class="space-y-8">
                                <div class="border-b border-gray-100 dark:border-slate-800 pb-4">
                                    <h3 class="text-lg font-black text-roofing-blue dark:text-blue-400 uppercase tracking-tight">File Management</h3>
                                    <p class="text-xs text-secondary-text dark:text-slate-500 mt-1 font-medium">Manage verification and ID documents</p>
                                </div>
                                
                                <div class="space-y-6">
                                    <div class="p-4 bg-gray-50 dark:bg-slate-950/50 rounded-xl border border-dashed border-gray-200 dark:border-slate-800 group hover:border-roofing-blue dark:hover:border-blue-400 transition-colors">
                                        <x-input-label for="photo" :value="__('Update Photo')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
                                        @if($tradie->photo_path)
                                            <div class="flex items-center my-3 p-2 bg-white dark:bg-slate-900 rounded-lg border border-gray-100 dark:border-slate-800 shadow-sm animate-in fade-in zoom-in duration-300">
                                                <img src="{{ asset('storage/' . $tradie->photo_path) }}" class="w-10 h-10 object-cover rounded-full mr-3 ring-2 ring-gray-50 dark:ring-slate-800" alt="Current photo">
                                                <span class="text-[10px] font-bold text-secondary-text dark:text-slate-500 uppercase">Current File Active</span>
                                            </div>
                                        @endif
                                        <input id="photo" name="photo" type="file" accept="image/*" class="block mt-2 w-full text-xs text-secondary-text dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-roofing-blue dark:file:bg-slate-800 file:text-white dark:file:text-blue-400 hover:file:bg-blue-900 dark:hover:file:bg-slate-700 transition-colors" />
                                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                    </div>

                                    <div class="p-4 bg-gray-50 dark:bg-slate-950/50 rounded-xl border border-dashed border-gray-200 dark:border-slate-800 group hover:border-construction-orange dark:hover:border-orange-600 transition-colors">
                                        <x-input-label for="passport" :value="__('Update Passport / ID')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
                                        @if($tradie->passport_path)
                                            <div class="flex items-center my-3 p-2 bg-white dark:bg-slate-900 rounded-lg border border-gray-100 dark:border-slate-800 shadow-sm">
                                                <div class="p-2 bg-orange-50 dark:bg-slate-800 rounded-lg text-construction-orange mr-3 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </div>
                                                <span class="text-[10px] font-bold text-secondary-text dark:text-slate-500 uppercase">Current Passport Saved</span>
                                            </div>
                                        @endif
                                        <input id="passport" name="passport" type="file" accept="image/*,application/pdf" class="block mt-2 w-full text-xs text-secondary-text dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-construction-orange dark:file:bg-slate-800 file:text-white dark:file:text-orange-500 hover:file:bg-orange-600 dark:hover:file:bg-slate-700 transition-colors" />
                                        <x-input-error :messages="$errors->get('passport')" class="mt-2" />
                                    </div>

                                    <div class="p-4 bg-gray-50 dark:bg-slate-950/50 rounded-xl border border-dashed border-gray-200 dark:border-slate-800 group hover:border-success-green dark:hover:border-green-600 transition-colors">
                                        <x-input-label for="additional_document" :value="__('Update Additional Doc')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
                                        @if($tradie->additional_document_path)
                                            <div class="flex items-center my-3 p-2 bg-white dark:bg-slate-900 rounded-lg border border-gray-100 dark:border-slate-800 shadow-sm">
                                                 <div class="p-2 bg-green-50 dark:bg-slate-800 rounded-lg text-success-green mr-3 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                                <span class="text-[10px] font-bold text-secondary-text dark:text-slate-500 uppercase">Document Uploaded</span>
                                            </div>
                                        @endif
                                        <input id="additional_document" name="additional_document" type="file" class="block mt-2 w-full text-xs text-secondary-text dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-success-green dark:file:bg-slate-800 file:text-white dark:file:text-green-500 hover:file:bg-green-700 dark:hover:file:bg-slate-700 transition-colors" />
                                        <x-input-error :messages="$errors->get('additional_document')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-100 dark:border-slate-800">
                            <a href="{{ route('tradies.index') }}" class="px-6 py-3 text-sm font-bold text-secondary-text dark:text-slate-500 hover:text-roofing-blue dark:hover:text-gray-300 transition-colors">Discard Changes</a>
                            <x-primary-button class="px-10 py-3 shadow-xl hover:shadow-orange-200 dark:shadow-none active:scale-95 transition-all">
                                {{ __('Update Tradie') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

