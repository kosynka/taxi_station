@extends('main')

@section('content')
    <h2>Главная страница</h2>

    <h1 class="text">
        {{ now()->format('d.m.Y H:i') }}
    </h1>
@endsection
