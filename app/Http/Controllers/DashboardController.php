<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\CelebrationRegistration;

class DashboardController extends Controller
{
public function index()
{
    $user = session('user');

    if (!$user) {
        return 'User not found in session';
    }



    // Querying the 'registrations' table directly
    $totalUsers = DB::table('registrations')->count();
    $approvedUsers = DB::table('registrations')->where('status', '1')->count();
    $pendingUsers = DB::table('registrations')->where('status', '0')->count();

    return view('dashboard.index', compact('user', 'totalUsers', 'approvedUsers', 'pendingUsers'));
}

   // Show create user form
public function showCreateForm()
{
      $user = session('user');

    if (!$user) {
        return 'User not found in session';
    }
    $registrations = DB::table('registrations')
        ->whereNotIn('id', function($query) {
            $query->select('reg_id')->from('users')->whereNotNull('reg_id');
        })
        ->get();

    return view('createuser', ['registrations' => $registrations,'user'=>$user]);
}

public function createUserFromRegistration(Request $request)
{
    $data = $request->validate([
        'reg_id' => 'required|exists:registrations,id',
        'user_type' => 'required|string', // adjust validation based on roles
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Get the registration record
    $registration = DB::table('registrations')
        ->where('id', $data['reg_id'])
        ->first();

    if (!$registration) {
        return back()->with('error', 'Registration not found.');
    }

    // Prevent duplicate user creation
    $userExists = DB::table('users')
        ->where('reg_id', $data['reg_id'])
        ->exists();

    if ($userExists) {
        return back()->with('error', 'User already exists for this registration.');
    }

    // Create the user
    DB::table('users')->insert([
        'name'       => $registration->full_name_en ?? 'Unnamed',
        'email'      => $registration->email ?? null,
        'phone'      => $registration->personal_cell ?? null,
        'reg_id'     => $data['reg_id'],
        'password'   => Hash::make($data['password']),
        'user_type'  => $data['user_type'],
        'created_at' => now(),
    ]);

    return redirect('/users')->with('success', 'User created successfully.');
}

public function showUsers()
{
    $user = session('user'); // Your current user
    $users = DB::table('users')->paginate(10); // 10 users per page

    return view('all_users', compact('users', 'user'));
}

// Show celebration registrations list
public function celebrations(Request $request)
{
    $query = CelebrationRegistration::query();

    // optional search by name/email/phone
    if ($q = $request->input('q')) {
        $query->where(function ($qry) use ($q) {
            $qry->where('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->orWhere('phone', 'like', "%{$q}%");
        });
    }

    // optional filter by celebration type
    if ($type = $request->input('type')) {
        $query->where('celebration_type', $type);
    }

    $registrations = $query->orderBy('created_at', 'desc')->paginate(25)->withQueryString();

    return view('dashboard.celebrations', compact('registrations'));
}
}
