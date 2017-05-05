@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Edit Feed') }}
        @endslot

        {!! Form::model($feed, ['route' => ['feed.update', $feed], 'method' => 'patch']) !!}
        @include ('feed/_form')
        {!! Form::close() !!}


        {!! Form::open(['method' => 'DELETE','route' => ['feed.destroy', $feed]]) !!}
        {!! Form::submit('Delete', ['class' => ' pull-left btn btn-danger']) !!}
        {!! Form::close() !!}

    @endcomponent
@endsection
