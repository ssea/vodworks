@extends('layouts.news')
@section('content')
<div class="row">
    <div class="col-md-12 pt-1">
        <h2 class="admin_title">Create news</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12 pt-4 pb-4">
            {!! Form::open(array('url' => '/news', 'class' => '', 'files' => true)) !!}
                <div class="form-row">
                    <div class="col-md-7 mb-3">
                        @php $valid = $errors->has('picture')?'is-invalid':''; @endphp
                        <label for="picture">Picture</label>
                        <input type="file" class="form-control-file {{ $valid }}" name="picture" id="picture" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                        <div class="invalid-feedback"> {{ $errors->first('picture') }} </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-7 mb-3">
                        @php $valid = $errors->has('title')?'is-invalid':''; @endphp
                        <label for="name">Title</label>
                        {!! Form::text('title', old('title'), ['class' => "form-control $valid", 'placeholder' => 'Title']) !!}
                        <div class="invalid-feedback"> {{ $errors->first('title') }} </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        {{ Form::textarea('description', old('description'),['data-compose-editor' => true, 'class' => "form-control", 'placeholder' => 'Description']) }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-7 mb-3">
                        <label for="status">Status</label>
                        {!! Form::select('status', array(1 => 'Active', 0 => 'Inactive'), null, ['class' => 'custom-select']) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3 text-right">
                        <a class="btn btn-primary" href="/" role="button">Back</a>
                        <button class="btn btn-success" type="submit">Create</button>
                    </div>
                </div>
            {!! Form::close() !!}
    </div>
</div>
@stop
