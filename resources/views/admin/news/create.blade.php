@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.create') }} {{ trans('cruds.news.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.news.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="title" class="text-xs required">{{ trans('cruds.news.fields.title') }}</label>

                <div class="form-group">
                    <input type="text" id="title" name="title" class="{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
                </div>
                @if($errors->has('title'))
                    <p class="invalid-feedback">{{ $errors->first('title') }}</p>
                @endif
                <span class="block">{{ trans('cruds.news.fields.title_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="description" class="text-xs required">{{ trans('cruds.news.fields.description') }}</label>

                <div class="form-group">
                    <input type="text" id="description" name="description" class="{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description') }}">
                </div>
                @if($errors->has('description'))
                    <p class="invalid-feedback">{{ $errors->first('description') }}</p>
                @endif
                <span class="block">{{ trans('cruds.news.fields.description_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="photo" class="text-xs required">{{ trans('cruds.news.fields.photo') }}</label>

                <div class="form-group">
                    <input type="file" id="photo" name="photo[]" class="{{ $errors->has('photo') ? ' is-invalid' : '' }}" value="{{ old('photo') }}">
                </div>
                @if($errors->has('photo'))
                    <p class="invalid-feedback">{{ $errors->first('photo') }}</p>
                @endif
                <img style="visibility:hidden" class="mt-4" id="preview" src=""  width=200 height=200 />
                <span class="block">{{ trans('cruds.news.fields.photo_helper') }}</span>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
<script>
    const photoEl  = document.getElementById('photo')
    photoEl.onchange = (event) => {
        const [file] = photoEl.files
        if (file) {
            let previewEl = document.getElementById('preview')
            previewEl.style.visibility = 'visible';
            previewEl.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
