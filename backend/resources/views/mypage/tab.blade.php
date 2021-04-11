<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{$goal0->title}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{$goal1->title}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{$goal2->title}}</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      @include('goals.card', ['goal' => $goal0])
      @foreach($efforts0 as $effort)
      @include('efforts.card')
      @endforeach
      {{ $efforts0->links() }}    
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      @include('goals.card', ['goal' => $goal1])
      @foreach($efforts1 as $effort)
      @include('efforts.card')
      @endforeach
      {{ $efforts1->links() }}
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    @include('goals.card', ['goal' => $goal2])
    @foreach($efforts2 as $effort)
    @include('efforts.card')
    @endforeach  
    {{ $efforts2->links() }}
  </div>
</div>

