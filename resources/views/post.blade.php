<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">投稿</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- 登録フォーム -->
      <form action="{{ url('posts') }}" method="POST" class="form-horizontal" enctype= multipart/form-data>
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="col-sm-6">
            <input type="text" name="title" class="form-control" placeholder="タイトル">
            <input type="text" name="message" class="form-control" placeholder="本文">
              <input type="checkbox" value="1" name="caution" >ヒヤリハット投稿
        </div>
        {{-- プルダウンで川を選択 --}}
        <select name="river_id">
            <option> </option>
        @foreach(config('river.river') as $index => $name)
            <option name="river_id" value="{{ $index }}">{{ $name }}</option>
            {{-- <option value="{{ $index }}" {{ old('river_id') === $river_id ? "selected" : ""}}>{{ $name }}</option> --}}
        @endforeach
        </select>

        {{-- youtubeのIDを入れるinput --}}
        {{-- <input type="text" name="y_id" class="form-control" placeholder="youtube ID"> --}}
        {{-- fileを選択するinput --}}
        <input type="file" id="myImage" name="file_name" class="form-control">
        {{-- 画像を表示させようとしてるけど動いていない --}}
        <div style='width:300px; height:300px;'><img id="preview" style="width:100%; height:100%;"></div>
      </div>
      <!-- 登録ボタン -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal end-->
