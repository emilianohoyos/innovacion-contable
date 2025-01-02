@extends('layouts.master')

@section('title', 'Data')
@section('css')

@endsection
@section('content')
<x-page-title title="Widgets" pagetitle="Data" />

      <div class="row row-cols-1 row-cols-lg-3">
        <div class="col d-flex">
          <div class="card w-100">
            <div class="card-header border-0 p-3 border-bottom">
              <div class="position-relative">
                <input class="form-control rounded-5 px-5" type="text" placeholder="Search">
                <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                <span
                  class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50">people</span>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="user-list p-3">
                <div class="d-flex flex-column gap-3">
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ URL::asset('dist/images/avatars/01.png') }}" width="45" height="45" class="rounded-circle" alt="">
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Elon Jonado</h6>
                      <p class="mb-0">elon_deo</p>
                    </div>
                    <div class="form-check form-check-inline me-0">
                      <input class="form-check-input ms-0" type="checkbox">
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ URL::asset('dist/images/avatars/02.png') }}" width="45" height="45" class="rounded-circle" alt="">
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Alexzender Clito</h6>
                      <p class="mb-0">zli_alexzender</p>
                    </div>
                    <div class="form-check form-check-inline me-0">
                      <input class="form-check-input ms-0" type="checkbox">
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ URL::asset('dist/images/avatars/03.png') }}" width="45" height="45" class="rounded-circle" alt="">
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Michle Tinko</h6>
                      <p class="mb-0">tinko_michle</p>
                    </div>
                    <div class="form-check form-check-inline me-0">
                      <input class="form-check-input ms-0" type="checkbox">
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ URL::asset('dist/images/avatars/04.png') }}" width="45" height="45" class="rounded-circle" alt="">
                    <div class="flex-grow-1">
                      <h6 class="mb-0">KailWemba</h6>
                      <p class="mb-0">wemba_kl</p>
                    </div>
                    <div class="form-check form-check-inline me-0">
                      <input class="form-check-input ms-0" type="checkbox">
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ URL::asset('dist/images/avatars/05.png') }}" width="45" height="45" class="rounded-circle" alt="">
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Henhco Tino</h6>
                      <p class="mb-0">Henhco_tino</p>
                    </div>
                    <div class="form-check form-check-inline me-0">
                      <input class="form-check-input ms-0" type="checkbox">
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ URL::asset('dist/images/avatars/06.png') }}" width="45" height="45" class="rounded-circle" alt="">
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Gonjiko Fernando</h6>
                      <p class="mb-0">gonjiko_fernando</p>
                    </div>
                    <div class="form-check form-check-inline me-0">
                      <input class="form-check-input ms-0" type="checkbox">
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ URL::asset('dist/images/avatars/08.png') }}" width="45" height="45" class="rounded-circle" alt="">
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Specer Kilo</h6>
                      <p class="mb-0">specer_kilo</p>
                    </div>
                    <div class="form-check form-check-inline me-0">
                      <input class="form-check-input ms-0" type="checkbox">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent p-3">
              <div class="d-flex align-items-center justify-content-between gap-3">
                <a href="javascript:;" class="sharelink"><i class="material-icons-outlined">share</i></a>
                <a href="javascript:;" class="sharelink"><i class="material-icons-outlined">textsms</i></a>
                <a href="javascript:;" class="sharelink"><i class="material-icons-outlined">email</i></a>
                <a href="javascript:;" class="sharelink"><i class="material-icons-outlined">attach_file</i></a>
                <a href="javascript:;" class="sharelink"><i class="material-icons-outlined">event</i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col d-flex">
          <div class="card w-100">
            <div class="card-header p-3 bg-transparent">
              <div class="d-flex align-items-center justify-content-between">
                <div class="">
                  <h5 class="mb-0">Income / Expense</h5>
                </div>
                <div class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <span class="material-icons-outlined fs-5">more_vert</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="payments-list">
                <div class="d-flex flex-column gap-4">
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle border">
                      <img src="{{ URL::asset('dist/images/apps/11.png') }}" width="30" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <h5 class="mb-0">$4856</h5>
                      <p class="mb-0">Paypal</p>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-success">
                      <span class="material-icons-outlined">expand_less</span>
                      <span>28.5%</span>
                    </div>
                  </div>

                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle border">
                      <img src="{{ URL::asset('dist/images/apps/10.png') }}" width="30" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <h5 class="mb-0">$1286</h5>
                      <p class="mb-0 fs-6">Figma </p>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-success">
                      <span class="material-icons-outlined">expand_less</span>
                      <span>12.4%</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle border">
                      <img src="{{ URL::asset('dist/images/apps/13.png') }}" width="30" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <h5 class="mb-0">$9946</h5>
                      <p class="mb-0 fs-6">Visa Card</p>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-danger">
                      <span class="material-icons-outlined">expand_less</span>
                      <span>18.5%</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle border">
                      <img src="{{ URL::asset('dist/images/apps/01.png') }}" width="30" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <h5 class="mb-0">$4376</h5>
                      <p class="mb-0 fs-6">Gmail</p>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-success">
                      <span class="material-icons-outlined">expand_less</span>
                      <span>32.8%</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle border">
                      <img src="{{ URL::asset('dist/images/apps/02.png') }}" width="30" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <h5 class="mb-0">$6674</h5>
                      <p class="mb-0 fs-6">Skype</p>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-danger">
                      <span class="material-icons-outlined">expand_less</span>
                      <span>27.8%</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle border">
                      <img src="{{ URL::asset('dist/images/apps/06.png') }}" width="30" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <h5 class="mb-0">$3489</h5>
                      <p class="mb-0 fs-6">Instagram</p>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-success">
                      <span class="material-icons-outlined">expand_less</span>
                      <span>10.2%</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle border">
                      <img src="{{ URL::asset('dist/images/apps/04.png') }}" width="30" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <h5 class="mb-0">$5578</h5>
                      <p class="mb-0 fs-6">Youtube</p>
                    </div>
                    <div class="d-flex align-items-center gap-1 text-success">
                      <span class="material-icons-outlined">expand_less</span>
                      <span>37.2%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col d-flex">
          <div class="card w-100">
            <div class="card-header p-3">
              <div class="d-flex align-items-center gap-3">
                <div
                  class="d-flex flex-row gap-3 align-items-center justify-content-center border p-3 rounded-3 flex-fill">
                  <img src="{{ URL::asset('dist/images/avatars/11.png') }}" width="40" height="40" class="rounded-circle" alt="">
                  <div class="">
                    <h5 class="mb-0">65%</h5>
                    <p class="mb-0">Male</p>
                  </div>
                </div>
                <div
                  class="d-flex flex-row gap-2 align-items-center justify-content-center border p-3 rounded-3 flex-fill">
                  <img src="{{ URL::asset('dist/images/avatars/12.png') }}" width="40" height="40" class="rounded-circle" alt="">
                  <div class="">
                    <h5 class="mb-0">35%</h5>
                    <p class="mb-0">Female</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h5 class="mb-3">Campaign Portfolio</h5>
              <div class="d-flex flex-column justify-content-between gap-4">
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{ URL::asset('dist/images/apps/17.png') }}" width="32" alt="">
                    <p class="mb-0">Facebook</p>
                  </div>
                  <div class="">
                    <p class="mb-0 fs-5">65%</p>
                  </div>
                  <div class="">
                    <p class="mb-0 data-attributes">
                      <span
                        data-peity='{ "fill": ["#0d6efd", "rgb(0 0 0 / 10%)"],   "innerRadius": 16, "radius": 20 }'>5/7</span>
                    </p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{ URL::asset('dist/images/apps/18.png') }}" width="32" alt="">
                    <p class="mb-0">Facebook</p>
                  </div>
                  <div class="">
                    <p class="mb-0 fs-5">65%</p>
                  </div>
                  <div class="">
                    <p class="mb-0 data-attributes">
                      <span
                        data-peity='{ "fill": ["#fc185a", "rgb(0 0 0 / 10%)"],   "innerRadius": 16, "radius": 20 }'>5/7</span>
                    </p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{ URL::asset('dist/images/apps/19.png') }}" width="32" alt="">
                    <p class="mb-0">Facebook</p>
                  </div>
                  <div class="">
                    <p class="mb-0 fs-5">65%</p>
                  </div>
                  <div class="">
                    <p class="mb-0 data-attributes">
                      <span
                        data-peity='{ "fill": ["#02c27a", "rgb(0 0 0 / 10%)"],   "innerRadius": 16, "radius": 20 }'>5/7</span>
                    </p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{ URL::asset('dist/images/apps/20.png') }}" width="32" alt="">
                    <p class="mb-0">Facebook</p>
                  </div>
                  <div class="">
                    <p class="mb-0 fs-5">65%</p>
                  </div>
                  <div class="">
                    <p class="mb-0 data-attributes">
                      <span
                        data-peity='{ "fill": ["#fd7e14", "rgb(0 0 0 / 10%)"],   "innerRadius": 16, "radius": 20 }'>5/7</span>
                    </p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{ URL::asset('dist/images/apps/05.png') }}" width="32" alt="">
                    <p class="mb-0">Facebook</p>
                  </div>
                  <div class="">
                    <p class="mb-0 fs-5">65%</p>
                  </div>
                  <div class="">
                    <p class="mb-0 data-attributes">
                      <span
                        data-peity='{ "fill": ["#0dcaf0", "rgb(0 0 0 / 10%)"],   "innerRadius": 16, "radius": 20 }'>5/7</span>
                    </p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{ URL::asset('dist/images/apps/08.png') }}" width="32" alt="">
                    <p class="mb-0">Facebook</p>
                  </div>
                  <div class="">
                    <p class="mb-0 fs-5">65%</p>
                  </div>
                  <div class="">
                    <p class="mb-0 data-attributes">
                      <span
                        data-peity='{ "fill": ["#6f42c1", "rgb(0 0 0 / 10%)"],   "innerRadius": 16, "radius": 20 }'>5/7</span>
                    </p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="col d-flex">
          <div class="card w-100">
            <div class="card-header p-3 bg-transparent">
              <div class="d-flex align-items-center justify-content-between">
                <div class="">
                  <h5 class="mb-0">Popular Products</h5>
                </div>
                <div class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="material-icons-outlined fs-5">more_vert</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ URL::asset('dist/images/top-products/01.png') }}" width="55" alt="">
                  <div class="flex-grow-1">
                    <h6 class="mb-0">Apple Hand Watch</h6>
                    <p class="mb-0">Sale: 258</p>
                  </div>
                  <div class="">
                    <h5 class="mb-0">$199</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ URL::asset('dist/images/top-products/02.png') }}" width="55" alt="">
                  <div class="flex-grow-1">
                    <h6 class="mb-0">Mobile Phone Set</h6>
                    <p class="mb-0">Sale: 169</p>
                  </div>
                  <div class="">
                    <h5 class="mb-0">$159</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ URL::asset('dist/images/top-products/03.png') }}" width="55" alt="">
                  <div class="flex-grow-1">
                    <h6 class="mb-0">Fancy Chair</h6>
                    <p class="mb-0">Sale: 268</p>
                  </div>
                  <div class="">
                    <h5 class="mb-0">$678</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ URL::asset('dist/images/top-products/04.png') }}" width="55" alt="">
                  <div class="flex-grow-1">
                    <h6 class="mb-0">Blue Shoes Pair</h6>
                    <p class="mb-0">Sale: 859</p>
                  </div>
                  <div class="">
                    <h5 class="mb-0">$279</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ URL::asset('dist/images/top-products/05.png') }}" width="55" alt="">
                  <div class="flex-grow-1">
                    <h6 class="mb-0">Blue Yoga Mat</h6>
                    <p class="mb-0">Sale: 328</p>
                  </div>
                  <div class="">
                    <h5 class="mb-0">$389</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ URL::asset('dist/images/top-products/06.png') }}" width="55" alt="">
                  <div class="flex-grow-1">
                    <h6 class="mb-0">White water Bottle</h6>
                    <p class="mb-0">Sale: 992</p>
                  </div>
                  <div class="">
                    <h5 class="mb-0">$584</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ URL::asset('dist/images/top-products/07.png') }}" width="55" alt="">
                  <div class="flex-grow-1">
                    <h6 class="mb-0">Laptop Full HD</h6>
                    <p class="mb-0">Sale: 489</p>
                  </div>
                  <div class="">
                    <h5 class="mb-0">$398</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent p-3">
               <div class="d-grid">
                <a href="javascript:;" class="btn btn-outline-primary">View All Products</a>
               </div>
            </div>
          </div>
        </div>

        <div class="col d-flex">
          <div class="card w-100">
            <div class="card-header p-3 bg-transparent">
              <div class="d-flex align-items-center justify-content-between">
                <div class="">
                  <h5 class="mb-0">Recent Transactions</h5>
                </div>
                <div class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <span class="material-icons-outlined fs-5">more_vert</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="payments-list">
                <div class="d-flex flex-column gap-4">
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center bg-danger rounded-circle">
                      <span class="material-icons-outlined text-white">shopping_cart</span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Online Purchase</h6>
                      <p class="mb-0">03/10/2022</p>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <h5 class="mb-0">$9848</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-primary">
                      <span class="material-icons-outlined text-white">monetization_on</span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Online Purchase</h6>
                      <p class="mb-0">03/10/2022</p>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <h5 class="mb-0">$9848</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-success">
                      <span class="material-icons-outlined text-white">credit_card</span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Online Purchase</h6>
                      <p class="mb-0">03/10/2022</p>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <h5 class="mb-0">$9848</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-purple">
                      <span class="material-icons-outlined text-white">account_balance</span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Online Purchase</h6>
                      <p class="mb-0">03/10/2022</p>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <h5 class="mb-0">$9848</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-orange">
                      <span class="material-icons-outlined text-white">savings</span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Online Purchase</h6>
                      <p class="mb-0">03/10/2022</p>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <h5 class="mb-0">$9848</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-info">
                      <span class="material-icons-outlined text-white">paid</span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Online Purchase</h6>
                      <p class="mb-0">03/10/2022</p>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <h5 class="mb-0">$9848</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wh-48 d-flex align-items-center justify-content-center rounded-circle bg-pink">
                      <span class="material-icons-outlined text-white">card_giftcard</span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">Online Purchase</h6>
                      <p class="mb-0">03/10/2022</p>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <h5 class="mb-0">$9848</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent p-3">
              <div class="d-grid">
               <a href="javascript:;" class="btn btn-outline-primary">View All Transactions</a>
              </div>
           </div>
          </div>
        </div>
        <div class="col d-flex">
           <div class="card w-100">
            <div class="card-header p-3 bg-transparent">
              <div class="d-flex align-items-center justify-content-between">
                <div class="">
                  <h5 class="mb-0">Country Sales</h5>
                </div>
                <div class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <span class="material-icons-outlined fs-5">more_vert</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </div>
              </div>
            </div>
             <div class="card-body">
                <div class="d-flex flex-column gap-4">
                   <div class="d-flex align-items-center gap-3">
                     <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                         <img src="{{ URL::asset('dist/images/county/01.png') }}" width="40" alt="">
                         <div class="">
                            <h5 class="mb-0">$95,256</h5>
                            <p class="mb-0">Canada</p>
                         </div>
                     </div>
                     <div class="progress w-25" style="height: 7px;">
                        <div class="progress-bar" style="width: 65%"></div>
                     </div>
                     <div class="">
                      <p class="mb-0 fs-5">68%</p>
                     </div>
                   </div>
                   <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                        <img src="{{ URL::asset('dist/images/county/02.png') }}" width="40" alt="">
                        <div class="">
                           <h5 class="mb-0">$75M</h5>
                           <p class="mb-0">United Kingdom</p>
                        </div>
                    </div>
                    <div class="progress w-25" style="height: 7px;">
                       <div class="progress-bar" style="width: 55%"></div>
                    </div>
                    <div class="">
                     <p class="mb-0 fs-5">57%</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                        <img src="{{ URL::asset('dist/images/county/03.png') }}" width="40" alt="">
                        <div class="">
                           <h5 class="mb-0">$958K</h5>
                           <p class="mb-0">France</p>
                        </div>
                    </div>
                    <div class="progress w-25" style="height: 7px;">
                       <div class="progress-bar" style="width: 48%"></div>
                    </div>
                    <div class="">
                     <p class="mb-0 fs-5">48%</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                        <img src="{{ URL::asset('dist/images/county/04.png') }}" width="40" alt="">
                        <div class="">
                           <h5 class="mb-0">$568K</h5>
                           <p class="mb-0">Brazil</p>
                        </div>
                    </div>
                    <div class="progress w-25" style="height: 7px;">
                       <div class="progress-bar" style="width: 75%"></div>
                    </div>
                    <div class="">
                     <p class="mb-0 fs-5">38%</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                        <img src="{{ URL::asset('dist/images/county/05.png') }}" width="40" alt="">
                        <div class="">
                           <h5 class="mb-0">$855K</h5>
                           <p class="mb-0">United Kingdom</p>
                        </div>
                    </div>
                    <div class="progress w-25" style="height: 7px;">
                       <div class="progress-bar" style="width: 65%"></div>
                    </div>
                    <div class="">
                     <p class="mb-0 fs-5">68%</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                        <img src="{{ URL::asset('dist/images/county/06.png') }}" width="40" alt="">
                        <div class="">
                           <h5 class="mb-0">$983K</h5>
                           <p class="mb-0">United States</p>
                        </div>
                    </div>
                    <div class="progress w-25" style="height: 7px;">
                       <div class="progress-bar" style="width: 88%"></div>
                    </div>
                    <div class="">
                     <p class="mb-0 fs-5">88%</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3 flex-grow-1 flex-shrink-0">
                        <img src="{{ URL::asset('dist/images/county/07.png') }}" width="40" alt="">
                        <div class="">
                           <h5 class="mb-0">$724K</h5>
                           <p class="mb-0">China</p>
                        </div>
                    </div>
                    <div class="progress w-25" style="height: 7px;">
                       <div class="progress-bar" style="width: 80%"></div>
                    </div>
                    <div class="">
                     <p class="mb-0 fs-5">85%</p>
                    </div>
                  </div>
                </div>
             </div>
             <div class="card-footer bg-transparent p-3">
              <div class="d-grid">
               <a href="javascript:;" class="btn btn-outline-primary">View All Sales</a>
              </div>
           </div>
           </div>
        </div>

      </div><!--end row-->
@endsection
@section('scripts')
  <script src="{{ URL::asset('dist/plugins/peity/jquery.peity.min.js') }}"></script>
  <script>
    $(".data-attributes span").peity("donut")
	new PerfectScrollbar(".user-list")
  </script>
@endsection
