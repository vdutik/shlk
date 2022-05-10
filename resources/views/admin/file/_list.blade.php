
@extends('layouts.app', ['title' => __('file.list')])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">
        <div class="col text-right">
            <a href="{{ route('file.create') }}" class="btn btn-primary btn-sm align-self-center bcg-white">
                <i class="fa fa-plus-square" aria-hidden="true"></i> __{{'forms.actions.add'}}
            </a>
        </div>
<table class="table file table-striped table-sm table-responsive-md">
    <caption>{{ trans_choice('file.count', optional($files)->count()??0) }}</caption>
    <thead>
    <tr>
        <th>@lang('file.attributes.id')</th>
        <th>@lang('file.attributes.name')</th>
        <th>@lang('file.attributes.url')</th>
        <th>@lang('file.attributes.posted_at')</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($files as $file)
        <tr>
            <td>
                {{$file->id}}
            </td>
            <td>{{ $file->name }}</td>
            <td>
                <div class="input-group">
                    {{ Form::text(null, url($file->getUrlPath()), ['class' => 'form-control', 'readonly' => true, 'id' => "medium-{$file->id}"]) }}
{{--                    <div class="input-group-append">--}}
{{--                        <button class="input-group-text btn" data-clipboard-target="#medium-{{ $file->id }}">--}}
{{--                            <i class="fa fa-clipboard"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
                </div>
            </td>
            <td>{{ $file->updated_at->format( 'd/m/Y H:i:s') }}</td>
            <td>
                <a href="{{ $file->getUrlPath()}}" title="{{ __('file.show') }}" class="btn btn-primary btn-sm" target="_blank">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a>

                <a href="{{url($file->getUrlPath())}}" title="{{ __('file.download') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>

                {!! Form::model($file, ['method' => 'DELETE', 'route' => ['file.destroy', $file], 'class' => 'form-inline', 'data-confirm' => __('forms.file.delete')]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit', 'title' => __('file.delete')]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



        @include('layouts.footers.auth')
    </div>
@endsection
