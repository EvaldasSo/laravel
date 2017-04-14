@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Edit Post') }}
        @endslot

        {!! Form::model($post, ['route' => ['posts.update', $post], 'method' => 'patch']) !!}
        @include ('posts/_form')
        {!! Form::close() !!}


        {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post]]) !!}
        {!! Form::submit('Delete', ['class' => ' pull-left btn btn-danger']) !!}
        {!! Form::close() !!}

    @endcomponent
@endsection
