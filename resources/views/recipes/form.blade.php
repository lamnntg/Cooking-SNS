@csrf
<div class="md-form">
    <label>料理タイトル</label>
    <input type="text" name="title" class="form-control" required value="{{ $recipe->title ?? old('title') }}">
</div>
{{-- <div class="form-group mt-3">
    <label>タグ</label>
    <recipe-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
    </recipe-tags-input>
</div> --}}
<div class="form-group mt-3">
    <label>料理の写真</label>
    <input type="file" name="image" accept="image/png, image/gif, image/jpeg" class="form-control" value="">
</div>
<div class="form-group mt-3">
    <label>レシピの内容</label>
    <textarea name="body" required class="form-control" rows="16"
        placeholder="本文">{{ $recipe->description ?? old('description') }}</textarea>
</div>
