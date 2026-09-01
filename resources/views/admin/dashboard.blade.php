@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="fs-5">Bienvenido al sistema : {{ Auth::user()->name }} {{ Auth::user()->email }}</h1>
@endsection