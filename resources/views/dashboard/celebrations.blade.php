@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Celebration Registrations</h1>

    <form method="GET" class="mb-3 d-flex">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Search name, email, phone">
        <select name="type" class="form-select me-2" style="max-width:200px;">
            <option value="">All types</option>
            @foreach(\App\Models\CelebrationRegistration::select('celebration_type')->distinct()->pluck('celebration_type') as $t)
                <option value="{{ $t }}" @if(request('type') == $t) selected @endif>{{ $t }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary">Filter</button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Registered</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $reg)
                    <tr>
                        <td>{{ $loop->iteration + ($registrations->currentPage()-1)*$registrations->perPage() }}</td>
                        <td>{{ $reg->name }}</td>
                        <td>{{ $reg->email }}</td>
                        <td>{{ $reg->phone }}</td>
                        <td>{{ $reg->celebration_type }}</td>
                        <td>{{ optional($reg->registered_at)->format('Y-m-d H:i') ?? $reg->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ Str::limit($reg->notes, 100) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7">No registrations found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $registrations->links() }}
</div>
@endsection
