<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign In Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Sign In</h3>
                        <div class="block-options">
                            @if (Route::has('password.request'))
                                <a class="btn-block-option fs-sm" href="{{ route('password.request') }}">Forgot
                                    Password?</a>
                            @endif
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1" style="color: #198906">NACOS Elections</h1>

                            <!-- Sign In Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                <div class="py-3">

                                    @csrf

                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-alt form-control-lg"
                                            id="login-username" name="email" placeholder="Email address">
                                        @if ($errors->any('email'))
                                            <p style="color: red; font-size: medium">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-alt form-control-lg"
                                            id="login-password" name="password" placeholder="Password">
                                        @if ($errors->any('password'))
                                            <p style="color: red; font-size: medium">{{ $errors->first('password') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="login-remember" name="remember">
                                            <label class="form-check-label" for="login-remember">Remember Me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn w-100 btn-alt-success text-white"
                                            style="background-color: #198906">
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                </div>
                <!-- END Sign In Block -->
            </div>
        </div>
        <div class="fs-sm text-muted text-center">
            <strong>NACOS | FULafia</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>
</div>
