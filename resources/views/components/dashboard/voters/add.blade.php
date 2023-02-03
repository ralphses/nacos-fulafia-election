<main id="main-container">
    <!-- Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Voter</h3>
                @if(session('voters'))
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <div class="alert alert-secondary alert-dismissible alert-success" role="alert">
                            <p class="mb-0">
                                {{ session()->get('voters') }} <a class="alert-link" href="{{ route('dashboard') }}">OK</a>!
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </nav>
                @endif
            </div>
            <div class="block-content">

                <form action="{{ route('voters.store') }}" method="POST">

                    @csrf

                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Voter's information.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-name">Matric Number</label>
                                <input type="text" class="form-control" id="one-profile-edit-name" value="{{ old('voter-matric') }}" name="voter-matric" placeholder="Enter matric number here" >

                                @if($errors->any('voter-matric'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('voter-matric') }}</p>
                                @endif
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
