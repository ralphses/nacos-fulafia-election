<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">AUthenticated Voter</h3>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1">NACOS 2023</h1>
                            <p class="fw-medium text-muted">
                               Kindly and securely store the Voter Identification Number below:
                            </p>

                                <div class="row mb-4">
                                    <div class="col-md-6 col-xl-10">
                                        <div class="btn w-100 btn-alt-primary">
                                            <h3>{{ $voterId }}</h3>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="block-header block-header-default">
                        <div class="block-options">
                            <a class="btn-block-option" href="{{ route('voters.vote', ['voterId' => $voterId]) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Vote Now">
                                Vote Now <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fs-sm text-muted text-center">
            <strong>NACOS Elections 1.0</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>
</div>
