
{{-- @push('title')
    Dashboard
@endpush --}}


@extends('layout.sidenav-layout',['title' => 'Dashboard'])
{{-- <x-slot name="title">Server Error</x-slot> --}}




@section('content')
    @include('components.dashboard.summary')
@endsection
