@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('News') }}
        @endslot

        {{-- Need a re-work id:2  !!! --}}
        @foreach($categories as $category)

            <li>
                <a href="/feed/categories/{{ $category }}">
                    {{ $category }}
                </a>
            </li>
        @endforeach

        @foreach($feeds as $feed)

            <li>
                <strong> {{ link_to_route('feed.show', $feed->feed_url, $feed) }} </strong>
            </li>

        @endforeach

    @endcomponent
@endsection
