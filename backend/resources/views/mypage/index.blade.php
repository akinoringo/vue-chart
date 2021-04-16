@extends('layouts/app')

@section('content')
  @include('layouts.nav')
  @include('layouts.flash')
  
  <div class="container">
  	@include('mypage.profile')
  	@if(isset($goals[0]))
	  	@include('mypage.label')
	  	@include('mypage.tab')
  	@else
	  	<div class="my-4 text-center">
	  		<div class="mb-2">まずは、目標を作成しよう！！</div>
	      <a class="btn btn-primary btn-lg" href="{{route('goals.create')}}" role="button">目標を作成する</a>  		
	  	</div>
  	@endif
  </div>
@endsection