<form class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-4" for="email">{{ __('Name') }} : </label>
        <div class="col-sm-8">
            <p class="form-control-static">{{ $user->name }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="email">{{ __('Email') }} : </label>
        <div class="col-sm-8">
            <p class="form-control-static">{{ $user->email }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="email">{{ __('Total posts') }} : </label>
        <div class="col-sm-8">
            <p class="form-control-static">{{ $user->posts()->count() }}</p>
        </div>
    </div>
</form>

@can('update', $user)
    <a href="{{ route('users.edit', $user) }}" class="pull-right btn btn-primary">{{ __('users.edit') }}</a>
@endcan