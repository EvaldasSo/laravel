@component('components.panels.default', ['type' => 'info'])
    @slot('title')
        <time class="pull-right">{{ $feed->created_at }}</time>
    @endslot

    {{ $feed->feed_url }}

    @can('update', $feed)

        <p>
            <a href="{{ route('feed.edit', $feed) }}" class="pull-right btn btn-primary">{{ __('Edit') }}</a>
        </p>
    @endcan


@endcomponent
