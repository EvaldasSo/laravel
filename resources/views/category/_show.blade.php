@component('components.panels.default', ['type' => 'info'])
    @slot('title')
        <time class="pull-right">{{ $category->created_at }}</time>
    @endslot

    {{ $category->name }}

    @can('update', $category)

        <p>
            <a href="{{ route('category.edit', $category) }}" class="pull-right btn btn-primary">{{ __('Edit') }}</a>
        </p>
    @endcan


@endcomponent
