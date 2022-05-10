@extends('layouts.app', ['title' => __('tags.create')])

@section('content')
    @include('layouts.headers.plain')


    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                {!! Form::open(['route' => ['tags.store'], 'method' =>'POST']) !!}

                <div class="form-group">
                    {!! Form::label('slug', __('tag.attributes.slug')) !!}
                    {!! Form::text('slug', null, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : '')]) !!}

                    @error('slug')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                {{ link_to_route('tags.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}
                {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection
