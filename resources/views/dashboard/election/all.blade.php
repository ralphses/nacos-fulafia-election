@extends('layouts.application')

@section('content')

    @component('components.dashboard.partials.nav-bar')
    @endcomponent

    @component('components.dashboard.election.all', ['elections' => $elections])
    @endcomponent

    @component('components.dashboard.partials.footer')
    @endcomponent

@endsection
