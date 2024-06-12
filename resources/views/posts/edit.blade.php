@extends('layouts.app', ['title' => 'Edit Post'])

@section('styles')
    <link href="{{ asset('vendor/quilljs-1.3.6/quill.snow.css') }}" rel="stylesheet">
@endsection

@push('js')
    <script src="{{ asset('vendor/quilljs-1.3.6/quill.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let intervalFunc = function () {
                let image_path = $('#cover_image').val().split('\\');
                $('#browse-image').html(image_path[image_path.length - 1]);
            };

            $('#cover_image').on('click', function () {
                setInterval(intervalFunc, 1);
            });

            $('#cover_image_clean').on('click', function () {
                $('#cover_image').remove();
                $('#cover_image_name').remove();
                $('#cover_image_name').hide();
            });

            const Delta = Quill.import('delta');

            const BlockEmbed = Quill.import('blots/block/embed');

            class ImageBlot extends BlockEmbed {
                static blotName = 'imageCustom';
                static tagName = 'img';

                static create(value) {
                    let node = super.create();
                    node.setAttribute('src', value.url);
                    node.setAttribute('class', value.class);
                    return node;
                }

                static value(node) {
                    return {
                        url: node.getAttribute('src'),
                        class: node.getAttribute('class')
                    };
                }
            }

            Quill.register(ImageBlot);

            let quill = new Quill('#editor', {
                modules: {
                    toolbar: {
                        container: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['image']
                        ],
                        handlers: {
                            'image': function() {
                                let range = this.quill.getSelection();
                                let value = prompt('Enter image URL:');

                                quill.insertEmbed(range.index, 'imageCustom', {
                                    url: value,
                                    class: 'body-image'
                                }, Quill.sources.USER);
                            }
                        }
                    }
                },
                theme: 'snow'
            });

            let quillEn = new Quill('#editor_en', {
                modules: {
                    toolbar: {
                        container: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['image']
                        ],
                        handlers: {
                            'image': function() {
                                let range = this.quill.getSelection();
                                let value = prompt('Enter image URL:');

                                quillEn.insertEmbed(range.index, 'imageCustom', {
                                    url: value,
                                    class: 'body-image'
                                }, Quill.sources.USER);
                            }
                        }
                    }
                },
                theme: 'snow'
            });

            let postBody = {!! json_encode($post->body) !!};
            let postBodyEn = {!! json_encode($post->body_en) !!};

            quill.clipboard.dangerouslyPasteHTML(postBody);
            quillEn.clipboard.dangerouslyPasteHTML(postBodyEn);

            $("#btn-publish").click(function(){
                let body = quill.root.innerHTML;
                $("input#body").val(body);

                let bodyEn = quillEn.root.innerHTML;
                $("input#body_en").val(bodyEn);
            });

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
                    <div class="card-body">
                        <form method="POST" action="{{ action('PostsController@update', $post->post_id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row col-md-2">
                                <select class="custom-select" name="lang" >
                                    <option value="uk">Українська</option>
                                    <option value="en">Англійська</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="form-control-label mb-2">
                                        Cover Image
                                    </div>
                                    <div class="form-group">
                                        <label id="browse-image" for="cover_image" class="btn btn-outline-default">Choose Cover Image</label>
                                        <input type="file" id="cover_image" name="cover_image" value="{{$post->cover_image}}" style="display: none">
                                        <input type="input" id="cover_image_name" name="cover_image_name" value="{{$post->cover_image?:"text"}}" style="display: none">
                                        @if($post->cover_image)
                                            <span id="cover_image_clean">x</span>
                                        @endif
                                        <span id="cover_image_name">
                                        {{$post->cover_image}}
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <label class="form-control-label" for="status">Статус</label>
                                    <select class="custom-select" name="status">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ $status == $post->status ? 'selected' : '' }}>{{ __('general.statuses.' . strtolower($status)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row lang uk">
                                <div class="col-12 col-lg-8">
                                    <label class="form-control-label" for="title">Title</label>
                                    <input id="title" name="title" class="form-control mb-3" type="text" placeholder="Enter title..." value="{{$post->title}}" required>
                                </div>
                            </div>
                            <div class="row lang en">
                                <div class="col-12 col-lg-8">
                                    <label class="form-control-label" for="title">Title (Eng.)</label>
                                    <input id="title" name="title_en" class="form-control mb-3" type="text" placeholder="Enter title..." value="{{$post->title_en}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <label class="form-control-label" for="title">Сортувальне число </label>
                                    <input id="sort" name="sort" class="form-control mb-3" type="text" placeholder="Введіть сортувальне число...." value="{{$post->sort}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 ">
                                    <label class="form-control-label" for="title">Теги</label>
                                    <select class="form-control" name="tags[]" multiple="">
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}"
                                                    @if($post->tags->where('id',$tag->id)->count()==1)selected="selected"@endif>
                                                {{__($tag->slug)}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-7 lang uk">
                                <div class="col-12 col-lg-12">
                                    <label class="form-control-label" for="title">Body</label>
                                    <input id="body" name="body" type="hidden" value="{{ htmlspecialchars($post->body) }}" required>
                                    <div id="editor" style="font-family: 'Open Sans', sans-serif"></div>
                                </div>
                            </div>

                            <div class="row mb-7 lang en">
                                <div class="col-12 col-lg-12">
                                    <label class="form-control-label" for="title">Body (Eng.)</label>
                                    <input id="body_en" name="body_en" type="hidden" value="{{ htmlspecialchars($post->body_en) }}" required>
                                    <div id="editor_en" style="font-family: 'Open Sans', sans-serif"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="form-control-label mb-2">
                                        Прикріплені фотографії
                                    </div>
                                    <div class="form-group">
                                        <label id="browse-image" for="post_images" class="btn btn-outline-default">Choose images </label>
                                        <input type="file" id="post_images" name="post_images[]" multiple="true"  style="display: none">
                                    </div>
                                    <div class="post_images">
                                        @foreach($post->media as $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank"> Ідентифікатор фотографії: {{$media->id}}
                                                <img src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}" width="100">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <button id="btn-publish" type="submit" class="btn btn-outline-primary">Update</button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="javascript:history.back()">Cancel</button>
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
