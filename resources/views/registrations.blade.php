@extends('layouts.dashboard')

@section('content')
<div class="rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-center">All Ex-Cadet Registrations</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">ID</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Name (En)</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">NID</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">DOB</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Photo</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Details</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Status</th>
                    <th class="py-3 px-4 border-b text-left text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $reg)
                @php
                    $rowColor = match($reg->status) {
                        1 => 'bg-green-50 hover:bg-green-100', // Approved
                        2 => 'bg-red-50 hover:bg-red-100',     // Cancelled
                        default => 'bg-yellow-50 hover:bg-yellow-100', // Pending
                    };
                    $isAdmin = session('user')['type'] == 1;
                @endphp
                <tr>
                    <td class="py-3 px-4 border-b">{{ $reg->id }}</td>
                    <td class="py-3 px-4 border-b">{{ $reg->full_name_en }}</td>
                    <td class="py-3 px-4 border-b">{{ $reg->nid_number }}</td>
                    <td class="py-3 px-4 border-b">
                        @if($reg->dob)
                            {{ \Carbon\Carbon::parse($reg->dob)->format('Y-m-d') }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-3 px-4 border-b">
                        @if ($reg->photo)
                            <img src="{{ asset('/public/uploads/' . $reg->photo) }}" alt="Photo" class="w-12 h-12 object-cover rounded">
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-3 px-4 border-b">
                        <a href="{{ route('registration.show', $reg->id) }}" class="text-blue-600 hover:underline flex items-center">
                            View Details
                            <i class="fas fa-chevron-right ml-1 text-sm"></i>
                        </a>
                    </td>
                    <td class="py-3 px-4 border-b">
                        @switch($reg->status)
                            @case(1)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full  text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Approved
                                </span>
                                @break
                            @case(2)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Cancelled
                                </span>
                                @break
                            @default
                                <span class="px-2 py-1 text-xs font-semibold rounded-full  text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                        @endswitch
                    </td>
                    <td class="py-3 px-4 border-b">
                        @if ($isAdmin)
                            <div class="flex flex-wrap gap-2">
                                @if($reg->status != 1)
                                <form action="{{ route('registration.approve', $reg->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Approve this registration?')"
                                        class="px-2 py-1 text-xs  text-green-700 rounded hover:bg-green-200 flex items-center">
                                        <i class="fas fa-check mr-1"></i> Approve
                                    </button>
                                </form>
                                @endif

                                <a href="{{ route('registration.edit', $reg->id) }}"
                                    class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200 flex items-center">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                @if($reg->status != 2)
                                <form action="{{ route('registration.cancel', $reg->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Cancel this registration?')"
                                        class="px-2 py-1 text-xs text-red-700 rounded hover:bg-red-200 flex items-center">
                                        <i class="fas fa-times mr-1"></i> Cancel
                                    </button>
                                </form>
                                @endif
                            </div>
                        @else
                            <span class="text-xs text-gray-400">No actions</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-4 px-6 text-center text-gray-500">No registrations found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($registrations, 'links'))
    <div class="mt-6 flex justify-center">
        {{ $registrations->links() }}
    </div>
    @endif
</div>

<style>
    /* Smooth transition for row hover effects */
    tr {
        transition: background-color 0.2s ease;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        table {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        th, td {
            padding: 0.5rem;
            font-size: 0.875rem;
        }
    }
</style>
@endsection