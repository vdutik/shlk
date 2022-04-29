@extends('layouts.pages', ['title' => 'About'])

@section('content')
<!-- Page Cover Section -->
<section class="section page-cover">
  <div class="page-title">
    <h1>Про нас</h1>
  </div>

  <canvas class="particles-background"></canvas>
</section>
<!-- end Page Cover Section -->

<!-- About Section -->
<section class="section about">
  <div class="image">
    <img src="{{ asset('spccweb/img/hero.jpg') }}" alt="SPCC Caloocan School Building" />
  </div>
  <div class="content">
    <h2>Шацький лісовий технікум ім. В.В.Сулька</h2>
    <div class="description">
      <p>
          Коледж створений на базі Шацького лісного технікуму ім. В.В.Сулька Наказом №484 від 16.11.2005 Державного комітету лісового господарства України.

      </p>
        <p>

          Шацький лісний технікум заснований в 1963 році на основі наказу начальника Головного управління лісового господарства і лісозаготівель при Раді Міністрів УРСР від 20.06.1963року №134К і переданий в безпосереднє підпорядкування Міністерства лісового господарства УРСР. В 1997 році технікуму присвоєне ім’я першого директора, заслуженого лісівника України Сулька Валентина Васильовича.

          В своїй навчально-виховній діяльності коледж керується Статутом, затвердженим та зареєстрованим Міністерством освіти і науки України, концепцію діяльності коледжу узгоджено з управлінням освіти облдержадміністрації.

          Коледж проводить підготовку спеціалістів за держзамовленням, а також за договорами з фізичними особами, з підприємствами і організаціями за такими спеціальностями в межах ліцензованого обсягу: 205  «Лісове господарство», 205 «Лісозаготівля та первинна обробка деревини», 071  «Облік і опаодаткування» і за заочною формою спеціальності 205 «Лісове господарство».

      </p>
      <p>
          Підготовку фахівців здійснюють 49 викладачів з необхідною фаховою та педагогічною освітою. За наслідками атестації вищу категорію мають 37% викладачів і 28% першу. Серед викладачів є методисти, старші викладачі.
      </p>
        <p>

          Педагогічний колектив стабільний. Навчально матеріальна база відповідає вимогам освітньо-кваліфікаційних програм, навчальних планів. Щорічно здійснюється капітальний ремонт окремих аудиторій. Загальна площа навчальних приміщень складає 8622м2. Учбова площа на одного студента становить 8,7 кв.м. Санітарно-технічний стан будівель відповідає санітарно -гігієнічним та естетичним вимогам.

          Навчально – виховний процес в коледжі спрямований на розвиток творчих, розумових, фізичних здібностей студентів, виховання у них високих моральних якостей. Підготовка спеціалістів ведеться на основі взаємозв’язку з виробництвом, участі студентів та викладачів в науково-дослідницькій роботі.
      </p>
    </div>
  </div>

  <div class="bg">
    <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-big" />
  </div>
</section>
<!-- end About Section -->

<!-- Info Tab Section -->
<section class="section info-tab">
  <div class="tab-menu">
    <ul class="tab-nav">
      <li>
        <a href="#" data-target="#tab-mission">Місія</a>
      </li>
      <li>
        <a href="#" data-target="#tab-vision">Бачення</a>
      </li>
      <li>
        <a href="#" data-target="#tab-values">Основні цінності</a>
      </li>
      <li>
        <a href="#" data-target="#tab-president">Директор</a>
      </li>
      <li>
        <a href="#" data-target="#tab-hymn">Гімн</a>
      </li>
    </ul>
  </div>
  <div class="tab-content">
    <div id="tab-mission" class="tab-current">
      <h2>Місія</h2>
      <p>
          Лісовий коледж прагне надавати ліберальну, якісну, трансформуючу та відповідну освіту
          для цілісного розвитку всіх зацікавлених сторін завдяки досконалості в навчанні,
          дослідженнях та послугах розширення.
      </p>
    </div>
    <div id="tab-vision">
      <h2>Бачення</h2>
      <p>
          Провідний і конкурентоспроможний у всьому світі заклад навчання за допомогою послуг та інновацій.
      </p>
    </div>
    <div id="tab-values">
      <h2>Основні цінності</h2>
      <h3>Обслуговування</h3>
      <p>
          Беріть участь у шкільних заходах, партнерстві з громадою,
          інформаційно-пропагандистській діяльності та соціальній адвокації.
      </p>
      <h3>Професіоналізм</h3>
      <p>
          Продемонструвати та взяти на себе відповідальність за дії.
      </p>
      <h3>Компетентність</h3>
      <p>
          Розвивайте та дотримуйтесь високих стандартів якості та високої продуктивності.
      </p>
      <h3>Товариство</h3>
      <p>
          Співпрацюйте, співпрацюйте та ефективно спілкуйтеся,
          ставтеся один до одного з повагою та справедливістю та виховуйте товариськість.
      </p>
    </div>
    <div id="tab-president">
      <h2>President's Corner</h2>
      <img src="{{ asset('spccweb/img/president.jpg') }}" alt="SPCF President" />
      <h3>Жмурко Ігор Васильвич</h3>
      <p>Директор</p>
      <p>Systems Plus Computer Foundation</p>
    </div>
    <div id="tab-hymn">
      <h2>SPCC Гімн</h2>
      <div class="content">
        <p>
          Your vision in our hearts<br />
          Will shine forever more<br />
          We'll walk the halls of Systems Plus<br />
          Until we give our all.
        </p>
        <p>
          The value of your guidance<br />
          The wisdom of your light<br />
          And we will be the children<br />
          Who will live in your loyalty.
        </p>
        <p>
          Commitment to excellence<br />
          That has turned the key<br />
          The promises we made<br />
          Are the dreams we'll <u>ever make</u> (2x)
        </p>
        <p>
          The vision in our hearts<br />
          Will shine forever more<br />
          We'll walk in strength and character<br />
          And love will be at sight.
        </p>
        <p>
          The value of your guidance<br />
          The wisdom of your light<br />
          And we will be the children<br />
          We will be the children (2x)<br />
          Who'll live in loyalty.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- end Info Menu Section -->
@endsection
