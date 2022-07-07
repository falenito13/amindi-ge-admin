@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ route('admin.news.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        <table class="striped bordered show-table">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.news.fields.title') }}
                    </th>
                    <td>
                        {{ $news->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.news.fields.description') }}
                    </th>
                    <td>
                        {!!  $news->description !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.news.fields.photo') }}
                    </th>
                    <td>
                        <img src="{{asset('/' . $news->photo)}}" />
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="block pt-4">
            <a class="btn-md btn-gray" href="{{ route('admin.news.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection
