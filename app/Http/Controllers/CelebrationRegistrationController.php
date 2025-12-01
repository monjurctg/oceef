<?php

namespace App\Http\Controllers;

use App\Models\CelebrationRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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
                $passportPhoto = $request->file('passport_photo');
                $passportPhotoName = time() . '_passport_' . Str::random(10) . '.' . $passportPhoto->getClientOriginalExtension();
                $passportPhoto->move(public_path('uploads'), $passportPhotoName);
                $passportPhotoPath = 'uploads/' . $passportPhotoName;
            }

            // Process transaction screenshot
            if ($request->hasFile('transaction_screenshot')) {
                $transactionScreenshot = $request->file('transaction_screenshot');
                $transactionScreenshotName = time() . '_transaction_' . Str::random(10) . '.' . $transactionScreenshot->getClientOriginalExtension();
                $transactionScreenshot->move(public_path('uploads'), $transactionScreenshotName);
                $transactionScreenshotPath = 'uploads/' . $transactionScreenshotName;
            }

            // Calculate amount
            $amount = $this->calculateAmount(
                $validatedData['family_members'],
                $validatedData['children_count'] ?? 0,
                $validatedData['has_driver'] ?? false
            );

            // Calculate cashout fee
            $cashoutFee = $this->calculateCashoutFee($amount, $validatedData['payment_method']);

            // Log the calculated cashout fee
            \Log::info('Calculated cashout fee: ' . $cashoutFee);

            // Ensure cashout fee is a float
            $cashoutFee = (float) $cashoutFee;

            // Total amount including cashout fee
            $totalAmount = $amount + $cashoutFee;
            $totalAmount = (float) $totalAmount;
            \Log::info('Total amount: ' . $totalAmount);

            // Create the celebration registration record
            \Log::info('Creating registration with data: amount=' . $totalAmount . ', cashout_fee=' . $cashoutFee . ', payment_method=' . $validatedData['payment_method']);

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
                'amount' => $totalAmount,
                'cashout_fee' => $cashoutFee,
            ]);

            \Log::info('Registration created with ID: ' . $registration->id . ', cashout fee: ' . $registration->cashout_fee);
            return redirect()->back()->with('success', 'Registration submitted successfully!');
        } catch (\Exception $e) {
            // Clean up uploaded files if registration failed
            if (isset($passportPhotoPath) && file_exists(public_path($passportPhotoPath))) {
                unlink(public_path($passportPhotoPath));
            }

            if (isset($transactionScreenshotPath) && file_exists(public_path($transactionScreenshotPath))) {
                unlink(public_path($transactionScreenshotPath));
            }

            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function showRegistrations(Request $request)
    {
        try {
            // Check if user is admin (type 1) or moderator (type 2)
            $user = session('user');
            if (!$user || ($user['type'] != 1 && $user['type'] != 2)) {
                abort(403, 'Unauthorized access');
            }

            // Get all distinct religions for filter dropdown
            $religions = CelebrationRegistration::select('religion')->distinct()->pluck('religion');

            // Build query with filters
            $query = CelebrationRegistration::query();

            // Apply religion filter
            if ($request->filled('religion')) {
                $query->where('religion', $request->religion);
            }

            // Apply attend Wednesday night filter
            if ($request->filled('attend_wednesday_night')) {
                $query->where('attend_wednesday_night', $request->attend_wednesday_night);
            }

            // Apply search filter
            if ($request->filled('search')) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('email', 'LIKE', '%' . $request->search . '%');
                });
            }

            // Apply payment method filter
            if ($request->filled('payment_method')) {
                $query->where('payment_method', $request->payment_method);
            }

            // Get registrations from database with pagination
            $registrations = $query->latest()->paginate(10)->appends($request->except('page'));

            // Create a simple paginator-like structure
            $data = [
                'registrations' => $registrations,
                'user' => $user,
                'religions' => $religions,
                'filters' => $request->only(['religion', 'attend_wednesday_night', 'search', 'payment_method'])
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

    public function printRegistration($id)

    {
        try {
            // Check if user is admin (type 1) or moderator (type 2)
            $user = session('user');
            if (!$user || ($user['type'] != 1 && $user['type'] != 2)) {
                abort(403, 'Unauthorized access');
            }

            // Find the registration with the given ID
            $registration = CelebrationRegistration::findOrFail($id);

            return view('celebration-registration-print', compact('registration', 'user'));
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
            if ($registration->passport_photo && file_exists(public_path($registration->passport_photo))) {
                unlink(public_path($registration->passport_photo));
            }

            // Delete the transaction screenshot if it exists
            if ($registration->transaction_screenshot && file_exists(public_path($registration->transaction_screenshot))) {
                unlink(public_path($registration->transaction_screenshot));
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

    private function calculateCashoutFee($amount, $paymentMethod)
    {
        // Log the inputs for debugging
        \Log::info('Calculating cashout fee for amount: ' . $amount . ', payment method: ' . $paymentMethod);

        // Calculate cashout fee based on tiered rates
        // For Bkash, Nagad, Rocket:
        // 10 Taka for 500
        // 20 Taka for 1000
        // 30 Taka for 1500
        // For amounts above 1500, we'll calculate proportionally
        if (in_array($paymentMethod, ['Bkash', 'Nagad', 'Rocket'])) {
            if ($amount <= 500) {
                \Log::info('Cashout fee calculated: 10');
                return 10;
            } elseif ($amount <= 1000) {
                \Log::info('Cashout fee calculated: 20');
                return 20;
            } elseif ($amount <= 1500) {
                \Log::info('Cashout fee calculated: 30');
                return 30;
            } else {
                // For amounts above 1500, calculate proportionally
                // 30 Taka for first 1500, then 2% for the rest
                $baseFee = 30;
                $remainingAmount = $amount - 1500;
                $additionalFee = $remainingAmount * 0.02;
                // Round to nearest 10
                $additionalFee = round($additionalFee / 10) * 10;
                $totalFee = $baseFee + $additionalFee;
                \Log::info('Cashout fee calculated: ' . $totalFee . ' (base: ' . $baseFee . ', additional: ' . $additionalFee . ')');
                return $totalFee;
            }
        }

        // For Bank transfers, no fee
        \Log::info('Cashout fee calculated: 0 (bank transfer)');
        return 0;
    }
}