@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Category Form') }}
        @endslot

        {!! Form::open(['route' => 'category.store', 'method' => 'post']) !!}
        @include ('category/_form')
        {!! Form::close() !!}

    @endcomponent
@endsection
