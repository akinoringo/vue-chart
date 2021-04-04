@extends('layouts.app')

@section('title', '軌跡詳細')

@section('content')
  @include('layouts.nav')
  <div class="container">
    @include('efforts.card')
  </div>
@endsection