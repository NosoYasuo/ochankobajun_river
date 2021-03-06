<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: #4D7298;">投稿</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- 登録フォーム -->
      <form action="{{ url('posts') }}" method="POST" class="form-horizontal" enctype=multipart/form-data>
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="col-sm-6 mb-2">
            <input type="text" name="title" class="form-control mb-1" placeholder="タイトル" value="{{old('title')}}" style="border: none; border-bottom: 0.5px solid #81D8D0; background-color: white;">
            <input type="text" name="message" class="form-control mb-1" placeholder="本文" value="{{old('message')}}" style="height: 100px; border: none; border-bottom: 0.5px solid #81D8D0; background-color: white;">
            {{-- プルダウンで川を選択 --}}
            <div id="select-wrapper" class="mb-1">
              <select name="river_id" id="select2" style="min-width: 300px">
                @foreach(config('river.river') as $index => $name)
                <option value="{{ $index }}" {{ $index === Auth::user()->river_id ? "selected" : ""}}>{{ $name }}</option>
                @endforeach
              </select>

              {{-- 行政、民間、市民で 表示を変える--}}
              @if (Request::is('adminInfo'))
              <input name='type' type="text" value="1" style="display: none">
              @elseif(Request::is('private'))
              <input name='type' type="text" value="2" style="display: none">
              @else
              {{-- ヒヤリハット --}}
              <input type="checkbox" value="1" name="caution">ヒヤリハット投稿
              @endif
            </div>
            {{-- youtubeのIDを入れるinput --}}
            <input type="text" name="y_id" class="form-control" placeholder="youtube ID" value="{{old('y_id')}}">
            {{-- fileを選択するinput --}}
            <input type="file" id="myImage" name="file_name" class="form-control">
            {{-- 画像を表示 --}}
            <div style='width:300px; height:300px;'><img id="preview" style="width:100%; height:100%;"></div>
          </div>
          <!-- 登録ボタン -->
          <div class="modal-footer">
            <button type="submit" class="btn" style="background-color: #4D7298; color: white;">投稿</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Modal end-->
