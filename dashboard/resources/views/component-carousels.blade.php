@extends('layouts.master')

@section('title', 'Carousels')
@section('css')

@endsection
@section('content')
<x-page-title title="Components" pagetitle="Carousels" />

        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
			<div class="col">
				<h6 class="mb-0 text-uppercase">Slides only</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="{{ URL::asset('build/images/carousels/01.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/02.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/03.png') }}" class="d-block w-100" alt="...">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<h6 class="mb-0 text-uppercase">With controls</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="{{ URL::asset('build/images/carousels/04.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/05.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/06.png') }}" class="d-block w-100" alt="...">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<h6 class="mb-0 text-uppercase">With controls</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
							<ol class="carousel-indicators">
								<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
								<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
								<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="{{ URL::asset('build/images/carousels/07.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/08.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/09.png') }}" class="d-block w-100" alt="...">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<h6 class="mb-0 text-uppercase">With captions</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
							<ol class="carousel-indicators">
								<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
								<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
								<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="{{ URL::asset('build/images/carousels/10.png') }}" class="d-block w-100" alt="...">
									<div class="carousel-caption d-none d-md-block">
										<h5>First slide label</h5>
										<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/11.png') }}" class="d-block w-100" alt="...">
									<div class="carousel-caption d-none d-md-block">
										<h5>Second slide label</h5>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/12.png') }}" class="d-block w-100" alt="...">
									<div class="carousel-caption d-none d-md-block">
										<h5>Third slide label</h5>
										<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
									</div>
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<h6 class="mb-0 text-uppercase">With Crossfade</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="{{ URL::asset('build/images/carousels/13.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/14.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/15.png') }}" class="d-block w-100" alt="...">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<h6 class="mb-0 text-uppercase">Individual Interval</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active" data-bs-interval="10000">
									<img src="{{ URL::asset('build/images/carousels/16.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item" data-bs-interval="2000">
									<img src="{{ URL::asset('build/images/carousels/17.png') }}" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="{{ URL::asset('build/images/carousels/18.png') }}" class="d-block w-100" alt="...">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->
		<h6 class="mb-0 text-uppercase">Dark Variant</h6>
		<hr>
		<div class="card">
			<div class="card-body">
				<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
					<ol class="carousel-indicators">
						<li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
						<li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
						<li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active" data-bs-interval="10000">
							<img src="{{ URL::asset('build/images/carousels/19.png') }}" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5>First slide label</h5>
								<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
							</div>
						</div>
						<div class="carousel-item" data-bs-interval="2000">
							<img src="{{ URL::asset('build/images/carousels/20.png') }}" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5>Second slide label</h5>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							</div>
						</div>
						<div class="carousel-item">
							<img src="{{ URL::asset('build/images/carousels/21.png') }}" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5>Third slide label</h5>
								<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</a>
				</div>
			</div>
		</div>

@endsection
