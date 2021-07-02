@extends('layouts.app')

@section('title')
Forums
@endsection

@section('content')
<div class="container">
    <div class="forum">
        <h1>{{ $forum->title }}</h1>
        <p>{!! nl2br(e($forum->content)) !!}</p>
        @if (Auth::user()->id == $forum->user_id)
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editModal">
                Edit
            </button>
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Forum Content</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/update/{{ $forum->id }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="Title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="Title" name="title" value="{{ $forum->title }}">
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Write your forum content here" id="content-ta" style="height: 100px"
                                        name="content">{{ $forum->content }}</textarea>
                                    <label for="content-ta">Content</label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Perbaharui</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="comments">
        <form action="/reply" method="POST">
            @csrf
            <input type="hidden" name="forum_id" value="{{ $forum->id }}">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Write your Reply content here" id="content-ta" style="height: 100px"
                    name="content"></textarea>
                <label for="content-ta">Reply</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
        <hr>
        @if ($comments->count() == 0)
            <h3>Comment Not Available!</h3>
        @else
            <h3>Comments</h3>
            @foreach ($comments as $comment)
                <div class="comment">
                    <sup>{{ $comment->created_at }}</sup>
                    <h3>{{ $comment->user->username }}</h3>
                    <p>{!! nl2br(e($comment->comment)) !!}</p>

                @if (Auth::user()->id == $comment->user_id)
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editCommentModal">
                        Edit your Reply
                    </button>
                    <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCommentModalLabel">Edit Reply</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/reply/update/{{ $comment->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Write your forum content here" id="content-ta"
                                                style="height: 100px" name="comment">{{ $comment->comment }}</textarea>

                                            <label for="content-ta">Content</label>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Perbaharui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                </div>
            @endforeach

        @endif


    </div>
</div>
@endsection
