@extends('layouts.app')

@section('title', 'マイページ編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="text-dark" href="/">Kiseki</a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">マイページ編集</h2>

            @include('layouts.error_card_list')

            <div class="card-text">
              {{--ここから--}}
              <form method="POST" action="{{ route('mypage.update') }}">
                @csrf
                <div class="md-form">
                  <label for="name">ユーザー名</label>
                  <input class="form-control" type="text" id="name" name="name" required value="{{ old('name', $user->name) }}">
                </div>
                <button class="btn btn-block bg-dark mt-2 mb-2 text-white" type="submit">更新する</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection