<div class="card my-3 py-2">
  <div class="row no-gutters">
    <div class="col-md-4 text-center">
      @if(!empty($user->image))
      <img src="/storage/images/{{$user->image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
      @else
      <img src="/images/dummy-image.jpeg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
      @endif      
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <div class="dropdown text-right">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("mypage.edit", ['user' => Auth::user()]) }}">
              <i class="fas fa-pen mr-1"></i>プロフィールを更新する
            </a>
          </div>
        </div>
        <h5 class="card-title">Name</h5>
        <p class="card-text">{{ $user->name }}</p>
        <h5 class="card-title">Introduction</h5>
        <p class="card-text">自己紹介</p>
      </div>     
    </div>
  </div>


</div>

