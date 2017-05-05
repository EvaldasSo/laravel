<div class="form-group">
    {!! Form::Label('Category', 'Categories:') !!}
    <p>
         @foreach($categories as $category)

            {{-- Need a re-work id:1 asap !!! --}}
            @php ($checkBoxStatus = False)

            @if( ! empty($selectedCategories))

                @if (count($selectedCategories))

                    @foreach($selectedCategories as $selectedCategory)

                        @if($selectedCategory == $category->name)
                            @php ($checkBoxStatus = True)
                        @endif

                    @endforeach

                @endif
            @endif

            {!! Form::checkbox('category[]', $category->name, $checkBoxStatus) !!}
            <strong> {!! $category->name !!} </strong>

        @endforeach
    </p>
</div>

<div class="form-group">
    {!! Form::label('url', __('Url')) !!}
    {!! Form::text('feed_url', null, ['class' => 'form-control', 'placeholder' => __('https://')]) !!}
</div>

{!! Form::submit(__('Save'), ['class' => 'btn btn-primary pull-right']) !!}
