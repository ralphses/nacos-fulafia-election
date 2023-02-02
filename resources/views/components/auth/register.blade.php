<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign Up Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Create Account</h3>
                        <div class="block-options">
                            <a class="btn-block-option fs-sm" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#one-signup-terms">View Terms</a>
                            <a class="btn-block-option" href="{{ route('login') }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Sign In">
                                <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1">NACOS</h1>
                            <p class="fw-medium text-muted">
                                Please fill the following details to create a new account.
                            </p>

                            <!-- Sign Up Form -->
                            <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _js/pages/op_auth_signup.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signup" action="{{ route('register') }}" method="POST">

                                @csrf
                                <div class="py-3">
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg form-control-alt" id="signup-username" name="name" placeholder="Full name">
                                        @if($errors->any('name'))
                                            <p style="color: red; font-size: medium">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <input type="email" class="form-control form-control-lg form-control-alt" id="signup-email" name="email" placeholder="Email">
                                        @if($errors->any('email'))
                                            <p style="color: red; font-size: medium">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password" name="password" placeholder="Password">
                                        @if($errors->any('password'))
                                            <p style="color: red; font-size: medium">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password-confirm" name="password_confirmation" placeholder="Confirm Password">
                                        @if($errors->any('password_confirmation'))
                                            <p style="color: red; font-size: medium">{{ $errors->first('password_confirmation') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn w-100 btn-alt-success">
                                            Sign Up
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign Up Form -->
                        </div>
                    </div>
                </div>
                <!-- END Sign Up Block -->
            </div>
        </div>
        <div class="fs-sm text-muted text-center">
            <strong>NACOS Elections 1.0</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>


</div>
<!-- END Page Content -->
