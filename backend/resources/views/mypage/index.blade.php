@extends('layouts/app')

@section('title', '一覧')

@section('content')
  @include('layouts.nav')
  @include('layouts.flash')
  
  <div class="container">
  	@include('mypage.profile')
  	@include('mypage.tab') 
  </div>
@endsection