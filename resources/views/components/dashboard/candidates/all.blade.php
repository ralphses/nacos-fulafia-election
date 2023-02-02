<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Candidates
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Manage Candidates
                    </h2>
                </div>

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
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">

        <div class="block-options" style="margin-left: 70%; margin-bottom: 5px">
            <a href="{{ route('candidates.add') }}">
                <button type="button" class="btn btn-alt-primary">
                    Add Candidate
                </button>
            </a>
        </div>
        <!-- Full Table -->
        <div class="block block-rounded" style="padding: 1%">


            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">S/N</th>
                            <th style="width: 25%;">Name</th>
                            <th style="width: 15%;">Matric</th>
                            <th style="width: 20%;">Position</th>
                            <th style="width: 10%;">Total votes</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 15%;">Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($candidates as $candidate)
                            <tr>
                                <td class="text-center">
                                    {{ ++$loop->index }}
                                </td>
                                <td class="fw-semibold fs-sm">
                                    {{ $candidate->fullname }}
                                </td>

                                <td class="fw-semibold fs-sm">
                                    {{ $candidate->matric }}
                                </td>

                                <td class="fw-semibold fs-sm">
                                    {{ $candidate->position }}
                                </td>

                                <td class="fw-semibold fs-sm">
                                    {{ $candidate->total_votes }}
                                </td>
                                <td class="fs-sm">
                                    @if($candidate->active)
                                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-black">Qualified</span>
                                    @else
                                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Disqualified</span>
                                    @endif
                                </td>


                                <td class="text-center">
                                    <div class="btn-group">

                                        <a href="{{ route('candidates.view', ['id' => $candidate->id]) }}">
                                            <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="" data-bs-original-title="View">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </button>
                                        </a>

                                        <form action="{{ route('candidate.status', ['id' => $candidate->id]) }}" method="POST">

                                            @method('PATCH')
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="{{ $candidate->active ? "Disqualify" : "Approve" }}" data-bs-original-title="Delete">
                                                @if($candidate->active)
                                                    <i class="fa fa-fw fa-times"></i>
                                                @else
                                                    <i class="fa fa-check"></i>
                                                @endif
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Full Table -->
    </div>
</main>
