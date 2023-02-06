<main id="main-container">
    <!-- Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">New Election</h3>
                @if(session('elections'))
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <div class="alert alert-secondary alert-dismissible alert-success" role="alert">
                            <p class="mb-0">
                                {{ session()->get('elections') }} <a class="alert-link" href="{{ route('dashboard') }}">OK</a>!
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </nav>
                @endif
            </div>
            <div class="block-content">

                <form action="{{ route('election.store') }}" method="POST">

                    @csrf

                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                New Election's information.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="election-title">Election title</label>
                                <input type="text" class="form-control" value="{{ old('election-title') }}" id="election-title" name="election-title" placeholder="e.g 2021/2022 Elections">
                                @if($errors->any('election-title'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('election-title') }}</p>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="election-date">Date</label>
                                <input type="date" class="form-control" value="{{ old('election-date') }}" id="election-date" name="election-date" placeholder="Election date" >
                                @if($errors->any('election-date'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('election-date') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="election-duration">Duration</label>
                                <input type="number" class="form-control" value="{{ old('election-duration') }}" id="election-duration" name="election-duration" placeholder="Duration in minutes (e.g 45)" >
                                @if($errors->any('election-duration'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('election-duration') }}</p>
                                @endif
                            </div>
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
