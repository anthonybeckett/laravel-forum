@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img src="{{ Gravatar::src($discussion->user->email) }}" alt="" class="avatar">
                    <span class="avatar_user ml-2">{{ $discussion->user->name }}</span>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{ __($discussion->title) }}

            <hr/>

            {!! __($discussion->content) !!}

            @if($discussion->bestReply)
                <div class="card my-4">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between">
                            <div>
                                <img src="{{ Gravatar::src($discussion->bestReply->user->email) }}" alt="" class="avatar mr-2">
                                <strong>
                                    {{ $discussion->bestReply->user->name }}
                                </strong>
                            </div>
                            <div>
                                Best Reply
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        {!! $discussion->bestReply->contents !!}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Replies -->
    @foreach($discussion->replies()->paginate(10) as $reply)
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="{{ Gravatar::src($reply->user->email) }}" alt="" class="avatar">
                        <span class="avatar_user mx-2">{{ $reply->user->name }}</span>
                    </div>
                    @auth
                        @if(auth()->user()->id === $discussion->user_id && !$discussion->bestReply)
                            <div>
                                <form action="{{ route('discussions.bestReply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" class="form" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-outline-success">Mark best answer</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="card-body">
                {!! $reply->contents !!}
            </div>
        </div>
    @endforeach

    {{ $discussion->replies()->paginate(10)->links() }}

    <!-- Reply input -->
    <div class="header">Add reply</div>
    <div class="card my-4">
{{--        <div class="card-header">Add reply</div>--}}

        <div class="card-body">
            @auth
                <form action="{{ route('replies.store', $discussion->slug) }}" class="form" method="POST">
                    @csrf

                    <div class="form-group">
                        <input type="hidden" name="content" id="content">
                        <trix-editor input="content"></trix-editor>
                    </div>

                    <input type="submit" value="Add Reply" class="btn btn-outline-success">
                </form>
            @else
                Log in to reply
            @endauth
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection
