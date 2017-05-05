<div class="form-group">
    {!! Form::label('title', __('Title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Title')]) !!}
</div>

<div class="form-group">
    {!! Form::label('content', __('Content')) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => __('Content')]) !!}
</div>

<div class="pull-right">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-success']) !!}
</div>

