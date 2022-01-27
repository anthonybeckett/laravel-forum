@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @foreach($discussions as $discussion)
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="{{ Gravatar::src($discussion->user->email) }}" alt="" class="avatar">
                        <span class="avatar_user ml-2">{{ $discussion->user->name }}</span>
                    </div>

                    <div>
                        <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                {!! __($discussion->title) !!}
            </div>
        </div>
    @endforeach

    {{ $discussions->appends(['channel' => request()->query('channel')])->links() }}
@endsection
