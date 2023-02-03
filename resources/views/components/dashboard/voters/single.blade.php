<!-- Labels on top -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Voter's Information</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="row">
            <div class="col-lg-4">
                <p class="fs-sm text-muted">
                </p>
            </div>
            <div class="col-lg-8 space-y-5">
                <!-- Form Labels on top - Default Style -->
                <form action="#" method="POST" onsubmit="return false;">
                    <div class="mb-4">
                        <label class="form-label" for="example-ltf-email">Matriculation Number</label>
                        <h5>{{ $voter->matric }}</h5>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="example-ltf-email">Voter's ID</label>
                        <h5>{{ $voter->voter_id ?? "------------" }}</h5>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="example-ltf-email">Full Name</label>
                        <h5>{{ $voter->name ?? "------------" }}</h5>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="example-ltf-email">Email</label>
                        <h5>{{ $voter->email ?? "------------" }}</h5>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="example-ltf-email">Voted?</label>
                        <h5>{{ $voter->voted === 1 ? "Yes" : "No"  }}</h5>
                    </div>

                </form>
                <!-- END Form Labels on top - Default Style -->
            </div>
        </div>
    </div>
</div>
<!-- END Labels on top -->
