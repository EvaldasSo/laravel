@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            <strong>{{ $user->fullname }}</strong>
        @endslot

        @include ('users/_profil')
    @endcomponent

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="pill" href="#posts">{{ __('Last Posts') }}</a></li>
    </ul>

    <div class="tab-content">
        <div id="posts" class="tab-pane active">
            @each('posts/user/_show', $posts, 'post')
        </div>
    </div>
@endsection
