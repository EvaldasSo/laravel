@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Edit Category') }}
        @endslot

        {!! Form::model($category, ['route' => ['category.update', $category], 'method' => 'patch']) !!}
        @include ('category/_form')
        {!! Form::close() !!}


        {!! Form::open(['method' => 'DELETE','route' => ['category.destroy', $category]]) !!}
        {!! Form::submit('Delete', ['class' => ' pull-left btn btn-danger']) !!}
        {!! Form::close() !!}

    @endcomponent
@endsection
