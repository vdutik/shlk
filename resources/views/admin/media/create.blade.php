@extends('layouts.app', ['title' => __('media.create')])

@section('content')
    @include('layouts.headers.plain')


    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                {!! Form::open(['route' => ['media.store'], 'method' =>'POST', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('image', __('media.attributes.image')) !!}
                    {!! Form::file('image', [ 'class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'required']) !!}

                    @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('name', __('media.attributes.name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}

                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                {{ link_to_route('media.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}
                {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection
