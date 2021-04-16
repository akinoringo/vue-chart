@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="jumbotron py-5">
      <h1 class="display-4">Kisekiとは？</h1>
      <p class="lead">
        目標を達成するために日々の軌跡を継続するお手伝いをします。
    　</p>
      <hr class="my-4">
      <p>使い方はいたってシンプル。</p>
      <ul>
        <li>目標と目標継続時間を登録する</li>
        <li>日々の軌跡と継続を記録する</li>
        <li>目標時間に到達したらクリア！次の目標を登録しよう！</li>
      </ul>
      <p>まずはユーザー登録して目標を登録してみよう!</p>
      <a class="btn btn-primary btn-lg" href="{{route('register')}}" role="button">ユーザー登録</a>
    </div>
</div>
@endsection
