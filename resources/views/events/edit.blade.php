@extends('layouts.app', ['title' => 'Edit Event'])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-body">
                      <form id="form-post" method="POST" action="{{ action('EventsController@update', $event->event_id) }}">
                          @csrf
                          @method('PUT')

                          <div class="row">
                            <div class="col-12 col-lg-8">
                                <label class="form-control-label" for="title">Назва події</label>
                                <input id="title" name="title" class="form-control mb-3" type="text" placeholder="Enter title..."  value="{{ $event->title }}" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12 col-md-6 col-lg-3">
                                <label class="form-control-label" for="start_date">Дата початку</label>
                                <input id="start_date" name="start_date" class="form-control mb-3" type="date" placeholder="Enter date..." value="{{ $event->start_date }}" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12 col-md-6 col-lg-3">
                                <label class="form-control-label" for="end_date">Дата закінченя</label>
                                <input id="end_date" name="end_date" class="form-control mb-3" type="date" placeholder="Enter date..." value="{{ $event->end_date }}" required>
                            </div>
                          </div>

                          <div class="row mt-4">
                              <div class="col-12 col-lg-12">
                                <button type="submit" class="btn btn-outline-info">
                                  <span class="btn-inner--icon"><i class="ni ni-single-copy-04"></i></span>
                                  <span class="btn-inner--text">Оновити подію</span>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="javascript:history.back()">Скасувати</button>
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>

      @include('layouts.footers.auth')
    </div>
@endsection
