<!-- Hero -->
<div class="bg-image" style="background-image: url('{{ asset('assets/media/nacos/feature.jpg') }}');">
    <div class="bg-primary-dark-op py-9 overflow-hidden">
        <div class="content content-full text-center">
            <h1 class="display-4 fw-semibold text-white mb-2">
                NACOS FULafia ELECTIONS
            </h1>

            @if($ready === \App\Utils\Utility::ELECTION_STATUS['on'])

            <div>
                <a class="btn text-white px-3 py-2 m-1" style="background-color: #198906;" href="{{ route('voters.vote.start') }}">
                    Vote Now!
                </a>
            </div>
            @elseif($ready === \App\Utils\Utility::ELECTION_STATUS['start'])
            <div>
                <a class="btn text-white px-3 py-2 m-1" style="background-color: #198906;" href="{{ route('voters.authenticate') }}">
                    Get Voter Identification Number (VIN)
                </a>
            </div>
            @else
                <div>
                       <p style="font-size: xxx-large" class="text-white"> Elections Commencing Soon!</p>
                </div>
            @endif
        </div>

    </div>
</div>
<!-- END Hero -->
