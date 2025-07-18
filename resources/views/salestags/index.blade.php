 @extends('layouts.admin.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">🛍️ Sales Tags</h5>
                </div>

                <br>
                <div class="card-body">
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    

                    {{-- Add Tag Form --}}
                    <form method="POST" action="{{ route('salestags.store') }}" class="mb-4">
                        @csrf
                        <div class="row g-2 align-items-center">
                            <div class="col-md-9">
                                <input type="text" name="tag" class="form-control" placeholder="Enter new sales tag..." required>
                            </div>
                            <div class="col-md-3 d-grid">
                                <button class="btn btn-success" type="submit">+ Add Tag</button>
                            </div>
                        </div>
                    </form>

                    {{-- Tags Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 45%;">Tag</th>
                                    <th style="width: 25%;">Created</th>
                                    <th style="width: 25%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($tags as $tag)
                                <tr style="color:white;">
                                    <td style="border: 1px solid black;">{{ ++$i }}</td>
                                    <td style="border: 1px solid black;">
                                        <form method="POST" action="{{ route('salestags.update', $tag->id) }}" class="d-flex gap-2">
                                            @csrf
                                            <input type="text" name="tag" value="{{ $tag->tag }}" class="form-control form-control-sm" required>
                                            <button class="btn btn-primary btn-sm text-dark">Update</button>
                                        </form>
                                    </td>
                                    <td style="border: 1px solid black;"><span>{{ \Carbon\Carbon::parse($tag->created_at)->format('d M Y, h:i A') }}</span></td>
                                    <td style="border: 1px solid black;">
                                        <form method="POST" action="{{ route('salestags.destroy', $tag->id) }}" onsubmit="return confirm('Are you sure you want to delete this tag?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">🗑 Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No tags found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
