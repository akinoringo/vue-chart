@csrf
<div class="form-group mt-4">
  <label>タイトル</label>
  <span class="small ml-2">50字以内</span>
  <input type="text" name="title" class="form-control" required value="{{ $goal->title ?? old('title') }}">
</div>
<div class="form-group">
  <label>内容</label>
  <span class="small ml-2">500字以内</span>
  <textarea name="content" required class="form-control" rows="16" placeholder="本文">{{ $goal->content ?? old('content') }}</textarea>
</div>
<div class="form-group">
  <label>目標継続時間 [時間]</label>
  <span class="small ml-3">10以上の整数を入力してください</span>
  <input type="text" name="goal_time" class="form-control" required value="{{ $goal->goal_time ?? old('goal_time') }}">
</div>