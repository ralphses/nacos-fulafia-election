<main id="main-container">
    <!-- Hero -->
    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Upload Candidates</h3>
                @if (session('candidates'))
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <div class="alert alert-secondary alert-dismissible alert-success" role="alert">
                            <p class="mb-0">
                                {{ session()->get('candidates') }} <a class="alert-link"
                                    href="{{ route('dashboard') }}">OK</a>!
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </nav>
                @endif
            </div>
            <div class="block-content">

                <form action="{{ route('candidates.add.all') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Candidates list.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <div class="mb-4">
                                    <label for="one-profile-edit-avatar" class="form-label">Candidate Photo</label>
                                    <input class="form-control" type="file" id="one-profile-edit-avatar"
                                        name="candidate-list">
                                    @if ($errors->any('candidate-list'))
                                        <p style="color: red; font-size: medium">
                                            {{ $errors->first('candidate-list') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4">
                                <input type="submit" class="btn btn-alt-primary" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->


    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
