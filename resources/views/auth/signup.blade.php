@extends('base.base_auth')
@section('title')
    Register
@endsection

@section('content')
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ route('signup') }}">
                Time IN & OUT System
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">Time IN & Time OUT System</h1>
                            <p class="text-lead text-white">is a web app that monitor the time of an employee at work.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>Register</h5>
                            </div>
                            <div class="card-body">
                                <form role="form text-left" method="POST" action="{{ route('signup') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            aria-label="Name" name="name" id="name" aria-describedby="email-addon" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email"
                                            aria-label="Email" name="email" id="email" aria-describedby="email-addon" required>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control" name="id_code" id="id_code" required>
                                            @foreach ($registers as $register)
                                                <option value="{{ $register->id_code }}">{{ $register->id_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control" name="role_id" id="role_id" required>
                                            <option>Select Position:</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password"
                                            aria-label="Password" aria-describedby="password-addon">
                                    </div> --}}
                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault" required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree to the <a href="javascript:;"
                                                class="text-dark font-weight-bolder">Terms and Conditions</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                            up</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}"
                                            class="text-dark font-weight-bolder">Sign in</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection