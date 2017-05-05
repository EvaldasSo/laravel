<div class="form-group">
    {!! Form::label('name', __('Category')) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('example')]) !!}
</div>

{!! Form::submit(__('Save'), ['class' => 'btn btn-primary pull-right']) !!}
