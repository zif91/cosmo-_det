@extends('layouts.app')
@section('content')
{!! evo()->runSnippet('PageBuilder', ['container' => 'default']) !!}
@endsection
