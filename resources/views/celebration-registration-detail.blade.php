@extends('layouts.dashboard')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Registration Details</h1>
                <p class="mt-1 text-sm text-gray-600">Registration ID: #{{ $reg->id }}</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
                <a href="{{ route('celebration.registrations.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="mr-2 h-6 w-6 text-indigo-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Personal Information
                    </h2>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500 flex items-center">
                                <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Full Name
                            </dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->name }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500 flex items-center">
                                <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Address
                            </dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->email }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500 flex items-center">
                                <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Mobile Number (WhatsApp)
                            </dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->mobile_num }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500 flex items-center">
                                <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Emergency Contact
                            </dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->emergency_contact }}</dd>
                        </div>
                        <div class="md:col-span-2 border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500 flex items-center">
                                <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Full Address
                            </dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->address }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500 flex items-center">
                                <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                National ID (NID)
                            </dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->nid ?? 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Registration Details -->
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-blue-500 to-indigo-600">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="mr-2 h-6 w-6 text-blue-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Registration Details
                    </h2>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500">Family Members</dt>
                            <dd class="mt-1 text-2xl font-bold text-gray-900">{{ $reg->family_members }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500">Children (Below 5)</dt>
                            <dd class="mt-1 text-2xl font-bold text-gray-900">{{ $reg->children_count }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500">Driver</dt>
                            <dd class="mt-1">
                                @if($reg->has_driver)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="mr-1.5 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Yes (BDT 200)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        <svg class="mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        No
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->payment_method }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500">Transaction Number</dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->transaction_number }}</dd>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <dt class="text-sm font-medium text-gray-500">Registration Date</dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">{{ $reg->created_at->format('F j, Y, g:i A') }}</dd>
                        </div>
                        <div class="md:col-span-2 border-2 border-blue-200 rounded-lg p-4 bg-blue-50">
                            <dt class="text-sm font-medium text-blue-700">Total Amount</dt>
                            <dd class="mt-1 text-3xl font-bold text-blue-800">BDT {{ number_format($reg->amount, 2) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Amount Breakdown -->
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-green-500 to-emerald-600">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="mr-2 h-6 w-6 text-green-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Payment Summary
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg class="mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-gray-600">Registration Fee</span>
                            </div>
                            <span class="font-medium">BDT {{ number_format($reg->amount - $reg->cashout_fee, 2) }}</span>
                        </div>
                        @if($reg->cashout_fee > 0)
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg class="mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-600">Cashout Fee</span>
                            </div>
                            <span class="font-medium">BDT {{ number_format($reg->cashout_fee, 2) }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between pt-4 border-t border-gray-200">
                            <span class="text-lg font-semibold text-gray-900">Total Amount</span>
                            <span class="text-2xl font-bold text-green-700">BDT {{ number_format($reg->amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passport Photo -->
            @if($reg->passport_photo)
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-amber-500 to-orange-600">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="mr-2 h-6 w-6 text-amber-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Passport Photo
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex justify-center">
                        <img src="/storage/{{ $reg->passport_photo }}" alt="Passport Photo" class="max-w-full h-auto rounded-lg shadow-lg border border-gray-200">
                    </div>
                </div>
            </div>
            @endif

            <!-- Transaction Screenshot -->
            @if($reg->transaction_screenshot)
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-teal-500 to-cyan-600">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="mr-2 h-6 w-6 text-teal-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Transaction Screenshot
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex justify-center">
                        <img src="/storage/{{ $reg->transaction_screenshot }}" alt="Transaction Screenshot" class="max-w-full h-auto rounded-lg shadow-lg border border-gray-200">
                    </div>
                </div>
            </div>
            @endif

            <!-- Actions -->
            @if($user['type'] == 1)
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-red-500 to-rose-600">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="mr-2 h-6 w-6 text-red-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Admin Actions
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <a href="{{ route('celebration.registration.print', $reg->id) }}" target="_blank" class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Registration Form
                    </a>
                    <form action="{{ route('celebration.registration.destroy', $reg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this registration? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-700 hover:to-rose-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Registration
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection