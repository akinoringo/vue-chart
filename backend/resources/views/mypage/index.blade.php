@extends('layouts/app')

@section('content')
  @include('layouts.nav')
  @include('layouts.flash')
  
  <div class="container">
  	@include('mypage.profile')
  	@include('mypage.label')
  	@include('mypage.tab') 
  </div>
@endsection