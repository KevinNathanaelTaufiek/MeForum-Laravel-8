@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
<div class="container">
    <h1>Create New Forum</h1>
    <form action="/create" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="Title" name="title">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Write your forum content here" id="content-ta"
            style="height: 100px" name="content"></textarea>
            <label for="content-ta">Content</label>
            @error('content')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
