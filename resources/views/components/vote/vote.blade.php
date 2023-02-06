<!-- Page Content -->
<div class="content text-center">
    <form action="{{ route('voters.vote.store') }}" method="POST">

        @csrf
        <input value="{{ $voterId }}" name="voter" hidden>


    @foreach($candidates as $post => $candidate)

                <div class="card card-borderless push ">
                    <div class="card-header">
                        <h3 class="block-title">
                            {{ $post }}
                        </h3>
                    </div>
                    <div class="card-body">

                        @if(count($candidate) < 1)
                            <h1 class=" text-center fw-bold" style="font-size: 70%;">No Candidate for post of {{ $post }}</h1>
                        @endif
                            <div class="row justify-content-center">
                            @foreach($candidate as $cand)
                                    <div class="col-md-3" style="margin-right: 0;">
                                        <div class="form-check form-block text-center">
                                            <input class="form-check-input" type="radio" value="{{ $cand->id }}" id="{{ $cand->id }}" name="{{ $post }}">
                                            <label class="form-check-label justify-content-center" for="{{ $cand->id }}">
                                                <img class="card-img-top img-avatar48" src="{{asset($cand->image_path)}}" alt="">
                                                <span class="d-flex align-items-center">
                                                  <span class="ms-2">
                                                    <span class="fw-bold">{{ $cand->fullname }}</span>
                                                    <span class="d-block fs-sm text-muted">{{ $cand->level }}</span>
                                                  </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                </div>
        @endforeach

        <input class="btn btn-success" style="width: 60%" type="submit">

    </form>

</div>

<!-- END Timeouts -->
