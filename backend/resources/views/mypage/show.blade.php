@extends('layouts/app')

@section('content')
  
  <div class="container">
  	@include('mypage.profile')
  	@include('mypage.label')
  	@include('mypage.tab')  	
  	@if(!isset($goals[0]))
	  	<div class="my-4 text-center">
	  		<div class="mb-2">目標を作成しよう！！</div>
	      <a class="btn btn-primary btn-lg" href="{{route('goals.create')}}" role="button">目標を作成する</a>  		
	  	</div>
  	@endif
  </div>
@endsection