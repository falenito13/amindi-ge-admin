@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
       {{ trans('global.edit') }}
    </div>

    <form method="POST" action="{{ route("admin.news.update", [$news->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="title" class="text-xs required">{{ trans('cruds.news.fields.title') }}</label>

                <div class="form-group">
                    <input type="text" id="title" name="title" class="{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $news->title) }}">
                </div>
                @if($errors->has('title'))
                    <p class="invalid-feedback">{{ $errors->first('title') }}</p>
                @endif
                <span class="block">{{ trans('cruds.news.fields.title_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="description" class="text-xs required">{{ trans('cruds.news.fields.description') }}</label>

                <div class="form-group">
                    <input type="text" id="description" name="description" class="{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description', $news->description) }}">
                </div>
                @if($errors->has('description'))
                    <p class="invalid-feedback">{{ $errors->first('description') }}</p>
                @endif
                <span class="block">{{ trans('cruds.news.fields.description_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="top_news" class="text-xs ">Top სიახლე</label>
                <div>
                    <input type="checkbox" @if($news->top_news) checked @endif style="width: 16px; height: 16px;"
                           id="top_news"
                           name="top_news" value="{{old('top_news',1)}}">
                </div>
            </div>
            <div class="mb-3">
                <label for="photo" class="text-xs required">{{ trans('cruds.news.fields.photo') }}</label>

                <div class="form-group">
                    <input type="file" id="photo" name="photo[]" class="{{ $errors->has('photo') ? ' is-invalid' : '' }}" value="{{ old('photo', $news->photo) }}">
                </div>
                @if($errors->has('photo'))
                    <p class="invalid-feedback">{{ $errors->first('photo') }}</p>
                @endif
                <img class="mt-4" id="preview" src="{{asset('/' .$news->photo)}}"  width=200 height=200 />
                <span class="block">{{ trans('cruds.news.fields.photo_helper') }}</span>
            </div>
        </div>
        <input type="hidden" value="{{$news->id}}" name="id" />
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
            previewEl.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
