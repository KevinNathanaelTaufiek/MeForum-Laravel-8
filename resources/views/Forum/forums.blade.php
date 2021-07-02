@extends('layouts.app')

@section('title')
    Forums
@endsection

@section('content')
    <div class="container">
        <form class="form-inline d-grid gap-2 d-md-flex justify-content-md-end" method="GET" action="/forums">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="cari">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
        @foreach ($forums as $forum)
        <div class="forum d-md-flex justify-content-between">
        <a href="/forum/{{ $forum->id }}">
            <div>
                <h3>{{ $forum->title }}</h3>
            </div>
        </a>
        @if (Auth::user()->id == $forum->user_id)
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <form action="/delete/{{ $forum->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        @endif
        </div>
        @endforeach
    </div>
    {{-- {{ $forums->links() }} --}}
@endsection
