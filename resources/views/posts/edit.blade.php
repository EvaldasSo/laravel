@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Edit') }}
        @endslot

        {!! Form::model($post, ['route' => ['posts.update', $post], 'method' => 'patch']) !!}
        @include ('posts/_form')
        {!! Form::close() !!}

    @endcomponent
@endsection
