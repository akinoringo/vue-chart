@extends('layouts.app')

@section('content')
  <div class="container">

    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">
          <span class="font-weight-bold">{{ $tag->hashtag }}</span>
        </h2>
        <div class="card-text text-right">
          {{ $tag->goals->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->goals as $goal)
      @include('goals.card')
    @endforeach

  </div>
@endsection