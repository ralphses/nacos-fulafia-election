@extends('layouts.landing')

@section('content')

    @component('components.landing.home', ['ready' => $ready])
    @endcomponent

@endsection
