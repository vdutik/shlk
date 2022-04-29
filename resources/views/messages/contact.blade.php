@extends('layouts.pages', ['title' => 'Contact'])

@section('content')
<!-- Page Cover Section -->
<section class="section page-cover">
  <div class="page-title">
    <h1>Зв'язок</h1>
  </div>

  <canvas class="particles-background"></canvas>
</section>
<!-- end Page Cover Section -->

<!-- Contact Section -->
<section class="section contact">
  <p class="description">
    У вас є питання? Запитайте та відправте нам повідомлення.
  </p>
  <form method="POST" action="{{ action('MessagesController@store') }}" class="contact-form" autocomplete="off">
    @csrf

    <div class="form-group">
      <label for="name">Ім'я</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Василь Іванович Македонський" required />
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Optional"
      />
    </div>
    <div class="form-group">
      <label for="subject">Тема</label>
      <input type="text" class="form-control" id="subject" name="subject" placeholder="Введіть тему" />
    </div>
    <div class="form-group">
      <label for="body">Повідомлення</label>
      <textarea class="form-control" name="body" id="body" rows="1" placeholder="Введіть текст повідомлення"
        required></textarea>
    </div>
    <div class="form-group">
      <button type="submit" value="submit" class="btn btn-submit">
        Надіслати
      </button>
    </div>
  </form>

  <div class="bg">
    <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-big-top" />
    <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-small-top" />
    <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-small" />
  </div>
</section>
<!-- end Contact Section -->

<div class="section contact-map"></div>
@endsection
