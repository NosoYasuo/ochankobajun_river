@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">

        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          投稿してみる
        </button>


        <a href="{{ url('myriver/'.Auth::user()->river_id) }}">自分の登録した川へ</a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">投稿</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- 本登録フォーム -->
              <form action="{{ url('posts') }}" method="POST" class="form-horizontal" enctype= multipart/form-data>
                {{ csrf_field() }}
              <div class="modal-body">
                <!-- 本のタイトル -->
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" name="message" class="form-control">
                    </div>
                </div>
                {{-- ラジオボタンで川を選択 --}}
                @foreach (config('river') as $index => $name)
                <input type="radio" name="river_id" value="{{$index}}">{{$name}}
                @endforeach
                <input type="file" id="myImage" name="file_name" class="form-control">
               <div style='width:300px; height:300px;'><img id="preview" style="width:100%; height:100%;"></div>
              </div>
              <!-- 本 登録ボタン -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!-- Book: 既に登録されてる本のリスト -->

        @if (count($posts) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>投稿一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <!-- 本タイトル -->
                                <td class="table-text">
                                    <div>{{ $post->message}}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->user_name}}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->riverName}}</div>
                                </td>
                                <td class="table-text">
                                    <img src="{{ asset('storage/'.$post->file_name) }}" alt="" style="max-width :200px; height: 100px;">
                                </td>
                                <td class="table-text">
                                    <video src="{{ asset('storage/'.$post->file_name) }}" controls muted playsinline style="max-width :300px; height: 150px;"></video>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
<script src="{{ asset('js/index.js') }}"></script>
    @endif
@endsection
