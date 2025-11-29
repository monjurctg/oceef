<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omargoni MES College Ex-Cadet Registration - Edit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Hind Siliguri', Arial, sans-serif;
            background-color: #f9fafb;
            min-height: 100vh;
            padding: 2rem 1rem;
        }
        .form-section {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 0.5rem;
        }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background: #f9fafb;
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px #3b82f6;
        }
        .radio-label {
            display: inline-flex;
            align-items: center;
            margin-right: 1rem;
            font-size: 0.875rem;
            color: #374151;
        }
        .radio-input {
            margin-right: 0.5rem;
        }
        .btn-submit {
            background: #2563eb;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
        }
        .btn-submit:hover {
            background: #1d4ed8;
        }
        .training-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .training-table th, .training-table td {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            text-align: left;
        }
        .training-table th {
            background: #f3f4f6;
            font-weight: 500;
        }
        .error-message {
            display: block;
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            margin-bottom: 0.5rem;
        }
        .year-range-container {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .year-range-inputs {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    @if (session('success'))
        <div id="successMessage" class="mb-4 px-4 py-3 text-green-800 bg-green-100 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div id="formLoader" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="text-white text-lg font-semibold animate-pulse">Processing...</div>
    </div>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-blue-800 text-white py-4 px-6">
                <h1 class="text-2xl font-bold text-center">Edit Omargani MES College Ex-Cadet Data</h1>
            </div>
            <p class="bg-red-600 shadow-md py-4 px-6 text-white text-justify">
                বিশেষ নোটঃ সম্মানিত প্রাক্তন ক্যাডেটবৃন্দ, নিম্নোক্ত ফরমটি শুধু মাত্র B02 অপশনটি ব্যাতিত সম্পূর্ণ ফরমটি ইংরেজীতে পূরনের অনুরোধ রইল। ফরম পূরণে সহযোগীতার জন্য OCECF এর রেজিষ্ট্রেশন কমিটির যে কোন সদস্যের সহযোগীতা নিতে পারেন। ধন্যবাদ।
            </p>
            <form id="registrationForm" method="POST" action="{{ route('register.update', $registration->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-section">
                    <h2 class="form-title">(A) Cadetship Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="form-label">A01. Cadetship Year<br><span class="text-sm text-gray-600 font-normal">এ০১. কোন সাল থেকে কোন সাল পর্যন্ত ক্যাডেট ছিলেন</span></label>
                            <div class="year-range-container">
                                <div class="year-range-inputs">
                                    <input required type="number" name="cadetship_start" id="cadetship_start" class="form-input w-full" value="{{ explode('-', $registration->cadetship_year)[0] ?? '' }}" />
                                    <span class="self-center text-gray-500">to</span>
                                    <input required type="number" name="cadetship_end" id="cadetship_end" class="form-input w-full" value="{{ explode('-', $registration->cadetship_year)[1] ?? '' }}" />
                                </div>
                            </div>
                            <input type="hidden" name="cadetship_year" id="cadetship_year" value="{{ $registration->cadetship_year }}" />
                        </div>
                        <div>
                            <label class="form-label">A02. Cadet No<br><span class="text-sm text-gray-600 font-normal">এ০২. ক্যাডেট নম্বর</span></label>
                            <input type="text" name="cadetship_no" class="form-input w-full" value="{{ $registration->cadetship_no }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">A03. Last Rank<br><span class="text-sm text-gray-600 font-normal">এ০৩. সর্বশেষ পদবী</span></label>
                            <select name="last_rank" class="form-input text-sm">
                                <option value="">Select Rank</option>
                                <option value="Cadet" {{ $registration->last_rank == 'Cadet' ? 'selected' : '' }}>Cadet</option>
                                <option value="Lance Corporal (LCPL)" {{ $registration->last_rank == 'Lance Corporal (LCPL)' ? 'selected' : '' }}>Lance Corporal (LCPL)</option>
                                <option value="Corporal (CPL)" {{ $registration->last_rank == 'Corporal (CPL)' ? 'selected' : '' }}>Corporal (CPL)</option>
                                <option value="Sergeant (SGT)" {{ $registration->last_rank == 'Sergeant (SGT)' ? 'selected' : '' }}>Sergeant (SGT)</option>
                                <option value="Cadet Under Officer (CUO)" {{ $registration->last_rank == 'Cadet Under Officer (CUO)' ? 'selected' : '' }}>Cadet Under Officer (CUO)</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">A04. Last Appointment<br><span class="text-gray-600">এ০৪. সর্বশেষ দায়িত্ব</span></label>
                            <input type="text" name="last_appointment" class="form-input" value="{{ $registration->last_appointment }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">A05. Were you the cadet in charge of this platoon?<br><span class="text-gray-600">এ০৫. আপনি কি প্লাটুনের ক্যাডেট ইনচার্জ ছিলেন?</span></label>
                            <div class="radio-group">
                                <div class="flex space-x-4">
                                    <label class="radio-label"><input type="radio" name="platoon_leader" value="YES" class="radio-input" {{ $registration->platoon_leader == 'YES' ? 'checked' : '' }}> YES</label>
                                    <label class="radio-label"><input type="radio" name="platoon_leader" value="NO" class="radio-input" {{ $registration->platoon_leader == 'NO' ? 'checked' : '' }}> NO</label>
                                </div>
                            </div>
                        </div>
                        <div id="platoonYearContainer" class="{{ $registration->platoon_leader == 'YES' ? '' : 'hidden' }}">
                            <label class="form-label">A06. From which year to which year were you in charge of the platoon?<br><span class="text-gray-600">এ০৬. কত সাল থেকে কত সাল পর্যন্ত আপনি ক্যাডেট ইনচার্জের দায়িত্ব পালন করেছেন?</span></label>
                            <div class="year-range-container">
                                <div class="year-range-inputs">
                                    <input type="number" name="platoon_start" id="platoon_start" class="form-input w-full" value="{{ explode('-', $registration->platoon_year)[0] ?? '' }}" />
                                    <span class="self-center text-gray-500">to</span>
                                    <input type="number" name="platoon_end" id="platoon_end" class="form-input w-full" value="{{ explode('-', $registration->platoon_year)[1] ?? '' }}" />
                                </div>
                            </div>
                            <input type="hidden" name="platoon_year" id="platoon_year" value="{{ $registration->platoon_year }}" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">A07. The Training Camp that you participated in:<br><span class="text-gray-600">এ০৭. কোন কোন প্রশিক্ষণে আপনি অংশগ্রহণ করেছেন?</span></label>
                        <div class="overflow-x-auto">
                            <table class="training-table min-w-full border border-gray-200" id="trainingCampTable">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="p-2 border-b text-left">No.</th>
                                        <th class="p-2 border-b text-left">Training/Camp Name</th>
                                        <th class="p-2 border-b text-left">Camp Appointment</th>
                                        <th class="p-2 border-b text-left">Rank</th>
                                        <th class="p-2 border-b text-left">Year</th>
                                        <th class="p-2 border-b text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="trainingCampBody">
                                    @foreach (json_decode($registration->training_camps, true) as $index => $camp)
                                        <tr>
                                            <td class="p-2 border-b">{{ $index + 1 }}</td>
                                            <td class="p-2 border-b"><input type="text" name="training_camp_name[]" class="form-input border-none bg-transparent w-full min-w-40" value="{{ $camp['name'] }}" /></td>
                                            <td class="p-2 border-b"><input type="text" name="training_camp_appointment[]" class="form-input border-none bg-transparent w-full" value="{{ $camp['camp_appointment'] }}" /></td>
                                            <td class="p-2 border-b">
                                                <select name="training_camp_rank[]" class="form-input border-none bg-transparent w-full text-sm">
                                                    <option value="">Select Rank</option>
                                                    <option value="Cadet" {{ $camp['rank'] == 'Cadet' ? 'selected' : '' }}>Cadet</option>
                                                    <option value="Lance Corporal (LCPL)" {{ $camp['rank'] == 'Lance Corporal (LCPL)' ? 'selected' : '' }}>Lance Corporal (LCPL)</option>
                                                    <option value="Corporal (CPL)" {{ $camp['rank'] == 'Corporal (CPL)' ? 'selected' : '' }}>Corporal (CPL)</option>
                                                    <option value="Sergeant (SGT)" {{ $camp['rank'] == 'Sergeant (SGT)' ? 'selected' : '' }}>Sergeant (SGT)</option>
                                                    <option value="Cadet Under Officer (CUO)" {{ $camp['rank'] == 'Cadet Under Officer (CUO)' ? 'selected' : '' }}>Cadet Under Officer (CUO)</option>
                                                </select>
                                            </td>
                                            <td class="p-2 border-b"><input type="text" name="training_camp_year[]" class="form-input border-none bg-transparent w-full" value="{{ $camp['year'] }}" /></td>
                                            <td class="p-2 border-b"><button type="button" onclick="removeRow(this)" class="text-red-500">−</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" onclick="addRow()" class="mt-2 px-4 py-1 bg-blue-500 text-white rounded">+ Add Row</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">A08. Name of your Cadet in-charge<br><span class="text-sm text-gray-600 font-normal">এ০৮. আপনার ক্যাডেট ইনচার্জের নাম লিখুন</span></label>
                            <input required type="text" name="cadet_incharge" class="form-input" value="{{ $registration->cadet_incharge }}" />
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label">A09. Which of the following BNCC officers from this platoon did you know during your time?<br><span class="text-sm text-gray-600 font-normal">এ০৯. আপনার সময়ে নিম্নোক্ত অত্র প্লাটুনের কোন বিএনসিসি অফিসারকে আপনি চেনেন?</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @php
                                $officers = [
                                    "Lt.Col (Retd) Prof. A.N.M Gias Uddin Chowdhury",
                                    "Major (Retd) Prof. Hamida Chowdhury",
                                    "Lt. (Retd) Morshed kuli Khan",
                                    "Lt. Abu Nayeem Md Ibrahim Chowdhury",
                                    "Lt. Shahana Yasmin"
                                ];
                                $selectedOfficers = json_decode($registration->bncc_officers_names, true) ?? [];
                            @endphp
                            @foreach ($officers as $officer)
                                <label class="flex items-center space-x-3 bg-white border rounded-lg p-3 shadow-sm hover:shadow-md transition">
                                    <input type="checkbox" name="bncc_officers_names[]" value="{{ $officer }}" class="form-checkbox text-blue-600 h-5 w-5" {{ in_array($officer, $selectedOfficers) ? 'checked' : '' }}>
                                    <span class="text-gray-700 text-sm">{{ $officer }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">A10. Were you previously a junior division cadet?<br><span class="text-gray-600">এ১০. আপনি কি পূর্বে জুনিয়র ডিভিশনের ক্যাডেট ছিলেন?</span></label>
                            <div class="radio-group">
                                <div class="flex space-x-4">
                                    <label class="radio-label"><input type="radio" name="isJuniorDivision" value="YES" class="radio-input" onchange="toggleJuniorFields()" {{ $registration->junior_division == 'YES' ? 'checked' : '' }}> YES</label>
                                    <label class="radio-label"><input type="radio" name="isJuniorDivision" value="NO" class="radio-input" onchange="toggleJuniorFields()" {{ $registration->junior_division == 'NO' ? 'checked' : '' }}> NO</label>
                                </div>
                            </div>
                        </div>
                        <div id="juniorInstitutionContainer" class="{{ $registration->junior_division == 'YES' ? '' : 'hidden' }}">
                            <label class="form-label">A11. If yes, name of your institution<br><span class="text-gray-600">এ১১. উত্তর হ্যাঁ হলে আপনার প্রতিষ্ঠানের নাম উল্লেখ করুন</span></label>
                            <input type="text" name="junior_institution" class="form-input" value="{{ $registration->junior_institution }}" />
                        </div>
                    </div>
                    <div id="juniorFields" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 {{ $registration->junior_division == 'YES' ? '' : 'hidden' }}">
                        <div>
                            <label class="form-label">A12. Junior Division Last Rank<br><span class="text-sm text-gray-600 font-normal">এ১২. জুনিয়র ডিভিশনে আপনার সর্বশেষ পদবী কি ছিল?</span></label>
                            <select name="junior_last_rank" class="form-input text-sm">
                                <option value="">পদবী নির্বাচন করুন</option>
                                <option value="Cadet" {{ $registration->junior_last_rank == 'Cadet' ? 'selected' : '' }}>Cadet</option>
                                <option value="Lance Corporal (LCPL)" {{ $registration->junior_last_rank == 'Lance Corporal (LCPL)' ? 'selected' : '' }}>Lance Corporal (LCPL)</option>
                                <option value="Corporal (CPL)" {{ $registration->junior_last_rank == 'Corporal (CPL)' ? 'selected' : '' }}>Corporal (CPL)</option>
                                <option value="Sergeant (SGT)" {{ $registration->junior_last_rank == 'Sergeant (SGT)' ? 'selected' : '' }}>Sergeant (SGT)</option>
                                <option value="Cadet Under Officer (CUO)" {{ $registration->junior_last_rank == 'Cadet Under Officer (CUO)' ? 'selected' : '' }}>Cadet Under Officer (CUO)</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">A13. Junior Division Cadetship Year<br><span class="text-sm text-gray-600 font-normal">এ১৩. কত সাল থেকে কত সাল আপনি জুনিয়র ডিভিশনের ক্যাডেট ছিলেন?</span></label>
                            <div class="year-range-container">
                                <div class="year-range-inputs">
                                    <input type="number" name="junior_start" id="junior_start" class="form-input w-1/3" value="{{ explode('-', $registration->junior_cadetship_year)[0] ?? '' }}" />
                                    <span class="text-gray-600">to</span>
                                    <input type="number" name="junior_end" id="junior_end" class="form-input w-1/3" value="{{ explode('-', $registration->junior_cadetship_year)[1] ?? '' }}" />
                                </div>
                            </div>
                            <input type="hidden" name="junior_cadetship_year" id="junior_cadetship_year" value="{{ $registration->junior_cadetship_year }}" />
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="form-title">(B) Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">B01. Full Name (English)<br><span class="text-gray-600">বি০১. আপনার পূর্ণ নাম ইংরেজিতে লিখুন</span></label>
                            <input type="text" name="full_name_en" class="form-input text-sm" value="{{ $registration->full_name_en }}" />
                        </div>
                        <div>
                            <label class="form-label">B02. Full Name (Bangla)<br><span class="text-gray-600">বি০২. আপনার পূর্ণ নাম বাংলায় লিখুন</span></label>
                            <input type="text" name="full_name_bn" class="form-input text-sm" value="{{ $registration->full_name_bn }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">B03. Father's Name<br><span class="text-gray-600">বি০৩. পিতার নাম লিখুন</span></label>
                            <input type="text" name="father_name" class="form-input text-sm" value="{{ $registration->father_name }}" />
                        </div>
                        <div>
                            <label class="form-label">B04. Mother's Name<br><span class="text-gray-600">বি০৪. মাতার নাম লিখুন</span></label>
                            <input type="text" name="mother_name" class="form-input text-sm" value="{{ $registration->mother_name }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">B05. Date of Birth<br><span class="text-gray-600">বি০৫. জন্ম তারিখ উল্লেখ করুন</span></label>
                            <input type="date" name="dob" class="form-input text-sm" value="{{ $registration->dob }}" />
                        </div>
                        <div>
                            <label class="form-label">B06. NID Number<br><span class="text-gray-600">বি০৬. জাতীয় পরিচয়পত্র নম্বর</span></label>
                            <input type="text" name="nid_number" class="form-input text-sm" value="{{ $registration->nid_number }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">B07. Religion<br><span class="text-gray-600">বি০৭. ধর্ম</span></label>
                            <select name="religion" class="form-input text-sm">
                                <option value="">Select / নির্বাচন করুন</option>
                                <option value="Islam" {{ $registration->religion == 'Islam' ? 'selected' : '' }}>Islam / ইসলাম</option>
                                <option value="Hinduism" {{ $registration->religion == 'Hinduism' ? 'selected' : '' }}>Hinduism / হিন্দু</option>
                                <option value="Buddhism" {{ $registration->religion == 'Buddhism' ? 'selected' : '' }}>Buddhism / বৌদ্ধ</option>
                                <option value="Christianity" {{ $registration->religion == 'Christianity' ? 'selected' : '' }}>Christianity / খ্রিস্টান</option>
                                <option value="Other" {{ $registration->religion == 'Other' ? 'selected' : '' }}>Other / অন্যান্য</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">B08. Blood Group<br><span class="text-gray-600">বি০৮. রক্তের গ্রুপ</span></label>
                            <select name="blood_group" class="form-input text-sm">
                                <option value="">Select / নির্বাচন করুন</option>
                                <option value="A+" {{ $registration->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ $registration->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ $registration->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ $registration->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ $registration->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ $registration->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ $registration->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ $registration->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">B09. Occupation<br><span class="text-sm text-gray-600 font-normal">বি০৯. পেশা</span></label>
                        <select name="occupation" class="form-input text-sm">
                            <option value="">পেশা নির্বাচন করুন</option>
                            <option value="Private Service" {{ $registration->occupation == 'Private Service' ? 'selected' : '' }}>Private Service</option>
                            <option value="Banker" {{ $registration->occupation == 'Banker' ? 'selected' : '' }}>Banker</option>
                            <option value="Lawyer" {{ $registration->occupation == 'Lawyer' ? 'selected' : '' }}>Lawyer</option>
                            <option value="Engineer" {{ $registration->occupation == 'Engineer' ? 'selected' : '' }}>Engineer</option>
                            <option value="Doctor" {{ $registration->occupation == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                            <option value="Government Employee" {{ $registration->occupation == 'Government Employee' ? 'selected' : '' }}>Government Employee</option>
                            <option value="Business Owner" {{ $registration->occupation == 'Business Owner' ? 'selected' : '' }}>Business Owner</option>
                            <option value="Self Employed" {{ $registration->occupation == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                            <option value="Others" {{ $registration->occupation == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="form-title">(C) Contact Information</h2>
                    <div class="mb-4">
                        <label class="form-label">C01. Present Address<br><span class="text-gray-600">সি০১. বর্তমান ঠিকানা</span></label>
                        <textarea name="present_address" rows="2" class="form-input text-sm">{{ $registration->present_address }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">C02. Permanent Address<br><span class="text-gray-600">সি০২. স্থায়ী ঠিকানা</span></label>
                        <textarea name="permanent_address" rows="2" class="form-input text-sm">{{ $registration->permanent_address }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="form-label">C03. Personal Cell Number<br><span class="text-gray-600">সি০৩. ব্যক্তিগত মোবাইল নম্বর</span></label>
                            <input type="text" name="personal_cell" class="form-input text-sm" value="{{ $registration->personal_cell }}" />
                        </div>
                        <div>
                            <label class="form-label">C04. Office Cell Number<br><span class="text-gray-600">সি০৪. অফিসের মোবাইল নম্বর</span></label>
                            <input type="text" name="office_cell" class="form-input text-sm" value="{{ $registration->office_cell }}" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">C05. Email Address<br><span class="text-gray-600">সি০৫. ইমেইল ঠিকানা</span></label>
                        <input type="email" name="email" class="form-input text-sm" value="{{ $registration->email }}" />
                    </div>
                    <div class="space-y-4">
                        <label class="form-label">C06. Social Media Profile URLs<br><span class="text-sm text-gray-600 font-normal">সি০৬. সামাজিক যোগাযোগ মাধ্যমের প্রোফাইল লিংক</span></label>
                        @php
                            $socialLinks = json_decode($registration->social_media, true) ?? [];
                        @endphp
                        <div class="flex items-center gap-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" class="w-6 h-6" />
                            <input type="url" name="social[facebook]" class="form-input w-full" placeholder="Facebook profile URL" value="{{ $socialLinks['facebook'] ?? '' }}" />
                        </div>
                        <div class="flex items-center gap-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/5968/5968804.png" alt="X" class="w-6 h-6" />
                            <input type="url" name="social[x]" class="form-input w-full" placeholder="X (Twitter) profile URL" value="{{ $socialLinks['x'] ?? '' }}" />
                        </div>
                        <div class="flex items-center gap-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" class="w-6 h-6" />
                            <input type="url" name="social[linkedin]" class="form-input w-full" placeholder="LinkedIn profile URL" value="{{ $socialLinks['linkedin'] ?? '' }}" />
                        </div>
                        <div class="flex items-center gap-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/1384/1384063.png" alt="Instagram" class="w-6 h-6" />
                            <input type="url" name="social[instagram]" class="form-input w-full" placeholder="Instagram profile URL" value="{{ $socialLinks['instagram'] ?? '' }}" />
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="form-title">(D) Reference</h2>
                    <div class="mb-4">
                        <label class="form-label">
                            <span class="text-gray-600">
                                <p>Please provide the name, surname, and mobile phone number of any cadet you know in this platoon.</p>
                                আপনার পরিচিত অত্র প্লাটুনের কোন ক্যাডেট এর পদবী, নাম ও মুঠোফোন নম্বর দিন।
                            </span>
                        </label>
                        <div class="overflow-x-auto">
                            <table class="reference-table min-w-full border border-gray-200" id="referenceTable">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="p-2 border-b text-left">No.</th>
                                        <th class="p-2 border-b text-left">Rank</th>
                                        <th class="p-2 border-b text-left">Name</th>
                                        <th class="p-2 border-b text-left">Phone</th>
                                        <th class="p-2 border-b text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="referenceBody">
                                    @foreach (json_decode($registration->reference, true) as $index => $ref)
                                        <tr>
                                            <td class="p-2 border-b">{{ $index + 1 }}</td>
                                            <td class="p-2 border-b">
                                                <select name="reference_rank[]" class="form-input border-none bg-transparent w-full text-sm">
                                                    <option value="">Select Rank</option>
                                                    <option value="Cadet" {{ $ref['rank'] == 'Cadet' ? 'selected' : '' }}>Cadet</option>
                                                    <option value="Lance Corporal (LCPL)" {{ $ref['rank'] == 'Lance Corporal (LCPL)' ? 'selected' : '' }}>Lance Corporal (LCPL)</option>
                                                    <option value="Corporal (CPL)" {{ $ref['rank'] == 'Corporal (CPL)' ? 'selected' : '' }}>Corporal (CPL)</option>
                                                    <option value="Sergeant (SGT)" {{ $ref['rank'] == 'Sergeant (SGT)' ? 'selected' : '' }}>Sergeant (SGT)</option>
                                                    <option value="Cadet Under Officer (CUO)" {{ $ref['rank'] == 'Cadet Under Officer (CUO)' ? 'selected' : '' }}>Cadet Under Officer (CUO)</option>
                                                </select>
                                            </td>
                                            <td class="p-2 border-b">
                                                <input type="text" name="reference_name[]" class="form-input border-none bg-transparent w-full" placeholder="Name" value="{{ $ref['name'] }}" />
                                            </td>
                                            <td class="p-2 border-b">
                                                <input type="tel" name="reference_phone[]" class="form-input border-none bg-transparent w-full" placeholder="Phone" value="{{ $ref['phone'] }}" />
                                            </td>
                                            <td class="p-2 border-b">
                                                <button type="button" onclick="removeRow2(this)" class="text-red-500">−</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" onclick="addRow2('referenceTable')" class="mt-2 px-4 py-1 bg-blue-500 text-white rounded">+ Add Row</button>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="form-title">(E) Emergency Contact Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="form-label">E01. Emergency Contact Person<br><span class="text-gray-600">ই০১. জরুরী যোগাযোগ ব্যক্তির নাম</span></label>
                            <input type="text" name="emergency_person" class="form-input text-sm" value="{{ $registration->emergency_person }}" />
                        </div>
                        <div>
                            <label class="form-label">E02. Relation with the Person<br><span class="text-gray-600">ই০২. ব্যক্তির সাথে সম্পর্ক</span></label>
                            <input type="text" name="emergency_relation" class="form-input text-sm" value="{{ $registration->emergency_relation }}" />
                        </div>
                        <div>
                            <label class="form-label">E03. Emergency Contact Number<br><span class="text-gray-600">ই০৩. জরুরী মোবাইল নম্বর</span></label>
                            <input type="text" name="emergency_contact" class="form-input text-sm" value="{{ $registration->emergency_contact }}" />
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="form-title">(F) Upload Your Passport Size Photo<br><span class="text-gray-600 text-base">এফ: আপনার পাসপোর্ট সাইজের ছবি আপলোড করুন</span></h2>
                    <input type="file" name="photo" accept="image/*" class="form-input" />
                    @if ($registration->photo)
                        <p class="text-sm text-gray-600">Current photo: <a href="{{ asset('uploads/' . $registration->photo) }}" target="_blank">View</a></p>
                    @endif
                </div>
                <div class="form-section">
                    <h2 class="form-title">Declaration</h2>
                    <p class="text-sm text-gray-600 mb-4 text-justify">I hereby declare that the above information is completely true and complete. I am a former/current cadet of the BNCC Platoon of Omargani MES College and have never been involved in any activity against the interests of this platoon or against the constitution and laws of Bangladesh. I voluntarily, knowingly and without any inducement, give permission to the authorities of Omargani MES College Ex-Cadet Forum (OCECF) to store the above-mentioned information and to contact me as necessary according to the information. I also declare that if any of the information I have provided above is proven to be incorrect, I will be bound to accept any decision of the OCECF authorities.</p>
                    <div class="flex items-start gap-2 mb-4">
                        <input type="checkbox" id="declaration" class="mt-1" />
                        <label for="declaration" class="text-sm text-gray-800">I agree to the above declaration.</label>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:space-x-4">
                    <button id="submitBtn" type="submit" class="btn-submit bg-red-500" disabled>Update OCECF Membership</button>
                </div>
                <p class="text-sm text-gray-500 text-center mt-4">Thank you, your application is received and under review.</p>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('registrationForm');
            const successMsg = document.getElementById('successMessage');
            const platoonYearContainer = document.getElementById('platoonYearContainer');
            const submitBtn = document.getElementById('submitBtn');
            const declaration = document.getElementById('declaration');

            if (successMsg) {
                setTimeout(() => successMsg.style.display = 'none', 10000);
            }

            const showError = (input, message, container = null) => {
                removeError(input);
                const error = document.createElement('p');
                error.className = 'error-message';
                error.innerText = message;
                input.classList.add('border-red-500');
                const target = container || input;
                target.parentNode.insertBefore(error, target.nextSibling);
                return error;
            };

            const removeError = (input) => {
                input.classList.remove('border-red-500');
                const next = input.nextElementSibling;
                if (next && next.classList.contains('error-message')) next.remove();
            };

            const validateRequired = (field, fieldName) => {
                if (!field.value.trim()) {
                    showError(field, `${fieldName} is required`);
                    return false;
                }
                removeError(field);
                return true;
            };

            const validateYearRange = (startId, endId, fieldName) => {
                const startField = document.getElementById(startId);
                const endField = document.getElementById(endId);
                const container = startField.closest('.year-range-container');
                let isValid = true;
                let firstError = null;

                if (!startField.value.trim()) {
                    firstError = showError(startField, `${fieldName} start year is required`, startField);
                    isValid = false;
                } else removeError(startField);

                if (!endField.value.trim()) {
                    firstError = firstError || showError(endField, `${fieldName} end year is required`, endField);
                    isValid = false;
                } else removeError(endField);

                if (isValid && parseInt(startField.value) > parseInt(endField.value)) {
                    firstError = firstError || showError(endField, 'End year must be after start year', endField);
                    isValid = false;
                }

                if (!isValid && firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                return isValid;
            };

            const validateRadio = (groupName, fieldName) => {
                const radios = document.querySelectorAll(`input[name="${groupName}"]:checked`);
                const radioContainer = document.querySelector(`input[name="${groupName}"]`).closest('.radio-group');
                if (radios.length === 0) {
                    showError(document.querySelector(`input[name="${groupName}"]`), `${fieldName} is required`, radioContainer);
                    return false;
                }
                removeError(document.querySelector(`input[name="${groupName}"]`));
                return true;
            };

            const validateCheckboxes = (groupName, fieldName) => {
                const checkboxes = document.querySelectorAll(`input[name="${groupName}"]:checked`);
                if (checkboxes.length === 0) {
                    const firstCheckbox = document.querySelector(`input[name="${groupName}"]`);
                    showError(firstCheckbox, `At least one ${fieldName} must be selected`);
                    return false;
                }
                removeError(document.querySelector(`input[name="${groupName}"]`));
                return true;
            };

            const validateFileUpload = (field, fieldName) => {
                if (!field.files || field.files.length === 0) {
                    showError(field, `${fieldName} is required`);
                    return false;
                }
                removeError(field);
                return true;
            };

            const setupCadetshipRange = (startId, endId, hiddenId) => {
                const startInput = document.getElementById(startId);
                const endInput = document.getElementById(endId);
                const hiddenInput = document.getElementById(hiddenId);
                const updateHiddenValue = () => {
                    hiddenInput.value = startInput.value.trim() && endInput.value.trim() ? `${startInput.value}-${endInput.value}` : '';
                };
                startInput.addEventListener('input', updateHiddenValue);
                endInput.addEventListener('input', updateHiddenValue);
            };

            setupCadetshipRange('cadetship_start', 'cadetship_end', 'cadetship_year');
            setupCadetshipRange('junior_start', 'junior_end', 'junior_cadetship_year');
            setupCadetshipRange('platoon_start', 'platoon_end', 'platoon_year');

            document.querySelectorAll('input[name="platoon_leader"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    platoonYearContainer.classList.toggle('hidden', radio.value !== 'YES');
                });
            });

            document.querySelectorAll('input[name="isJuniorDivision"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.value === 'YES') {
                        document.getElementById('juniorFields').classList.remove('hidden');
                        document.getElementById('juniorInstitutionContainer').classList.remove('hidden');
                    } else {
                        document.getElementById('juniorFields').classList.add('hidden');
                        document.getElementById('juniorInstitutionContainer').classList.add('hidden');
                    }
                });
            });

            const requiredFields = [
                { selector: 'select[name="last_rank"]', name: 'Last rank' },
                { selector: 'input[name="full_name_en"]', name: 'Full name (English)' },
                { selector: 'input[name="cadet_incharge"]', name: 'Cadet Incharge' },
                { selector: 'input[name="full_name_bn"]', name: 'Full name (Bangla)' },
                { selector: 'input[name="father_name"]', name: "Father's name" },
                { selector: 'input[name="mother_name"]', name: "Mother's name" },
                { selector: 'input[name="email"]', name: 'Email' },
                { selector: 'input[name="dob"]', name: 'Date of birth' },
                { selector: 'input[name="nid_number"]', name: 'NID number' },
                { selector: 'select[name="religion"]', name: 'Religion' },
                { selector: 'select[name="blood_group"]', name: 'Blood group' },
                { selector: 'select[name="occupation"]', name: 'Occupation' },
                { selector: 'textarea[name="present_address"]', name: 'Present address' },
                { selector: 'textarea[name="permanent_address"]', name: 'Permanent address' },
                { selector: 'input[name="personal_cell"]', name: 'Personal cell number' },
                { selector: 'input[name="emergency_person"]', name: 'Emergency contact person' },
                { selector: 'input[name="emergency_relation"]', name: 'Emergency relation' },
                { selector: 'input[name="emergency_contact"]', name: 'Emergency contact number' }
            ];

            requiredFields.forEach(field => {
                const element = document.querySelector(field.selector);
                if (element) element.addEventListener('blur', () => validateRequired(element, field.name));
            });

            const yearRangeFields = [
                { start: 'cadetship_start', end: 'cadetship_end', name: 'Cadetship year' },
                { start: 'platoon_start', end: 'platoon_end', name: 'Platoon leadership years' },
                { start: 'junior_start', end: 'junior_end', name: 'Junior cadetship years' }
            ];

            yearRangeFields.forEach(range => {
                const startField = document.getElementById(range.start);
                const endField = document.getElementById(range.end);
                if (startField && endField) {
                    startField.addEventListener('blur', () => {
                        if (startField.value || endField.value) validateYearRange(range.start, range.end, range.name);
                    });
                    endField.addEventListener('blur', () => {
                        if (startField.value || endField.value) validateYearRange(range.start, range.end, range.name);
                    });
                }
            });

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                let isValid = true;

                isValid = validateYearRange('cadetship_start', 'cadetship_end', 'Cadetship year') && isValid;
                isValid = validateRequired(document.querySelector('select[name="last_rank"]'), 'Last rank') && isValid;
                isValid = validateRadio('platoon_leader', 'Platoon leader status') && isValid;

                if (document.querySelector('input[name="platoon_leader"]:checked')?.value === 'YES') {
                    isValid = validateYearRange('platoon_start', 'platoon_end', 'Platoon leadership years') && isValid;
                }

                isValid = validateCheckboxes('bncc_officers_names[]', 'BNCC officer') && isValid;
                isValid = validateRadio('isJuniorDivision', 'Junior division status') && isValid;

                if (document.querySelector('input[name="isJuniorDivision"]:checked')?.value === 'YES') {
                    isValid = validateRequired(document.querySelector('input[name="junior_institution"]'), 'Junior institution') && isValid;
                    isValid = validateRequired(document.querySelector('select[name="junior_last_rank"]'), 'Junior last rank') && isValid;
                    isValid = validateYearRange('junior_start', 'junior_end', 'Junior cadetship years') && isValid;
                }

                requiredFields.forEach(field => {
                    isValid = validateRequired(document.querySelector(field.selector), field.name) && isValid;
                });

                if (isValid) {
                    document.getElementById('formLoader').classList.remove('hidden');
                    form.submit();
                } else {
                    const firstError = document.querySelector('.border-red-500');
                    if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });

            declaration.addEventListener('change', () => {
                submitBtn.disabled = !declaration.checked;
                submitBtn.classList.toggle('bg-red-500', !declaration.checked);
                submitBtn.classList.toggle('bg-green-500', declaration.checked);
            });

            window.addRow = () => {
                const tableBody = document.getElementById('trainingCampBody');
                const rowCount = tableBody.rows.length;
                const newRow = tableBody.insertRow();
                newRow.innerHTML = `
                    <td>${rowCount + 1}</td>
                    <td><input type="text" name="training_camp_name[]" class="form-input border-none bg-transparent w-full" /></td>
                    <td><input type="text" name="training_camp_appointment[]" class="form-input border-none bg-transparent w-full" /></td>
                    <td>
                        <select name="training_camp_rank[]" class="form-input border-none bg-transparent w-full text-sm">
                            <option value="">Select Rank</option>
                            <option value="Cadet">Cadet</option>
                            <option value="Lance Corporal (LCPL)">Lance Corporal (LCPL)</option>
                            <option value="Corporal (CPL)">Corporal (CPL)</option>
                            <option value="Sergeant (SGT)">Sergeant (SGT)</option>
                            <option value="Cadet Under Officer (CUO)">Cadet Under Officer (CUO)</option>
                        </select>
                    </td>
                    <td><input type="text" name="training_camp_year[]" class="form-input border-none bg-transparent w-full" /></td>
                    <td><button type="button" onclick="removeRow(this)" class="text-red-500">−</button></td>
                `;
            };

            window.removeRow = (button) => {
                const tableBody = document.getElementById('trainingCampBody');
                if (tableBody.rows.length > 1) {
                    button.closest('tr').remove();
                    Array.from(document.querySelectorAll('#trainingCampBody tr')).forEach((row, index) => {
                        row.cells[0].innerText = index + 1;
                    });
                }
            };

            window.toggleJuniorFields = () => {
                const selected = document.querySelector('input[name="isJuniorDivision"]:checked');
                const fields = document.getElementById("juniorFields");
                const a11 = document.getElementById("juniorInstitutionContainer");

                if (selected && selected.value === "YES") {
                    fields.classList.remove("hidden");
                    a11.classList.remove("hidden");
                } else {
                    fields.classList.add("hidden");
                    a11.classList.add("hidden");
                }
            };

            window.addRow2 = (tableId) => {
                const table = document.getElementById(tableId);
                const tbody = table.querySelector("tbody");
                const firstRow = tbody.querySelector("tr");
                const newRow = firstRow.cloneNode(true);

                newRow.querySelectorAll("input, select").forEach((el) => {
                    el.value = "";
                });

                const rowCount = tbody.children.length + 1;
                newRow.querySelector("td:first-child").textContent = rowCount;

                tbody.appendChild(newRow);
            };

            window.removeRow2 = (button) => {
                const row = button.closest("tr");
                const tbody = row.parentElement;
                if (tbody.children.length > 1) {
                    row.remove();
                    Array.from(tbody.children).forEach((tr, i) => {
                        tr.querySelector("td:first-child").textContent = i + 1;
                    });
                }
            };
        });
    </script>
</body>
</html>