@extends('layouts.admin')
@section('content')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('admin.news.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.news.title_singular') }}
        </a>
    </div>
<div class="main-card">
    <div class="header">
        {{ trans('cruds.news.title') }} {{ trans('global.list') }}
    </div>

    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-news" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.news.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.news.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.news.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $key => $new)
                        <tr data-entry-id="{{ $new->id }}" class="my-auto">
                            <td></td>
                            <td class="text-center">
                                {{ $new->title ?? '' }}
                            </td>
                            <td class="text-center">
                                {!!  $new->description ?? '' !!}
                            </td>
                            <td class="flex justify-center">
                                <img id="preview" src="{{asset('/' .$new->photo)}}" height="30" width="30"/>
                            </td>
                            <td class="mx-auto">
                                    <a class="btn-sm btn-indigo" href="{{ route('admin.news.show', $new->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn-sm btn-blue" href="{{ route('admin.news.edit', $new->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.news.destroy', $new->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn-sm btn-red" value="{{ trans('global.delete') }}">
                                    </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.news.massDestroy') }}",
    className: 'btn-red',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    pageLength: 100,
  });
  let table = $('.datatable-news:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
