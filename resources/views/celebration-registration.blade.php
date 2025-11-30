@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="flex justify-center mb-6">
                <div class=" p-3 rounded-full ">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-20 w-15 text-indigo-600">
                </div>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-3">OCECF 20th Celebration Registration</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join us for our special 20th anniversary celebration. Please complete the registration form below with accurate information.</p>

            <!-- Event Dates -->
            <div class="mt-6 rounded-xl shadow-md p-4 max-w-2xl mx-auto">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Event Schedule</h3>
                <ul class="text-left space-y-1 text-gray-700">
                    <li class="flex items-start">
                        <span class="text-indigo-600 mr-2">•</span>
                        <span><strong>8th January 2025 (Thursday)</strong> - Only Ex-Cadet Entry Allowed</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-indigo-600 mr-2">•</span>
                        <span><strong>9th January 2025 (Friday)</strong> - Ex-Cadet with Family Allowed</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Registration Card -->
        <div class=" rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Registration Form</h2>
                        <p class="text-indigo-200 text-sm mt-1">All fields marked with <span class="text-red-300">*</span> are required</p>
                    </div>
                    <div class="hidden md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-5 mx-6 mt-6 rounded-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-5 mx-6 mt-6 rounded-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                        <ul class="mt-2 list-disc pl-5 space-y-1 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <!-- Registration Form -->
            <form action="{{ route('celebration.registration.submit') }}" method="POST" enctype="multipart/form-data" class="px-6 py-8">
                @csrf

                <!-- Passport Size Photo (Top of Form) -->
                <div class="mb-10">
                    <label class="block text-lg font-medium text-gray-900 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Passport Size Photo <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-indigo-300 border-dashed rounded-xl bg-indigo-50">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-indigo-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-indigo-600">
                                <label for="passport_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="passport_photo" name="passport_photo" type="file" class="sr-only" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-indigo-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Please upload a clear passport size photo</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Personal Information Section -->
                        <div class="border-b border-gray-200 pb-5">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h3>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Mobile Number (WhatsApp) <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input type="tel" name="mobile_num" value="{{ old('mobile_num') }}" required
                                    placeholder="e.g., 01XXXXXXXXX"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Bangladesh mobile number format (01XXXXXXXXX)</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Full Address <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <textarea name="address" rows="3" required
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">{{ old('address') }}</textarea>
                            </div>
                        </div>

                        <!-- Emergency Contact -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Emergency Contact <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <input type="tel" name="emergency_contact" value="{{ old('emergency_contact') }}" required
                                    placeholder="e.g., 01XXXXXXXXX"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Bangladesh mobile number format (01XXXXXXXXX)</p>
                        </div>

                        <!-- NID -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                National ID (NID) <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input type="text" name="nid" value="{{ old('nid') }}" required
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                        </div>

                        <!-- BNCC Batch -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                BNCC Batch (Mention Year) <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="text" name="bncc_batch" value="{{ old('bncc_batch') }}" required
                                    placeholder="e.g., 2015, 2016, etc."
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                        </div>

                        <!-- Religion -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Religion <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="religion_islam" name="religion" type="radio" value="Islam" {{ old('religion') == 'Islam' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="religion_islam" class="ml-3 block text-sm font-medium text-gray-700">Islam</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="religion_hinduism" name="religion" type="radio" value="Hinduism" {{ old('religion') == 'Hinduism' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="religion_hinduism" class="ml-3 block text-sm font-medium text-gray-700">Hinduism</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="religion_christianity" name="religion" type="radio" value="Christianity" {{ old('religion') == 'Christianity' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="religion_christianity" class="ml-3 block text-sm font-medium text-gray-700">Christianity</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="religion_buddhism" name="religion" type="radio" value="Buddhism" {{ old('religion') == 'Buddhism' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="religion_buddhism" class="ml-3 block text-sm font-medium text-gray-700">Buddhism</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="religion_others" name="religion" type="radio" value="Others" {{ old('religion') == 'Others' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="religion_others" class="ml-3 block text-sm font-medium text-gray-700">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Event Details Section -->
                        <div class="border-b border-gray-200 pb-5">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Event Details
                            </h3>
                        </div>

                        <!-- Family Members -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Number of Additional Family Members <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <input type="number" name="family_members" id="family_members" value="{{ old('family_members', 0) }}" min="0" max="50" required
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Enter the number of additional family members attending (you are automatically included)</p>
                        </div>

                        <!-- Children Count -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Number of Children (Below 5 years)
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                </div>
                                <input type="number" name="children_count" id="children_count" value="{{ old('children_count', 0) }}" min="0" max="20"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Children below 5 years are free but need to be counted</p>
                        </div>

                        <!-- Has Children Under Five -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Do you bring any children under the age of five? <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="children_yes" name="has_children_under_five" type="radio" value="1" {{ old('has_children_under_five') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="children_yes" class="ml-3 block text-sm font-medium text-gray-700">Yes</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="children_no" name="has_children_under_five" type="radio" value="0" {{ old('has_children_under_five') === '0' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="children_no" class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Has Driver -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Will you bring a driver?
                            </label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="driver_yes" name="has_driver" type="radio" value="1" {{ old('has_driver') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <label for="driver_yes" class="ml-3 block text-sm font-medium text-gray-700">Yes</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="driver_no" name="has_driver" type="radio" value="0" {{ old('has_driver') === '0' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <label for="driver_no" class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Attend Thursday Night -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Would you attend on Thursday Night (Ex-Cadet Only)? <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="wednesday_yes" name="attend_wednesday_night" type="radio" value="1" {{ old('attend_wednesday_night') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="wednesday_yes" class="ml-3 block text-sm font-medium text-gray-700">Yes</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="wednesday_no" name="attend_wednesday_night" type="radio" value="0" {{ old('attend_wednesday_night') === '0' ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                    <label for="wednesday_no" class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Amount Display -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-xl border border-blue-100">
                            <div class="flex justify-between items-center mb-3">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Payment Summary:</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Base Amount:</span>
                                    <span id="base_amount" class="text-sm font-medium text-gray-800">BDT 1500</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Cashout Fee:</span>
                                    <span id="cashout_fee" class="text-sm font-medium text-gray-800">BDT 0</span>
                                </div>
                                <div class="flex justify-between pt-2 border-t border-gray-200">
                                    <span class="text-base font-medium text-gray-900">Total Amount:</span>
                                    <span id="total_amount" class="text-xl font-bold text-indigo-700">BDT 1500</span>
                                </div>
                            </div>
                            <div class="mt-3 text-xs text-gray-600">
                                <p>• Single Registration (You): BDT 1500</p>
                                <p>• Additional Family Members: BDT 1000 each</p>
                                <p>• Driver: BDT 500</p>
                                <p class="mt-1 font-medium">• Cashout Fee: 10 BDT for up to 500, 20 BDT for up to 1000, 30 BDT for up to 1500, then 2% for higher amounts (not applicable for Bank transfers)</p>
                            </div>
                        </div>

                        <!-- Payment Information Section -->
                        <div class="border-b border-gray-200 pb-5">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Payment Information
                            </h3>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Payment Method <span class="text-red-500">*</span>
                            </label>
                            <select name="payment_method" required
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full py-3 sm:text-sm border-gray-300 rounded-lg border">
                                <option value="">Select Payment Method</option>
                                <!-- <option value="Bank" {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>Bank</option> -->
                                <option value="Bkash" {{ old('payment_method') == 'Bkash' ? 'selected' : '' }}>Bkash</option>
                                <option value="Nagad" {{ old('payment_method') == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                                <option value="Rocket" {{ old('payment_method') == 'Rocket' ? 'selected' : '' }}>Rocket</option>
                            </select>
                        </div>

                        <!-- Transaction Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Transaction Number <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <input type="text" name="transaction_number" value="{{ old('transaction_number') }}" required
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-3 sm:text-sm border-gray-300 rounded-lg border">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Screenshot (Bottom of Form) -->
                <div class="mt-10">
                    <label class="block text-lg font-medium text-gray-900 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Transaction Screenshot <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-indigo-300 border-dashed rounded-xl bg-indigo-50">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-indigo-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-indigo-600">
                                <label for="transaction_screenshot" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="transaction_screenshot" name="transaction_screenshot" type="file" class="sr-only" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-indigo-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Please upload a clear screenshot of your payment transaction</p>
                </div>

                <!-- Contact Information -->
                <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Contact Information</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p><strong>ATM Kawser Habib</strong> - 01815199111 (Program Convenor, OCECF 20th Celebration)</p>
                                <p><strong>Abdul Aziz</strong> - 01821225000 (Program Secretary, OCECF 20th Celebration)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-10">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Submit Registration
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Note -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">Need help? Contact us at <a href="mailto:support@ocecf.org" class="text-indigo-600 hover:text-indigo-500">support@ocecf.org</a></p>
        </div>
    </div>
</div>

<script>
    // Calculate amount based on family members and driver
    function calculateAmount() {
        const familyMembers = parseInt(document.getElementById('family_members').value) || 0;
        const hasDriver = document.querySelector('input[name="has_driver"]:checked')?.value === '1';
        const paymentMethod = document.querySelector('select[name="payment_method"]').value;

        // Pricing configuration
        const singleRegistrationRate = 1500; // BDT for single registration
        const familyMemberRate = 1000;       // BDT per family member (additional)
        const driverRate = 500;              // BDT per driver

        // Calculate base amount
        // Family members field represents additional family members (excluding the registrant)
        // So total people = 1 (registrant) + familyMembers (additional)
        const baseAmount = singleRegistrationRate +
                          (familyMembers * familyMemberRate) +
                          (hasDriver ? driverRate : 0);

        // Calculate cashout fee
        let cashoutFee = 0;
        // Only calculate cashout fee for Bkash, Nagad, Rocket
        if (['Bkash', 'Nagad', 'Rocket'].includes(paymentMethod)) {
            if (baseAmount <= 500) {
                cashoutFee = 10;
            } else if (baseAmount <= 1000) {
                cashoutFee = 20;
            } else if (baseAmount <= 1500) {
                cashoutFee = 30;
            } else {
                // For amounts above 1500, calculate proportionally
                // 30 Taka for first 1500, then 2% for the rest
                const baseFee = 30;
                const remainingAmount = baseAmount - 1500;
                let additionalFee = remainingAmount * 0.02;
                // Round to nearest 10
                additionalFee = Math.round(additionalFee / 10) * 10;
                cashoutFee = baseFee + additionalFee;
            }
        }
        // For Bank transfers or when no payment method is selected, cashout fee is 0

        // Calculate total amount
        const totalAmount = baseAmount + cashoutFee;

        // Update the displays
        document.getElementById('base_amount').textContent = 'BDT ' + baseAmount;
        document.getElementById('cashout_fee').textContent = 'BDT ' + cashoutFee;
        document.getElementById('total_amount').textContent = 'BDT ' + totalAmount;
    }

    // Add event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Calculate on page load
        calculateAmount();

        // Recalculate when family members count changes
        document.getElementById('family_members').addEventListener('input', calculateAmount);

        // Recalculate when driver option changes
        const driverOptions = document.querySelectorAll('input[name="has_driver"]');
        driverOptions.forEach(option => {
            option.addEventListener('change', calculateAmount);
        });

        // Recalculate when payment method changes
        document.querySelector('select[name="payment_method"]').addEventListener('change', calculateAmount);
    });
</script>
@endsection