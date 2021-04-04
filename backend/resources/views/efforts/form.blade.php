@csrf
<div class="form-group mt-4">
  <label>目標</label>
  <select name="goal_id" class="form-control" required>
  	@foreach($goals as $goal)
  	<option value="{{ $goal->id }}" {{ old('goal_id') == $goal->id ? 'selected' : '' }}>
  		{{$goal->title}}
  	</option>
  	@endforeach
	</select>
</div>

<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $effort->title ?? old('title') }}">
</div>

<div class="form-group">
  <label>取組内容</label>
  <textarea name="content" required class="form-control" rows="16" placeholder="本文">{{ $effort->content ?? old('content') }}</textarea>
</div>
<div class="md-form">
  <label>取組時間</label>
  <input type="text" name="effort_time" class="form-control" required value="{{ $effort->effort_time ?? old('effort_time') }}">
</div>