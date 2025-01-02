@extends('layouts.master')

@section('title', 'Media')
@section('css')

@endsection
@section('content')
<x-page-title title="Components" pagetitle="Media" />

        <div class="row">
			<div class="col-12">
				<h6 class="mb-0 text-uppercase">Basic Media Object</h6>
				<hr>
				<div class="card radius-10">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<img src="{{ URL::asset('dist/images/avatars/01.png') }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
							<div class="flex-grow-1 ms-3">
								<h5 class="mt-0">Media heading</h5>
								<p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</p>
							</div>
						</div>
					</div>
				</div>
				<h6 class="mb-0 text-uppercase">Nesting Media Object</h6>
				<hr>
				<div class="card radius-10">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<img src="{{ URL::asset('dist/images/avatars/02.png') }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
							<div class="flex-grow-1 ms-3">
								<h5 class="mt-0">Media heading</h5>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla
								<div class="d-flex align-items-center mt-3">
									<a class="mr-3" href="#">
										<img src="{{ URL::asset('dist/images/avatars/03.png') }}" class=" rounded-circle p-1 border" width="90" height="90" alt="...">
									</a>
									<div class="flex-grow-1 ms-3">
										<h5 class="mt-0">Media heading</h5>
										Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<h6 class="mb-0 text-uppercase">Alignment</h6>
				<hr>
				<div class="card radius-10">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<img src="{{ URL::asset('dist/images/avatars/04.png') }}" class="align-self-start rounded-circle p-1 border" width="90" height="90" alt="...">
							<div class="flex-grow-1 ms-3">
								<h5 class="mt-0">Top-aligned media</h5>
								<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</p>
								<p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
							</div>
						</div>
						<hr>
						<div class="d-flex align-items-center">
							<img src="{{ URL::asset('dist/images/avatars/05.png') }}" class="align-self-center rounded-circle p-1 border" width="90" height="90" alt="...">
							<div class="flex-grow-1 ms-3">
								<h5 class="mt-0">Center-aligned media</h5>
								<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</p>
								<p class="mb-0">Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
							</div>
						</div>
						<hr>
						<div class="d-flex align-items-center">
							<img src="{{ URL::asset('dist/images/avatars/06.png') }}" class="align-self-end rounded-circle p-1 border" width="90" height="90" alt="...">
							<div class="flex-grow-1 ms-3">
								<h5 class="mt-0">Bottom-aligned media</h5>
								<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</p>
								<p class="mb-0">Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
							</div>
						</div>
						<hr>
						<div class="d-flex align-items-center">
							<div class="flex-grow-1 ms-3">
								<h5 class="mt-0 mb-1">Order Change media</h5>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</div>
							<img src="{{ URL::asset('dist/images/avatars/07.png') }}" class="ml-3 rounded-circle p-1 border" width="90" height="90" alt="...">
						</div>
					</div>
				</div>
				<h6 class="mb-0 text-uppercase">Media list</h6>
				<hr>
				<div class="card radius-10">
					<div class="card-body">
						<ul class="list-unstyled">
							<li class="d-flex align-items-center border-bottom pb-2">
								<img src="{{ URL::asset('dist/images/avatars/08.png') }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
								<div class="flex-grow-1 ms-3">
									<h5 class="mt-0 mb-1">List-based media object</h5>
									Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</div>
							</li>
							<li class="d-flex align-items-center my-4 border-bottom pb-2">
								<img src="{{ URL::asset('dist/images/avatars/09.png') }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
								<div class="flex-grow-1 ms-3">
									<h5 class="mt-0 mb-1">List-based media object</h5>
									Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</div>
							</li>
							<li class="d-flex align-items-center">
								<img src="{{ URL::asset('dist/images/avatars/10.png') }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
								<div class="flex-grow-1 ms-3">
									<h5 class="mt-0 mb-1">List-based media object</h5>
									Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

@endsection
