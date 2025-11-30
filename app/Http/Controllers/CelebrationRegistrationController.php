<?php

namespace App\Http\Controllers;

use App\Models\CelebrationRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CelebrationRegistrationController extends Controller
{
    // Configuration for pricing
    private $singleRegistrationRate = 1500; // BDT for single registration
    private $familyMemberRate = 1000;       // BDT per family member (additional)
    private $driverRate = 500;              // BDT per driver
    private $childRate = 0;                 // BDT per child (free)

    public function showForm()
    {
        return view('celebration-registration');
    }

    public function submitForm(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_num' => ['required', 'string', 'max:20', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'emergency_contact' => ['required', 'string', 'max:20', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'family_members' => 'required|integer|min:0|max:50',
            'children_count' => 'nullable|integer|min:0|max:20',
            'has_driver' => 'nullable|boolean',
            'nid' => 'required|string|max:50',
            'bncc_batch' => 'required|string|max:50',
            'religion' => 'required|string|in:Islam,Hinduism,Christianity,Buddhism,Others',
            'has_children_under_five' => 'required|boolean',
            'attend_wednesday_night' => 'required|boolean',
            'passport_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_method' => 'required|string|in:Bank,Bkash,Nagad,Rocket',
            'transaction_number' => 'required|string|max:100',
            'transaction_screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Custom error messages
            'mobile_num.regex' => 'Please enter a valid Bangladesh mobile number (e.g., 01XXXXXXXXX).',
            'emergency_contact.regex' => 'Please enter a valid Bangladesh mobile number (e.g., 01XXXXXXXXX).',
            'family_members.max' => 'Maximum 50 family members allowed.',
            'children_count.max' => 'Maximum 20 children allowed.',
            'passport_photo.required' => 'Passport size photo is required.',
            'transaction_screenshot.required' => 'Transaction screenshot is required.',
            'nid.required' => 'NID is required.',
            'bncc_batch.required' => 'BNCC Batch is required.',
            'religion.required' => 'Religion is required.',
            'has_children_under_five.required' => 'Please specify if you bring children under five.',
            'attend_wednesday_night.required' => 'Please specify if you will attend on Thursday night.',
        ]);

        try {
            // Handle file uploads
            $passportPhotoPath = null;
            $transactionScreenshotPath = null;

            // Process passport photo
            if ($request->hasFile('passport_photo')) {
                $passportPhotoPath = $request->file('passport_photo')->store('uploads', 'public');
            }

            // Process transaction screenshot
            if ($request->hasFile('transaction_screenshot')) {
                $transactionScreenshotPath = $request->file('transaction_screenshot')->store('uploads', 'public');
            }

            // Calculate amount
            $amount = $this->calculateAmount(
                $validatedData['family_members'],
                $validatedData['children_count'] ?? 0,
                $validatedData['has_driver'] ?? false
            );

            // Create the celebration registration record
            $registration = CelebrationRegistration::create([
                'name' => $validatedData['name'],
                'mobile_num' => $validatedData['mobile_num'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'emergency_contact' => $validatedData['emergency_contact'],
                'family_members' => $validatedData['family_members'],
                'children_count' => $validatedData['children_count'] ?? 0,
                'has_driver' => $validatedData['has_driver'] ?? false,
                'nid' => $validatedData['nid'],
                'bncc_batch' => $validatedData['bncc_batch'],
                'religion' => $validatedData['religion'],
                'has_children_under_five' => $validatedData['has_children_under_five'],
                'attend_wednesday_night' => $validatedData['attend_wednesday_night'],
                'passport_photo' => $passportPhotoPath,
                'payment_method' => $validatedData['payment_method'],
                'transaction_number' => $validatedData['transaction_number'],
                'transaction_screenshot' => $transactionScreenshotPath,
                'amount' => $amount,
            ]);

            return redirect()->back()->with('success', 'Registration submitted successfully!');
        } catch (\Exception $e) {
            // Clean up uploaded files if registration failed
            if (isset($passportPhotoPath) && file_exists(public_path('storage/' . $passportPhotoPath))) {
                unlink(public_path('storage/' . $passportPhotoPath));
            }

            if (isset($transactionScreenshotPath) && file_exists(public_path('storage/' . $transactionScreenshotPath))) {
                unlink(public_path('storage/' . $transactionScreenshotPath));
            }

            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function showRegistrations()
    {
        try {
            // Check if user is admin (type 1) or moderator (type 2)
            $user = session('user');
            if (!$user || ($user['type'] != 1 && $user['type'] != 2)) {
                abort(403, 'Unauthorized access');
            }

            // Get registrations from database with pagination
            $registrations = CelebrationRegistration::latest()->paginate(10);

            // Create a simple paginator-like structure
            $data = [
                'registrations' => $registrations,
                'user' => $user,
            ];

            return view('celebration-registrations', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load registrations. Please try again.');
        }
    }

    public function showRegistrationDetail($id)
    {
        try {
            // Check if user is admin (type 1) or moderator (type 2)
            $user = session('user');
            if (!$user || ($user['type'] != 1 && $user['type'] != 2)) {
                abort(403, 'Unauthorized access');
            }

            // Find the registration with the given ID
            $reg = CelebrationRegistration::findOrFail($id);

            return view('celebration-registration-detail', compact('reg', 'user'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load registration details. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            // Check if user is admin (type 1)
            $user = session('user');
            if (!$user || $user['type'] != 1) {
                abort(403, 'Unauthorized access');
            }

            // Find the registration
            $registration = CelebrationRegistration::findOrFail($id);

            // Delete the passport photo if it exists
            if ($registration->passport_photo && file_exists(public_path('storage/' . $registration->passport_photo))) {
                unlink(public_path('storage/' . $registration->passport_photo));
            }

            // Delete the transaction screenshot if it exists
            if ($registration->transaction_screenshot && file_exists(public_path('storage/' . $registration->transaction_screenshot))) {
                unlink(public_path('storage/' . $registration->transaction_screenshot));
            }

            // Delete the registration from database
            $registration->delete();

            return back()->with('success', 'Registration deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete registration. Please try again.');
        }
    }

    private function calculateAmount($familyMembers, $childrenCount, $hasDriver)
    {
        // Calculate total amount based on family members, children, and driver
        // Family members field represents additional family members (excluding the registrant)
        // So total people = 1 (registrant) + familyMembers (additional)
        $totalPeople = 1 + $familyMembers;

        // Single registration fee + family members + driver
        $amount = $this->singleRegistrationRate +
                  ($familyMembers * $this->familyMemberRate) +
                  ($childrenCount * $this->childRate) +
                  ($hasDriver * $this->driverRate);

        return $amount;
    }
}