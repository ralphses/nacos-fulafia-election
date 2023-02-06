<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="content" >
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                @if(session('dashboard'))
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <div class="alert alert-secondary alert-dismissible alert-danger" role="alert">
                            <p class="mb-0">
                                {{ session()->get('dashboard') }} !
                            </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </nav>
                @endif
                <h1 class="h3 fw-bold mb-2">
                    Dashboard
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                    Welcome {{ \Illuminate\Support\Facades\Auth::user()->name }}, everything looks great.
                </h2>
            </div>

            <div class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3">

                     <form action="{{ route('election.status') }}" method="POST">
                         @csrf

                                @if($info['ready'] === \App\Utils\Utility::ELECTION_STATUS['start'])
                                    <input hidden name="action" value="{{ \App\Utils\Utility::ELECTION_STATUS['start'] }}">
                                 <span class="d-inline-block">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        Start Election
                                    </button>
                                 </span>
                                @elseif($info['ready'] === \App\Utils\Utility::ELECTION_STATUS['on'])
                             <input name="action" hidden value="{{ \App\Utils\Utility::ELECTION_STATUS['stop'] }}">

                             <span class="d-inline-block">
                                    <button type="submit" class="btn btn-danger px-4 py-2">
                                        Stop Election
                                    </button>
                                 </span>

                         @else
                             <a href="{{ route('election.add') }}" class="btn btn-success px-4 py-2">
                                 New Election
                             </a>
                                @endif

                     </form>
            </div>

        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Overview -->
        <div class="row items-push">
            <div class="col-sm-6 col-xxl-3">
                <!-- Pending Orders -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0"></dd>
                            <p>Candidates</p>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="far fa-user-circle fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('candidates.all') }}">
                            <span>View all candidates</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Pending Orders -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- New Customers -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Election Results</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="far fa-gem fs-3 text-primary"></i>
                        </div>

                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('elections.result') }}">
                            <span>View results</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END New Customers -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- Messages -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Eligible Voters</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="far fa-paper-plane fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('voters.all') }}">
                            <span>View Voters</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Messages -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- Conversion Rate -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Positions</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-chart-bar fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('positions.all') }}">
                            <span>View all contested posts</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Conversion Rate-->
            </div>
        </div>
        <!-- END Overview -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<script>

    const electionStartBtn = document.getElementById('election-start-btn');

    electionStartBtn.addEventListener('click', () => {

        {{--Swal.fire({--}}

        {{--    title: 'Start Election?',--}}
        {{--    text: 'Start a created election',--}}
        {{--    showLoaderOnConfirm: true,--}}
        {{--    showConfirmButton: false,--}}

        {{--    html: '<a href="{{ route('election.start') }}" class="btn btn-primary px-4 py-2" id="election-start-btn"> Start Election </a>'--}}
        {{--})--}}

    })
</script>
