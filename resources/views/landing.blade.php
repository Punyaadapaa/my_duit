@extends('layouts.app')

@section('title', 'MyDuit - Duit Lo, Atur Sendiri.')
@section('description', 'Gak usah pusing mikirin cashflow. MyDuit bikin tracking pengeluaran & nabung jadi segampang scroll FYP.')

@section('content')
    @include('partials.header')

    <main style="padding-top: 80px; padding-bottom: 2rem; display: flex; flex-direction: column; gap: 6rem;">
        @include('partials.hero')
        @include('partials.trust')
        @include('partials.features')
        @include('partials.cta')
    </main>

    @include('partials.footer')
@endsection
