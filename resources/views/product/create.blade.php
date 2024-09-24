@extends('layouts.app')

@section('content')
    @if (auth()->user()->hasRole('admin'))
        @include('product.admin.create')
    @endif
@endsection