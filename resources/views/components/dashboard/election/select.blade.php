<main id="main-container">
    <!-- Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Select Election</h3>
                @if(session('election'))
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <div class="alert alert-secondary alert-dismissible alert-success" role="alert">
                            <p class="mb-0">
                                {{ session()->get('election') }} <a class="alert-link" href="{{ route('dashboard') }}">OK</a>!
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </nav>
                @endif
            </div>
            <div class="block-content">

                <form action="{{ route('elections.result') }}" method="POST">

                    @csrf

                    <div class="row push">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <div class="mb-4">
                                    <label class="form-label" for="election">Select Election</label>
                                    <select class="form-select" id="election" name="election">
                                        <option selected="">select one</option>

                                        @foreach($elections as $election)
                                            <option value="{{ $election->id }}">{{ $election->title }}</option>
                                        @endforeach

                                    </select>
                                    @if($errors->any('election'))
                                        <p style="color: red; font-size: medium">{{ $errors->first('election') }}</p>
                                    @endif
                                </div>

                            </div>

                            <div class="mb-4">
                                <input type="submit" class="btn btn-alt-primary" value="View Results">
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
