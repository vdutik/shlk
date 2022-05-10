
@extends('layouts.app', ['title' => __('tag.list')])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">
        <div class="col text-right">
            <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm align-self-center bcg-white">
                <i class="fa fa-plus-square" aria-hidden="true"></i> __{{'forms.actions.add'}}
            </a>
        </div>
<table class="table tag table-striped table-sm table-responsive-md">
    <caption>{{ trans_choice('tag.count', optional($tags)->count()??0) }}</caption>
    <thead>
    <tr>
        <th>@lang('tag.attributes.id')</th>
        <th>@lang('tag.attributes.slug')</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
        <tr>
            <td>
                {{$tag->id}}
            </td>
            <td>{{ $tag->slug }}</td>

            <td>
                {!! Form::model($tag, ['method' => 'DELETE', 'route' => ['tags.destroy', $tag], 'class' => 'form-inline', 'data-confirm' => __('forms.tag.delete')]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit', 'title' => __('tag.delete')]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



        @include('layouts.footers.auth')
    </div>
@endsection
