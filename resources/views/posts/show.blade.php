@extends('layouts.app', ['title' => 'View Post'])
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            let selecter_lang = $('select[name="lang"]').val();

            $('.lang').hide();
            $('.lang.uk').show();

            $('select[name="lang"]').change(function(){
                var selectedValue = $(this).val();
                $('.lang').hide(); // скрыть все элементы с классом myDiv
                $(".lang." + selectedValue).show(); // показать элемент с id равным выбранному значению
            });

        });
    </script>
@endpush
@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">

                <div class="card shadow">

                    @switch($post->status)
                        @case('Published')
                        <span class="badge badge-success badge-float">Опубліковані</span>
                        @break

                        @default
                        <span class="badge badge-warning badge-float">Очікують підтвердження</span>
                        @break
                    @endswitch
                    @if($post->cover_image)
                        <img class="card-img-top" src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
                    @endif
                    <br>
                    <div class="row col-md-2">
                        <select class="custom-select" name="lang" >
                            <option value="uk">Українська</option>
                            <option value="en">Англійська</option>
                        </select>
                    </div>
                    <br>
                    <div class="card-body">
                        <h1 class="card-title mb-2 lang uk">{{ $post->title }}</h1>
                        <h1 class="card-title mb-2 lang en">{{ $post->title_en }}</h1>
                        <h5 class="mb-4">Написаий автором {{ $post->user->getName() }}</h5>
                        <h5 class="mb-4">Сортувальне число  {{ $post->sort }}</h5>
                        <div class="card-text lang uk">
                            {!! html_entity_decode($post->body) !!}
                        </div>
                        <hr>
                        <div class="card-text lang en">
                            {!! html_entity_decode($post->body_en) !!}
                        </div>
                        <hr>
                        <p>
                            Створено о {{ $post->created_at->format('g:iA d m Y') }}
                            | оновлено о {{ $post->created_at->format('g:iA d m Y') }}
                        </p>
                        <div class="button-group row mt-5">
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-primary" onclick="javascript:history.back()">Return</button>
                            </div>
                            @if(Auth::user()->id == $post->user_id || Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                <div class="col-8 text-right">
                                    <a href="/posts/{{$post->post_id}}/edit" class="btn btn-outline-info">Edit</a>
                                    <form method="POST" action="{{ action('PostsController@destroy', $post->post_id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
