@extends('frontend.layouts.master')

    <!-- Start Main Top -->

    <!-- End Main Top -->

    <!-- Start Top Search -->

    <!-- End Top Search -->

    <!-- Start All Title Box -->

    <!-- End All Title Box -->
@section('content')
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to Login</a></h5>
                    <form method="POST" action="{{route('user.login')}}" class="mt-3 collapse review-form-box" id="formLogin">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
                    <form class="mt-3 collapse review-form-box" method="POST" action="{{route('user.register')}}" id="formRegister">
                        @csrf
                        <div class="form-row">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            @endif
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">Full Name</label>
                                <input type="text" name="fullname"  class="form-control" id="InputName" placeholder="Full Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Username</label>
                                <input type="text" name="username" class="form-control" id="InputLastname" placeholder="User Name"> </div>
                            <div class="form-group col-md-12">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" name="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword1" class="mb-0">Password</label>
                                <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                            <div class="form-group col-md-6">
                                <label for="confirmedPassword" class="mb-0">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="confirmedPassword" placeholder="Comfirm Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!-- End Cart -->


    <!-- Start Footer  -->
@endsection
