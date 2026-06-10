@extends('layouts.app')
@section('jsonld')
@include('partials.jsonld-breadcrumbs')
@include('partials.jsonld-service')
@endsection
@section('content')
{!! evo()->runSnippet('PageBuilder', ['container' => 'default']) !!}
@endsection
