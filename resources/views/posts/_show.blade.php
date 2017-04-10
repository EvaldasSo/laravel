@component('components.panels.default', ['type' => 'info'])
    @slot('title')
        <strong>{{ link_to_route('posts.show', $post->title, $post) }}</strong>,
            <span>{{ link_to_route('users.show', $post->author->fullname, $post->author) }}</span>
        <time class="pull-right">{{ $post->posted_at }}</time>
    @endslot

    {{ $post->content }}

    @can('update', $post)

        <p>
            <a href="{{ route('posts.edit', $post) }}" class="pull-left btn btn-primary">{{ __('Edit') }}</a>
        </p>

        {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post]]) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger pull-right ']) !!}
        {!! Form::close() !!}
    @endcan


@endcomponent
