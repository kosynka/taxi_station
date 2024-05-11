@extends('main')

@section('content')
    <h2>Главная страница</h2>

    <h1 class="text">
        Сегодняшняя дата {{ now()->format('d.m.Y') }}
    </h1>
@endsection
