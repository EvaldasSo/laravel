<div class="form-group">
    {!! Form::label('title', __('Title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Title')]) !!}
</div>

<div class="form-group">
    {!! Form::label('content', __('Content')) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => __('Content')]) !!}
</div>

{!! Form::submit(__('Publish'), ['class' => 'btn btn-primary pull-right']) !!}
