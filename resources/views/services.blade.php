<!-- -->
@extends('layouts.app')

@section('title', 'Services')

@section('content')

    <h1>Este es el Service</h1>

    @component('_components.card')
        @slot('title', 'Service 1')
        @slot('content', 'Lorem ipsum dolor set aimet.')
    @endcomponent

    @component('_components.card')
        @slot('title', 'Service 2')
        @slot('content', 'Lorem ipsum.')
    @endcomponent

@endsection
 