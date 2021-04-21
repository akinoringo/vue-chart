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

        @if( Auth::id() === $user->id )
        <div class="dropdown text-right">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ▼  
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("mypage.edit", ['id' => $user->id]) }}">
              プロフィールを編集する
            </a>
          </div>
        </div>
        @endif        

        <h5 class="card-title">Name</h5>
        <p class="card-text">{{ $user->name }}</p>
        <h5 class="card-title">About</h5>
        <p class="card-text mb-4">{{$user->introduction}}</p>
        <div class="card-text d-flex">
          <a href="" class="text-muted mt-2">
            10 フォロー
          </a>
          <a href="" class="text-muted mt-2">
            10 フォロワー
          </a>
        @if( Auth::id() !== $user->id )
          <follow-button
            class="ml-4 mr-auto"
          >
          </follow-button>
        @endif           
        </div>

      </div>     
    </div>
  </div>


</div>

