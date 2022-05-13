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

<div class="contact-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2088.8787446079136!2d23.92136532422654!3d51.49061167828034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4723fb672a2a9699%3A0xf71f674c8538ff31!2z0KjQsNGG0YzQutC40Lkg0LvRltGB0L7QstC40Lkg0LrQvtC70LXQtNC2INGW0LwuINCh0YLQtdC_0LDQvdCwINCR0LDQvdC00LXRgNC4!5e0!3m2!1suk!2sua!4v1652432375985!5m2!1suk!2sua"  style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@endsection
