@extends('layouts.application-guest')

@section('content')

    @component('components.auth.voter.authenticate')
    @endcomponent

@endsection
