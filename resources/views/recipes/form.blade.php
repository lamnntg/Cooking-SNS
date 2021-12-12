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
    @if (isset($is_edit))
        @include('recipes.image-upload')
        <p id="messageInp" style="color:red">新しい写真を変更したい場合はアップロードしてください。</p>
    @else
        <input type='button' id='remove' value='remove' class='hide btn btn-danger' />
        <img id="canvas_image" class="text-center" src="#" alt="your image" />
        @include('recipes.image-upload')
    @endif

</div>
<div class="form-group mt-3">
    <label>レシピの内容</label>
    <textarea name="body" required class="form-control" rows="16"
        placeholder="本文">{{ $recipe->description ?? old('description') }}</textarea>
</div>
