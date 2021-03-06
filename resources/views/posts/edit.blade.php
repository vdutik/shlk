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

      let quill = new Quill('#editor', {
        modules: {
          toolbar: [
            [{ header: [1, 2, 3, false] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'align': [] }]
          ]
        },
        theme: 'snow'
      });

      let initialBody = $("input#body").val();
      $("#editor .ql-editor").html(initialBody);

      $("#btn-publish").click(function(){
          let body = $("#editor *").html();

          $("input#body").val(body);
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

                          <div class="row">
                              <div class="col-12 col-lg-5">
                                <div class="form-control-label mb-2">
                                  Cover Image
                                </div>
                                <div class="form-group">
                                    <label id="browse-image" for="cover_image" class="btn btn-outline-default">Choose Cover Image</label>
                                    <input type="file" id="cover_image" name="cover_image" value="{{$post->cover_image}}" style="display: none">
                                    <span>
                                        {{$post->cover_image}}
                                    </span>
                                </div>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-12 col-lg-8">
                                <label class="form-control-label" for="title">Title</label>
                                <input id="title" name="title" class="form-control mb-3" type="text" placeholder="Enter title..." value="{{$post->title}}" required>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-12 ">
                                  <label class="form-control-label" for="title">????????</label>
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

                          <div class="row mb-7">
                            <div class="col-12 col-lg-12">
                              <label class="form-control-label" for="title">Body</label>
                              <input id="body" name="body" type="hidden" value="{{$post->body}}" required>
                              <div id="editor" style="font-family: 'Open Sans', sans-serif"></div>
                            </div>
                          </div>

                          <div class="row">
                              <div class="col-12 col-lg-5">
                                  <div class="form-control-label mb-2">
                                      ?????????????????????? ????????????????????
                                  </div>
                                  <div class="form-group">
                                      <label id="browse-image" for="post_images" class="btn btn-outline-default">Choose images </label>
                                      <input type="file" id="post_images" name="post_images[]" multiple="true"  style="display: none">
                                  </div>
                                  <div class="post_images">
                                  @foreach($post->media as $media)
                                          <a href="{{ $media->getUrl() }}" target="_blank"> ?????????????????????????? ????????????????????: {{$media->id}}
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
