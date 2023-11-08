<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign Up Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1" style="color: #198906">NACOS Elections</h1>
                            <p class="fw-medium text-muted">
                                Please carefully enter <strong>Matriculation Number.</strong>
                            </p>


                            <form class="js-validation-signup" action="{{ route('voters.verify') }}" method="POST">

                                @csrf

                                <div class="py-3">
                                    <div class="mb-4">
                                        <input type="text" value="{{ $matric_number ?? old('matric_number') }}"
                                            class="form-control form-control-lg form-control-alt" id="signup-username"
                                            name="matric_number" placeholder="Matriculation Number">

                                        @if ($errors->any('matric_number'))
                                            <p style="color: red; font-size: medium">
                                                {{ $errors->first('matric_number') }}</p>
                                        @endif
                                    </div>


                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn w-100 btn-alt-success text-white"
                                            style="background-color: #198906">
                                            Verify
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
