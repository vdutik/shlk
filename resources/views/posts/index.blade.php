@extends('layouts.app', ['title' => 'View My Posts'])
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

        <div class="row col-md-2">
            <select class="custom-select" name="lang" >
                <option value="uk">Українська</option>
                <option value="en">Англійська</option>
            </select>
        </div>

        @if(count($posts) > 0)
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-xl-4 mt-5 mb-5 mb-xl-0">
                        <div class="card shadow">

                            @switch($post->status)
                                @case('Published')
                                    <span class="badge badge-success badge-float">Опубліковані</span>
                                    @break

                                @case('Pending')
                                    <span class="badge badge-warning badge-float">Очікують підтвердження</span>
                                    @break

                                @case('Hidden')
                                    <span class="badge badge-secondary badge-float">Приховані</span>
                                    @break

                                @default
                                    <span class="badge badge-secondary badge-float">Невідомий статус</span>

                            @endswitch
                            @if($post->cover_image)
                                <img class="card-img-top card-img-top-post" src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
                            @endif
                            <div class="card-body card-body-post">
                                <h3 class="card-title lang uk">{{ $post->title }} </h3>
                                <h3 class="card-title lang en">{{ $post->title_en }}</h3>
                                <span>Сортувальне число {{$post->sort}} </span>
                                <p class="card-text lang uk card-text-post">
                                    {!! str_limit(strip_tags($post->body), 80) !!}
                                </p>
                                <hr>
                                <p class="card-text lang en card-text-post">
                                    {!! str_limit(strip_tags($post->body_en), 80) !!}
                                </p>
                                <p><small>Створено {{ $post->user->getName() }} | {{ $post->getDateCreated() }}</small></p>
                                <div class="button-group row">
                                    <div class="col-8">
                                        <a href="/posts/{{ $post->post_id }}" class="btn btn-outline-primary btn-sm">View</a>
                                        @if(Auth::user()->id == $post->user_id || Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                            <a href="/posts/{{$post->post_id}}/edit" class="btn btn-outline-info btn-sm">Edit</a>
                                        @endif
                                    </div>
                                    <div class="col-4 text-right">
                                        <form method="POST" action="{{ action('PostsController@destroy', $post->post_id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-5">
                {{ $posts->links() }}
            </div>
        @else
            <div class="row mt-9 mb-9">
                <div class="col text-center">
                    <p class="lead">No posts found</p>
                    <br>
                    <a href="/posts/create" class="btn btn-primary btn-lg">Create Post</a>
                </div>
            </div>
        @endif

        @include('layouts.footers.auth')
    </div>
@endsection
