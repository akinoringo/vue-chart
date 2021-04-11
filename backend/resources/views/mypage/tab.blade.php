

<ul class="nav nav-pills mb-3 mt-2" id="pills-tab" role="tablist">
  <li class="nav-item text-center">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
      {{$goal0->title}}<br>
      {{$total_time0}}/{{$goal0->goal_time}} [時間]
    </a>
  </li>
  <li class="nav-item text-center">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
      {{$goal1->title}}<br>
      {{$total_time1}}/{{$goal1->goal_time}} [時間]
    </a>
  </li>
  <li class="nav-item text-center">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
      {{$goal2->title}}<br>
      {{$total_time2}}/{{$goal2->goal_time}} [時間]
    </a>
  </li>
</ul>

@include('mypage.search')

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    @foreach($efforts0 as $effort)
    @include('efforts.card')
    @endforeach
    {{ $efforts0->links() }}     
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    @foreach($efforts1 as $effort)
    @include('efforts.card')
    @endforeach
    {{ $efforts1->links() }}    
  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    @foreach($efforts2 as $effort)
    @include('efforts.card')
    @endforeach
    {{ $efforts2->links() }}    
  </div>
</div>

