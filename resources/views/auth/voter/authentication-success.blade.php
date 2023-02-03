@extends('layouts.application-guest')

@section('content')

    @component('components.auth.voter.authentication-success', ['voterId' => $voterId])
    @endcomponent

@endsection
