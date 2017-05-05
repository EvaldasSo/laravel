@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('categories') }}
        @endslot

        @foreach($categories as $category)

            <li>
                <strong> {{ link_to_route('category.show', $category->name, $category) }} </strong>
            </li>

        @endforeach

    @endcomponent
@endsection
