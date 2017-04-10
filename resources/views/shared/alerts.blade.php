@if (Session::has('success'))
    @component('components.alerts.dissmiss', ['type' => 'success'])
        {{ Session::get('success') }}
    @endcomponent
@endif

@if (Session::has('errors'))
    @component('components.alerts.dissmiss', ['type' => 'danger'])
        @if ($errors->count() > 1)
            {{ trans_choice('validation.errors', $errors->count()) }}
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            {{ $errors->first() }}
        @endif
    @endcomponent
@endif
