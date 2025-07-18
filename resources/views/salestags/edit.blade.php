@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Tag</h4>
    <form action="{{ route('salestags.update', $salestag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tag</label>
            <input type="text" name="tag" class="form-control" value="{{ $salestag->tag }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
