@extends('layouts.master')

@section('title', 'practice')

@section('content')
@foreach ($values as $value)
{{$value}}
@endforeach

@stop