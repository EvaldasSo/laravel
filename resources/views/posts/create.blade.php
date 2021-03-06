@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Post Form') }}
        @endslot

        {!! Form::open(['route' => 'posts.store', 'method' => 'post']) !!}
        @include ('posts/_form')
        {!! Form::close() !!}


    @endcomponent
@endsection
