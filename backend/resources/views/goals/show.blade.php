@extends('layouts.app')

@section('title', '目標詳細')

@section('content')
  @include('layouts.nav')
  <div class="container">
    @include('goals.card')
  </div>
@endsection