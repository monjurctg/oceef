@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Create User from Registration</h1>
    
    <form method="POST"  action="{{ route('storeFromRegistration.submit') }}" class="max-w-lg">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Select Registration</label>
            <select name="reg_id" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onchange="fetchRegistrationDetails(this.value)">
                <option value="">-- Select Registration --</option>
                @foreach($registrations as $reg)
                <option value="{{ $reg->id }}">{{ $reg->full_name_en }} ({{ $reg->nid_number }})</option>
                @endforeach
            </select>
        </div>
        
       
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">User Type</label>
            <select name="user_type" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="0">Regular User</option>
                <option value="2">Moderator</option>
                <option value="1">Admin</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Password</label>
            <input type="password" name="password" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            Create User
        </button>
    </form>
</div>

@endsection