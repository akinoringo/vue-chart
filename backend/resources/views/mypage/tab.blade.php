{{-- @if(isset($goals[0]))
<ul class="nav nav-pills mb-3 mt-2" id="pills-tab" role="tablist">
  <li class="nav-item text-center">
    <a class="nav-link active" id="pills-top-tab" data-toggle="pill" href="#pills-top" role="tab" aria-controls="pills-top" aria-selected="true">
      トップ
    </a> 
  </li>  
  @if(isset($goals[0]))
  <li class="nav-item text-center">
    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
      {{$goals[0]->title}}<br>
    </a>
  </li>
  @endif
  @if (isset($goals[1]))
  <li class="nav-item text-center">
    <a class="nav-link" id="pills-second-tab" data-toggle="pill" href="#pills-second" role="tab" aria-controls="pills-second" aria-selected="false">
      {{$goals[1]->title}}<br>
    </a>
  </li>
  @endif
  @if (isset($goals[2]))  
  <li class="nav-item text-center">
    <a class="nav-link" id="pills-third-tab" data-toggle="pill" href="#pills-third" role="tab" aria-controls="pills-third" aria-selected="false">
      {{$goals[2]->title}}<br>
    </a>
  </li>
  @endif 
</ul>

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-top" role="tabpanel" aria-labelledby="pills-top-tab">
    <effort-chart userid='@json($id)'></effort-chart>
  </div>
  @if(isset($efforts[0]))
  <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    @foreach($efforts[0] as $effort)
    @include('efforts.card')
    @endforeach 
    {{$efforts[0]->appends(request()->query())->links()}}
  </div>
  @endif 
  @if(isset($efforts[1]))
  <div class="tab-pane fade" id="pills-second" role="tabpanel" aria-labelledby="pills-second-tab">
    @foreach($efforts[1] as $effort)
    @include('efforts.card')
    @endforeach
    {{$efforts[1]->appends(request()->query())->links()}}     
  </div>
  @endif 
  @if(isset($efforts[2])) 
  <div class="tab-pane fade" id="pills-third" role="tabpanel" aria-labelledby="pills-third-tab">
    @foreach($efforts[2] as $effort)
    @include('efforts.card')
    @endforeach
    {{$efforts[2]->appends(request()->query())->links()}}  
  </div>
  @endif 
</div>


@endif --}}


<ul class="nav nav-pills mb-3 mt-2" id="pills-tab" role="tablist">
  <li class="nav-item text-center">
    <a class="nav-link active" id="pills-efforts-tab" data-toggle="pill" href="#pills-efforts" role="tab" aria-controls="pills-efforts" aria-selected="true">
      軌跡一覧
    </a>
  </li>   
  <li class="nav-item text-center">
    <a class="nav-link" id="pills-goals-tab" data-toggle="pill" href="#pills-goals" role="tab" aria-controls="pills-goals" aria-selected="true">
      目標一覧
    </a>
  </li>   
  <li class="nav-item text-center">
    <a class="nav-link" id="pills-graph-tab" data-toggle="pill" href="#pills-graph" role="tab" aria-controls="pills-graph" aria-selected="true">
      グラフ
    </a> 
  </li>   
</ul>

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-efforts" role="tabpanel" aria-labelledby="pills-efforts-tab">
    @foreach ($efforts as $effort)
      @include('efforts.card')
    @endforeach
    {{ $efforts->links() }}
  </div>   
  <div class="tab-pane fade" id="pills-goals" role="tabpanel" aria-labelledby="pills-goals-tab">
    @foreach ($goals as $goal)
      @include('goals.card')
    @endforeach    
  </div> 
  <div class="tab-pane fade" id="pills-graph" role="tabpanel" aria-labelledby="pills-graph-tab">
    <effort-chart userid='@json($id)'></effort-chart>
  </div>    
</div>