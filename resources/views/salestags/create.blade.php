@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Create New Tag</h4>
    <form action="{{ route('salestags.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tag</label>
            <input type="text" name="tag" class="form-control" required>
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
