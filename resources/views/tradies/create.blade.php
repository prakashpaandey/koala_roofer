<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Tradie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8">
                    <form action="{{ route('tradies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column: Personal info -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Personal Information</h3>
                                
                                <div>
                                    <x-input-label for="name" :value="__('Full Name *')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="contact_number" :value="__('Contact Number *')" />
                                    <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number')" required />
                                    <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="address" :value="__('Address *')" />
                                    <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('address') }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Right Column: Documents -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Documents & Photo</h3>
                                
                                <div>
                                    <x-input-label for="photo" :value="__('Photo (Image only)')" />
                                    <input id="photo" name="photo" type="file" accept="image/*" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors" />
                                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="passport" :value="__('Passport (PDF/Image)')" />
                                    <input id="passport" name="passport" type="file" accept="image/*,application/pdf" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-colors" />
                                    <x-input-error :messages="$errors->get('passport')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="additional_document" :value="__('Additional Document (PDF/Image/Doc)')" />
                                    <input id="additional_document" name="additional_document" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-colors" />
                                    <x-input-error :messages="$errors->get('additional_document')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t">
                            <a href="{{ route('tradies.index') }}" class="text-gray-600 hover:text-gray-900 mx-4 transition-colors">Cancel</a>
                            <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                                {{ __('Create Tradie') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
