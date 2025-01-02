@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <body class="bg-login">

        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                    <div class="card rounded-4">
                        <div class="card-body p-5">
                            <div class="mb-4 text-center">
                                <img src="{{ URL::asset('dist/images/logo-text.png') }}" width="300" alt="">
                            </div>

                            <h4 class="fw-bold">Ingresar</h4>
                            <p class="mb-0">Ingresa tus credenciales.</p>

                            <div class="form-body my-4">
                                <form class="row g-3" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Correo</label>
                                        <input type="email" class="form-control" name="email" id="inputEmailAddress"
                                            placeholder="Enter Email">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Contraseña</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0"
                                                id="inputChoosePassword" name="password" placeholder="Enter Password">

                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Recuerdame</label>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 text-end"> <a href="{{ route('password.request') }}">Forgot
                                            Password
                                            ?</a>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        {{-- <div class="text-start">
                                            <p class="mb-0">Don't have an account yet? <a
                                                    href="{{ route('register') }}">Sign
                                                    up here</a>
                                            </p>
                                        </div> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>

    @endsection
