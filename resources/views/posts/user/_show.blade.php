@component('components.panels.default', ['type' => 'info'])
    @slot('title')
        <strong>{{ link_to_route('posts.show', $post->title, $post) }}</strong>
        <time class="pull-right">{{ $post->posted_at }}</time>
    @endslot

    {{ $post->content }}
@endcomponent