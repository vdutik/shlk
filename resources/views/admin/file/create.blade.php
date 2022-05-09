@extends('layouts.app', ['title' => __('file.create')])

@section('content')
    @include('layouts.headers.plain')


    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                {!! Form::open(['route' => ['file.store'], 'method' =>'POST', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('file', __('file.attributes.file')) !!}
                    {!! Form::file('file', [ 'class' => 'form-control' . ($errors->has('file') ? ' is-invalid' : ''), 'required']) !!}

                    @error('file')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('name', __('file.attributes.name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}

                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                {{ link_to_route('file.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}
                {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection
