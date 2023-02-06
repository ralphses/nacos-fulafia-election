@extends('layouts.landing')

@section('content')

    @component('components.vote.vote', ['candidates' => $candidates, 'voterId' => $voterId])
    @endcomponent

@endsection
