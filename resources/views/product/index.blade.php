@extends('layouts.app')

@section('content')
    @if (auth()->user()->hasRole('admin'))
        @include('product.admin.index')
    @else
        @include('product.client.index')
    @endif
@endsection
