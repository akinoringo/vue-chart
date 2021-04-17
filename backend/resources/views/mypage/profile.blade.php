<div class="card my-3 py-4 border-light border-top-0 border-right-0 border-left-0 rounded-0" >
  <div class="row no-gutters">
    <div class="col-md-4 text-center">
      @if(!empty($user->image))
      <img src="/storage/images/{{$user->image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
      @else
      <img src="/images/prof.png" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
      @endif      
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <div class="dropdown text-right">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ▼  
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("mypage.edit", ['user' => Auth::user()]) }}">
              プロフィールを編集する
            </a>
          </div>
        </div>
        <h5 class="card-title">Name</h5>
        <p class="card-text">{{ $user->name }}</p>
        <h5 class="card-title">About</h5>
        <p class="card-text">{{$user->introduction}}</p>
      </div>     
    </div>
  </div>


</div>

