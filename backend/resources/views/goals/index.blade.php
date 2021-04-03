@extends('layouts/app')

@section('title', '一覧')

@section('content')
  @include('layouts/nav')
  <div class="container">
    @foreach($goals as $goal) {{--この行を追加--}} 
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
          <div>
            <div class="font-weight-bold">
              {{ $goal->user->name }} {{--この行を変更--}}
            </div> 
            <div class="font-weight-lighter">
              {{ $goal->created_at->format('Y/m/d H:i') }} {{--この行を変更--}}
            </div>
          </div>
        </div>
        <div class="card-body pt-0 pb-2">
          <h3 class="h4 card-title">
            {{ $goal->title }} {{--この行を変更--}}
          </h3>
          <div class="card-text">
            {!! nl2br(e( $goal->content )) !!} {{--この行を変更--}}
          </div>
        </div>
      </div>
    @endforeach {{--この行を追加--}}
  </div>