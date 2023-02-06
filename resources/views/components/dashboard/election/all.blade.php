<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Election Management
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Manage Elections
                    </h2>
                </div>

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
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">

        <div class="block-options" style="margin-left: 70%; margin-bottom: 5px">
            <a href="{{ route('election.add') }}">
                <button type="button" class="btn btn-alt-primary">
                    New Election
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
                            <th style="width: 20%;">Title</th>
                            <th style="width: 15%;">Date</th>
                            <th style="width: 15%;">Start Time</th>
                            <th style="width: 15%;">Stop Time</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($elections as $election)
                            <tr>
                                <td class="text-center">
                                    {{ ++$loop->index }}
                                </td>
                                <td class="fw-semibold fs-sm">
                                    {{ $election->title }}
                                </td>

                                <td class="fw-semibold fs-sm">
                                    {{ $election->date }}
                                </td>

                                <td class="fw-semibold fs-sm">
                                    {{ $election->start_time }}
                                </td>

                                <td class="fw-semibold fs-sm">
                                    {{ $election->stop_time }}
                                </td>

                                <td class="fw-semibold fs-sm">
                                    {{ $election->status }}
                                </td>

                                <td class="text-center">
                                    <div class="btn-group">

                                        <form action="{{ route('election.remove', ['id' => $election->id]) }}" method="POST">

                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Delete">
                                                    <i class="fa fa-fw fa-times"></i>
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
