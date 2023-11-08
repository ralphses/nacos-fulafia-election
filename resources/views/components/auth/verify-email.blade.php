<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign In Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" style="border: none" class="btn-link btn-primary">
                                Log Out
                            </button>
                        </form>

                    </div>
                    <div class="block-content">
                            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1">NACOS</h1>
                            <p class="fw-medium text-muted">
                                A new verification link has been sent to the email address you provided during registration.
                            </p>

                            <!-- Sign In Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{ route('verification.send') }}" method="POST">

                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-6 col-xl-10">
                                        <button type="submit" class="btn w-100 btn-alt-primary">
                                            Resend Verification Email
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
{{--                        @endif--}}
                    </div>
                </div>
                <!-- END Sign In Block -->
            </div>
        </div>
        <div class="fs-sm text-muted text-center">
            <strong>NACOS Elections 1.0</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>
</div>
