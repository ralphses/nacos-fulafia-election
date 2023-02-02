@extends('layouts.application')

@section('content')

    @component('components.dashboard.partials.nav-bar')
    @endcomponent

    @component('components.dashboard.dashboard')
    @endcomponent

    @component('components.dashboard.partials.footer')
    @endcomponent

@endsection
