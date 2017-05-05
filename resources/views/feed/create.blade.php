@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Post Form') }}
        @endslot

        {!! Form::open(['route' => 'feed.store', 'method' => 'post']) !!}
        @include ('feed/_form')
        {!! Form::close() !!}



    @endcomponent
@endsection
