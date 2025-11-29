@extends('layouts.dashboard')

@section('content')
    <div class="text-center mb-5">
        <h2 class="fw-bold">Welcome, {{ $user['name'] }}</h2>
   @php
    $roles = [
        1 => 'Admin',
        2 => 'Moderator',
        // Add more roles as needed
    ];
    @endphp
    
    <p class="text-muted">
        You are logged in as a <strong>{{ $roles[$user['type']] ?? 'User' }}</strong>.
    </p>

    </div>

  
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Total Registered Users</h3>
        <p class="text-2xl">{{ $totalUsers }}</p>
    </div>

    <div class="p-4 bg-green-100 rounded shadow">
        <h3 class="text-lg font-semibold">Approved Users</h3>
        <p class="text-2xl">{{ $approvedUsers }}</p>
    </div>

    <div class="p-4 bg-yellow-100 rounded shadow">
        <h3 class="text-lg font-semibold">Pending Users</h3>
        <p class="text-2xl">{{ $pendingUsers }}</p>
    </div>
@endsection