@extends('layouts.pages', ['title' => $title??'Адміністрація'])

@section('content')
<!-- Page Cover Section -->
<section class="section page-cover">
  <div class="page-title">
    <h1>{{$title??'Адміністрація'}}</h1>
  </div>

  <canvas class="particles-background"></canvas>
</section>
<!-- end Page Cover Section -->
<div class="colleague-structure">
    <div class="director">
      <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
      <p>Name: John Smith</p>
      <p>Position: Director</p>
      <p>Description: John is the director of our company. He has been with us for over 10 years and has a wealth of experience in management. He is dedicated to ensuring the success of our team and the company as a whole.</p>
    </div>
    <div class="accountant">
      <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
      <p>Name: Jane Doe</p>
      <p>Position: Accountant</p>
      <p>Description: Jane is our company's accountant. She is responsible for managing our financial records and ensuring that everything is in order. She is extremely detail-oriented and always goes the extra mile to make sure everything is accurate and up-to-date.</p>
    </div>
    <div class="teacher">
      <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
      <p>Name: Sarah Johnson</p>
      <p>Position: Teacher</p>
      <p>Description: Sarah is one of our talented teachers. She has a passion for education and is dedicated to helping her students succeed. She is always willing to go above and beyond to ensure that her students have the best possible learning experience.</p>
    </div>
    <div class="salesperson">
      <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
      <p>Name: Michael Brown</p>
      <p>Position: Salesperson</p>
      <p>Description: Michael is our top salesperson. He has a knack for building relationships with clients and is always finding ways to grow our business. He is driven and motivated, and we are grateful to have him on our team.</p>
    </div>
    <div class="marketer">
      <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
      <p>Name: Emily Davis</p>
      <p>Position: Marketer</p>
      <p>Description: Emily is our talented marketer. She is responsible for creating and implementing marketing strategies that help our company reach new customers and grow. She is creative and always coming up with new ideas to promote our brand.</p>
    </div>
    <div class="developer">
      <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
      <p>Name: David Thompson</p>
      <p>Position: Developer</p>
      <p>Description: David is one of our talented developers. He is skilled in a variety of programming languages and is always looking for ways to improve our systems and processes. He is a valuable member of our team and we rely on his expertise to help drive our company forward.</p>
    </div>
  <div class="teacher">
    <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
    <p>Name: Sarah Johnson</p>
    <p>Position: Teacher</p>
    <p>Description: Sarah is one of our talented teachers. She has a passion for education and is dedicated to helping her students succeed. She is always willing to go above and beyond to ensure that her students have the best possible learning experience.</p>
  </div>
    <div>
    <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}">
    <p>Name: Rachel Williams</p>
    <p>Position: Designer</p>
    <p>Description: Rachel is our talented designer. She is responsible for creating visually appealing graphics and designs that help our company stand out. She is always willing to go the extra mile to ensure that her designs are of the highest quality and meet our business goals.</p>
  </div>
</div>
<!-- end -->

@endsection

<style>
  .colleague-structure {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
  }

  .colleague-structure div {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: calc(25% - 20px);
    margin: 10px;
  }

  .colleague-structure img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
  }

  .colleague-structure p {
    font-size: 18px;
    margin: 10px 0;
  }

  @media (max-width: 1280px) {
    .colleague-structure div {
      width: calc(33.3333% - 20px);
    }
  }

  @media (max-width: 960px) {
    .colleague-structure div {
      width: calc(50% - 20px);
    }
  }

  @media (max-width: 768px) {
    .colleague-structure {
      flex-direction: column;
    }

    .colleague-structure div {
      width: calc(100% - 20px);
      margin: 20px 0;
    }
  }
</style>