<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        @include('layouts.headers.messages')
          <!-- Card stats -->
          <div class="row">
              <div class="col-xl-3 col-sm-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                          <h5 class="card-title text-uppercase text-muted mb-0">Поточний аккадемічний термін</h5>
                          <span class="h2 font-weight-bold mb-0">S.Y. {{ $curAcadTerm->sy }}</span>
                          <p class="mt-3 mb-0 text-muted text-sm">
                              <span class="text-nowrap">{{ $curAcadTerm->getSem() }}</span>
                          </p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                          <h5 class="card-title text-uppercase text-muted mb-0">Попередній іспит</h5>
                          <span class="h2 font-weight-bold mb-0">
                            @if($curAcadTerm->prelimsEvent != null)
                                {{ $curAcadTerm->prelimsEvent->getDate() }}
                            @else
                                  буде оголошено пізніше
                            @endif
                          </span>
                          <p class="mt-3 mb-0 text-muted text-sm">
                              <span class="text-nowrap">{{ $curAcadTerm->getAcadTerm() }}</span>
                          </p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                          <h5 class="card-title text-uppercase text-muted mb-0">Проміжний іспит</h5>
                          <span class="h2 font-weight-bold mb-0">
                            @if($curAcadTerm->midtermsEvent != null)
                                {{ $curAcadTerm->midtermsEvent->getDate() }}
                            @else
                                TBA
                            @endif
                          </span>
                          <p class="mt-3 mb-0 text-muted text-sm">
                              <span class="text-nowrap">{{ $curAcadTerm->getAcadTerm() }}</span>
                          </p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                      <div class="card-body">
                          <h5 class="card-title text-uppercase text-muted mb-0">Кінцевий іспит</h5>
                          <span class="h2 font-weight-bold mb-0">
                            @if($curAcadTerm->finalsEvent != null)
                                {{ $curAcadTerm->finalsEvent->getDate() }}
                            @else
                                TBA
                            @endif
                          </span>
                          <p class="mt-3 mb-0 text-muted text-sm">
                              <span class="text-nowrap">{{ $curAcadTerm->getAcadTerm() }}</span>
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
