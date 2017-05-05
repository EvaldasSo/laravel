@extends('layouts.app')

@section('content')
    @component('components.panels.default')
        @slot('title')
            {{ __('Rss feeds') }}
        @endslot

        @foreach ($flux->channel->item as $item)

            <article class="entry-item">

                <div class="entry-content">
                    <a href="{{ $item->link }}">{{ $item->title }}</a> <br>
                    @php echo $item->description
                    @endphp
                </div>
            </article>
        @endforeach


    @endcomponent
@endsection
