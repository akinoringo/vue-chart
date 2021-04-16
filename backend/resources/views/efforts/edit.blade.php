@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('layouts.error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('efforts.update', ['effort' => $effort]) }}">
                @method('PATCH')
                @csrf
                <div class="form-group mt-3">
                  <label>タイトル</label>
                  <span class="small ml-2">50字以内</span>  
                  <input type="text" name="title" class="form-control" required value="{{ $effort->title ?? old('title') }}">
                </div>

                <div class="form-group">
                  <label>取組内容</label>
                  <span class="small ml-2">500字以内</span>
                  <textarea name="content" required class="form-control" rows="16" placeholder="本文">{{ $effort->content ?? old('content') }}</textarea>
                </div>
                <div class="form-group">
                  <label>取組時間 [時間]</label>
                  <span class="small ml-2">0以上20以下の整数を入力してください</span>
                  <input type="text" name="effort_time" class="form-control" required value="{{ $effort->effort_time ?? old('effort_time') }}">
                </div>
                <button type="submit" class="btn bg-dark text-white btn-block">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection