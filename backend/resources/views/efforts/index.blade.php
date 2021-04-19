@extends('layouts/app')

@section('content')
  @include('layouts.flash')
  
  <div class="container">
  	@include('efforts.search')
    @foreach($efforts as $effort) 
      @include('efforts.card')
    @endforeach
    {{ $efforts->links()}}
  </div>
@endsection