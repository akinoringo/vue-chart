@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
</div>
<div class="form-group">
  <label>内容</label>
  <textarea name="content" required class="form-control" rows="16" placeholder="本文">{{ old('content') }}</textarea>
</div>
<div class="md-form">
  <label>目標継続時間</label>
  <input type="text" name="goal_time" class="form-control" required value="{{ old('goal_time') }}">
</div>