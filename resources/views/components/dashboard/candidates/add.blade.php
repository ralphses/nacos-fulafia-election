<main id="main-container">
    <!-- Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Candidate</h3>
                @if(session('candidates'))
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <div class="alert alert-secondary alert-dismissible alert-success" role="alert">
                            <p class="mb-0">
                                {{ session()->get('candidates') }} <a class="alert-link" href="{{ route('dashboard') }}">OK</a>!
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </nav>
                @endif
            </div>
            <div class="block-content">

                <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Candidate's information.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-username">Full Name</label>
                                <input type="text" class="form-control" id="one-profile-edit-username" name="candidate-name" placeholder="Enter candidate's full name">
                                @if($errors->any('candidate-name'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('candidate-name') }}</p>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-name">Matric Number</label>
                                <input type="text" class="form-control" id="one-profile-edit-name" name="candidate-matric" placeholder="Enter matric number here" >
                                @if($errors->any('candidate-matric'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('candidate-matric') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="faculty">Contested Position</label>
                                <select class="form-select" id="faculty" name="candidate-position">
                                    <option selected value=>select post...</option>
                                    @foreach(\App\Utils\Utility::POSITIONS as $position)
                                        <option selected value="{{ $position }}">{{ $position }}</option>
                                    @endforeach
                                </select>

                                @if($errors->any('candidate-position'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('candidate-position') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="faculty">Level</label>
                                <select class="form-select" id="faculty" name="candidate-level">
                                    <option selected value=>select level...</option>

                                    @foreach(\App\Utils\Utility::LEVELS as $key => $level)
                                        <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>

                                @if($errors->any('candidate-level'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('candidate-level') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="faculty">Screened?</label>
                                <select class="form-select" id="faculty" name="candidate-screened">
                                    <option selected value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>

                                @if($errors->any('candidate-screened'))
                                    <p style="color: red; font-size: medium">{{ $errors->first('candidate-screened') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Your Avatar</label>
                                <div class="mb-4">
                                    <img class="img-avatar" src="{{ asset('assets/media/avatars/avatar13.jpg') }}" alt="">
                                </div>
                                <div class="mb-4">
                                    <label for="one-profile-edit-avatar" class="form-label">Candidate Photo</label>
                                    <input class="form-control" type="file" id="one-profile-edit-avatar" name="candidate-photo">
                                    @if($errors->any('candidate-photo'))
                                        <p style="color: red; font-size: medium">{{ $errors->first('candidate-photo') }}</p>
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
