<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('registration');
    }

    public function showRegistrations()
    {
          $user = session('user');
      $registrations = DB::table('registrations')->paginate(10);
   return view('registrations', compact('registrations', 'user'));
    }

    public function showRegistrationDetail($id)
    {
        $reg = DB::table('registrations')->where('id', $id)->first();

        if (!$reg) {
            abort(404);
        }

        return view('registration-detail', compact('reg'));
    }

    public function submitForm(Request $request)
    {
        // Handle photo upload
$request->validate([
    'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    'cadetship_year' => 'required',
    'personal_cell' => 'required|digits_between:10,14|unique:registrations,personal_cell',
    'email' => 'required|email|unique:registrations,email',
]);

    $photoName = null;

    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
    
        if ($photo->isValid()) {
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads'), $photoName);
        }
    }

        $bnccOfficerNames = $request->input('bncc_officers_names', []);
        $socialLinks = $request->input('social', []);

    $trainingCamps = [];
    $names = $request->input('training_camp_name', []);
    $years = $request->input('training_camp_year', []);
    $appointments = $request->input('training_camp_appointment', []);
    $ranks = $request->input('training_camp_rank', []);
    
    if (!empty($names) && !empty($years)) {
        foreach ($names as $index => $name) {
            if (!empty($name) && !empty($years[$index])) {
                $trainingCamps[] = [
                    'name' => $name,
                    'year' => $years[$index],
                    'camp_appointment' => $appointments[$index] ?? null,
                    'rank' => $ranks[$index] ?? null,
                ];
            }
        }
    }
    
       $references = [];
    $count = count($request->reference_rank); // total rows

    for ($i = 0; $i < $count; $i++) {
        $references[] = [
            'rank' => $request->reference_rank[$i],
            'name' => $request->reference_name[$i],
            'phone' => $request->reference_phone[$i],
        ];
    }

    // Step 2: Convert to JSON
    $jsonReferences = json_encode($references);
        DB::table('registrations')->insert([
            'cadetship_year' => $request->cadetship_year,
            'cadetship_no' => $request->cadetship_no,
            'last_rank' => $request->last_rank,
            'last_appointment' => $request->last_appointment,
            'platoon_leader' => $request->platoon_leader,
            'platoon_year' => $request->platoon_year,
            'cadet_incharge' => $request->cadet_incharge,
            'full_name_en' => $request->full_name_en,
            'full_name_bn' => $request->full_name_bn,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'dob' => $request->dob,
            'nid_number' => $request->nid_number,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'occupation' => $request->occupation,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'personal_cell' => $request->personal_cell,
            'office_cell' => $request->office_cell,
            'email' => $request->email,
           'social_media' =>  json_encode($socialLinks),
            'emergency_person' => $request->emergency_person,
            'emergency_relation' => $request->emergency_relation,
            'emergency_contact' => $request->emergency_contact,
            'junior_division' => $request->junior_division,
            'junior_institution' => $request->junior_institution,
            'junior_last_rank' => $request->junior_last_rank,
            'junior_cadetship_year' => $request->junior_cadetship_year,
            'membership_type' => $request->membership_type,
            'training_camps' => json_encode($trainingCamps),
            'photo' => $photoName,
             'junior_division' => $request->isJuniorDivision,
            'reference' => $jsonReferences,
            'bncc_officers_names' => json_encode($bnccOfficerNames),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Redirect::back()->with('success', 'Congratulation!!!
Your information in successfully received and will be sent for data verification. After verifying  your information, your data will be stored in our database, and we will inform you soon.
For any quarry: Md. Ashiquer Rahaman (General Secretary-OCECF: 01817274457)');
    }
    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'cadetship_year' => 'required',
        // 'cadet_incharge' => 'required',
        // 'full_name_en' => 'required',
        // 'full_name_bn' => 'required',
        // 'father_name' => 'required',
        // 'mother_name' => 'required',
        // 'email' => 'required|email',
        // 'dob' => 'required|date',
        // 'nid_number' => 'required',
        // 'religion' => 'required',
        // 'blood_group' => 'required',
        // 'occupation' => 'required',
        // 'present_address' => 'required',
        // 'permanent_address' => 'required',
        // 'personal_cell' => 'required',
        // 'emergency_person' => 'required',
        // 'emergency_relation' => 'required',
        // 'emergency_contact' => 'required',
        // 'last_rank' => 'required',
        // 'platoon_leader' => 'required',
        // 'bncc_officers_names' => 'required|array|min:1',
        // 'isJuniorDivision' => 'required',
        // 'platoon_year' => 'required_if:platoon_leader,YES',
        // 'junior_institution' => 'required_if:isJuniorDivision,YES',
        // 'junior_last_rank' => 'required_if:isJuniorDivision,YES',
        // 'junior_cadetship_year' => 'required_if:isJuniorDivision,YES',
    ]);

    // Fetch the existing record
    $registration = DB::table('registrations')->find($id);
    if (!$registration) {
        return Redirect::back()->with('error', 'Registration not found.');
    }

    // Handle photo upload
    $photoName = $registration->photo;
    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        // Delete old photo if it exists
        if ($photoName && file_exists(public_path('Uploads/' . $photoName))) {
            unlink(public_path('Uploads/' . $photoName));
        }
        // Upload new photo
        $photo = $request->file('photo');
        $photoName = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('Uploads'), $photoName);
    }

    // Process BNCC officers names
    $bnccOfficerNames = $request->input('bncc_officers_names', []);

    // Process social media links
    $socialLinks = $request->input('social', []);

    // Process training camps
    $trainingCamps = [];
    $names = $request->input('training_camp_name', []);
    $years = $request->input('training_camp_year', []);
    $appointments = $request->input('training_camp_appointment', []);
    $ranks = $request->input('training_camp_rank', []);

    if (!empty($names) && !empty($years)) {
        foreach ($names as $index => $name) {
            if (!empty($name) && !empty($years[$index])) {
                $trainingCamps[] = [
                    'name' => $name,
                    'year' => $years[$index],
                    'camp_appointment' => $appointments[$index] ?? null,
                    'rank' => $ranks[$index] ?? null,
                ];
            }
        }
    }

    // Process references
    $references = [];
    $count = count($request->reference_rank ?? []);
    for ($i = 0; $i < $count; $i++) {
        if (!empty($request->reference_name[$i]) && !empty($request->reference_phone[$i])) {
            $references[] = [
                'rank' => $request->reference_rank[$i],
                'name' => $request->reference_name[$i],
                'phone' => $request->reference_phone[$i],
            ];
        }
    }

    // Update the database
    DB::table('registrations')->where('id', $id)->update([
        'cadetship_year' => $request->cadetship_year,
        'cadetship_no' => $request->cadetship_no,
        'last_rank' => $request->last_rank,
        'last_appointment' => $request->last_appointment,
        'platoon_leader' => $request->platoon_leader,
        'platoon_year' => $request->platoon_year,
        'cadet_incharge' => $request->cadet_incharge,
        'full_name_en' => $request->full_name_en,
        'full_name_bn' => $request->full_name_bn,
        'father_name' => $request->father_name,
        'mother_name' => $request->mother_name,
        'dob' => $request->dob,
        'nid_number' => $request->nid_number,
        'religion' => $request->religion,
        'blood_group' => $request->blood_group,
        'occupation' => $request->occupation,
        'present_address' => $request->present_address,
        'permanent_address' => $request->permanent_address,
        'personal_cell' => $request->personal_cell,
        'office_cell' => $request->office_cell,
        'email' => $request->email,
        'social_media' => json_encode($socialLinks),
        'emergency_person' => $request->emergency_person,
        'emergency_relation' => $request->emergency_relation,
        'emergency_contact' => $request->emergency_contact,
        'junior_division' => $request->isJuniorDivision,
        'junior_institution' => $request->junior_institution,
        'junior_last_rank' => $request->junior_last_rank,
        'junior_cadetship_year' => $request->junior_cadetship_year,
        'training_camps' => json_encode($trainingCamps),
        'photo' => $photoName,
        'reference' => json_encode($references),
        'bncc_officers_names' => json_encode($bnccOfficerNames),
        'updated_at' => now(),
    ]);

    // Redirect with success message
    return Redirect::back()->with('success', 'Your information has been successfully updated and will be sent for data verification. We will inform you soon. For any query: Md. Ashiquer Rahaman (General Secretary-OCECF: 01817274457)');
}
    
public function approve($id)
{
    DB::table('registrations')
        ->where('id', $id)
        ->update(['status' => '1']);

    return back()->with('success', 'Registration approved.');
}

public function edit($id)
{
    $registration = DB::table('registrations')->where('id', $id)->first();

    if (!$registration) {
        return back()->with('error', 'Registration not found.');
    }

    return view('registrationedit', compact('registration'));
}

public function cancel($id)
{
    DB::table('registrations')
        ->where('id', $id)
        ->update(['status' => '2']);

    return back()->with('success', 'Registration cancelled.');
}

}



