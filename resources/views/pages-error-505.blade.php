@extends('layouts.auth')

@section('title', 'Vertical')
@section('css')
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
     
@endsection 
@section('content')
  
<body class="bg-error">

<!-- Start wrapper-->
 <div class="pt-5">
 
    <div class="container pt-5">
        <div class="row pt-5">
            <div class="col-lg-12">
                <div class="text-center error-pages">
                    <h1 class="error-title text-warning mb-3">505</h1>
                    <h2 class="error-sub-title text-white">505 NOT FOUND</h2>

                    <p class="error-message text-white text-uppercase">SORRY, AN ERROR HAS OCCURED, REQUESTED PAGE NOT FOUND!</p>
                    
                    <div class="mt-4 d-flex align-items-center justify-content-center gap-3">
                      <a href="index" class="btn btn-warning rounded-5 px-4"><i class="bi bi-house-fill me-2"></i>Go To Home</a>
                      <a href="javascript:void();" class="btn btn-light rounded-5 px-4"><i class="bi bi-arrow-left me-2"></i>Previous Page </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-light">Copyright © 2023 | All rights reserved.</p>
                    </div>
                        <hr class="border-light border-2">
                        <div class="list-inline contacts-social mt-4"> 
                        <a href="javascript:;" class="list-inline-item bg-facebook text-white border-0"><i class="bi bi-facebook"></i></a>
                        <a href="javascript:;" class="list-inline-item bg-pinterest text-white border-0"><i class="bi bi-pinterest"></i></a>
                        <a href="javascript:;" class="list-inline-item bg-whatsapp text-white border-0"><i class="bi bi-whatsapp"></i></a>
                        <a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0"><i class="bi bi-linkedin"></i></a>
                      </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
 </div><!--wrapper-->
 @endsection 
