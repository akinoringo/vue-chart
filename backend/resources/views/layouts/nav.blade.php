<nav class="navbar navbar-expand navbar-dark bg-dark">

  @guest
  <a class="navbar-brand" href="/"><i class="far fa-bookmark"></i> Kiseki</a>
  @endguest
  @auth
  <a class="navbar-brand" href="{{route('mypage.index')}}"><i class="far fa-bookmark"></i> Kiseki</a>
  @endauth

  <ul class="navbar-nav ml-auto">
    @guest {{--この行を追加--}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a> {{--この行を変更--}}
    </li>
    @endguest {{--この行を追加--}}

    @guest {{--この行を追加--}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest {{--この行を追加--}}

    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{route('goals.create')}}">目標作成</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{route('efforts.create')}}">軌跡作成</a>
    </li>
    @endauth
{{--     <li class="nav-item">
      <a class="nav-link" href="">ユーザー登録</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="">ログイン</a>
    </li>   --}}  

{{--     <li class="nav-item">
      <a class="nav-link" href=""><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li> --}}
    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{route('mypage.index')}}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>  
    <form id="logout-button" method="POST" action="{{route('logout')}}">
      @csrf
    </form>
    <!-- Dropdown -->
    @endauth

  </ul>

</nav>