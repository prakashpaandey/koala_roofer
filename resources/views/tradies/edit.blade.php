<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-indigo-700">
            {{ __('Edit Tradie') }}: <span class="text-gray-900">{{ $tradie->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8">
                    <form action="{{ route('tradies.update', $tradie) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column: Personal info -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Personal Information</h3>
                                
                                <div>
                                    <x-input-label for="name" :value="__('Full Name *')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $tradie->name)" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="contact_number" :value="__('Contact Number *')" />
                                    <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number', $tradie->contact_number)" required />
                                    <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="address" :value="__('Address *')" />
                                    <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('address', $tradie->address) }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Right Column: Documents -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Upload Documents</h3>
                                
                                <div>
                                    <x-input-label for="photo" :value="__('Update Photo (Image only)')" />
                                    @if($tradie->photo_path)
                                        <div class="flex items-center mt-2 mb-3 bg-gray-50 p-2 rounded-lg border border-gray-100">
                                            <img src="{{ asset('storage/' . $tradie->photo_path) }}" class="w-12 h-12 object-cover rounded-full mr-3 shadow-sm" alt="Existing photo">
                                            <span class="text-xs text-gray-500">Current photo uploaded. Uploading a new one replaces it.</span>
                                        </div>
                                    @endif
                                    <input id="photo" name="photo" type="file" accept="image/*" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors" />
                                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="passport" :value="__('Update Passport (PDF/Image)')" />
                                    @if($tradie->passport_path)
                                        <div class="flex items-center mt-2 mb-3 bg-gray-50 p-2 rounded-lg border border-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-xs text-gray-500">Current passport exists. Uploading a new one replaces it.</span>
                                        </div>
                                    @endif
                                    <input id="passport" name="passport" type="file" accept="image/*,application/pdf" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-colors" />
                                    <x-input-error :messages="$errors->get('passport')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="additional_document" :value="__('Update Additional Document (PDF/Image/Doc)')" />
                                    @if($tradie->additional_document_path)
                                        <div class="flex items-center mt-2 mb-3 bg-gray-50 p-2 rounded-lg border border-gray-100">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                            <span class="text-xs text-gray-500">Current document exists. Uploading a new one replaces it.</span>
                                        </div>
                                    @endif
                                    <input id="additional_document" name="additional_document" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-colors" />
                                    <x-input-error :messages="$errors->get('additional_document')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t font-semibold">
                            <a href="{{ route('tradies.index') }}" class="text-gray-600 hover:text-gray-900 mx-4 transition-colors">Cancel Changes</a>
                            <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-700 shadow-md">
                                {{ __('Apply Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
