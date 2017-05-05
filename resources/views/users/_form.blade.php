{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user]]) !!}


<div class="form-group">
    {!! Form::label('Old password', __('Old Password')) !!}
    {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => __('Old Password')]) !!}
</div>

<div class="form-group">
    {!! Form::label('password', __('Password')) !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('Password')]) !!}
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', __('Password Confirmation')) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('Password Confirmation')]) !!}
</div>

<div class="pull-right">
    <a href="{{ route('users.show', $user) }}" class="btn btn-default">{{ __('Back') }}</a>
    {!! Form::submit(__('Save'), ['class' => 'btn btn-success']) !!}
</div>

{!! Form::close() !!}
