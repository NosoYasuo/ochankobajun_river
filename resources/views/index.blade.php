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
        <a href="{{ url('mypage')}}">マイページ</a>

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
                <input type="text" id="myImage" name="y_id" class="form-control" placeholder="youtube ID">
                <input type="file" id="myImage" name="file_name" class="form-control">
                {{-- 画像を表示 --}}
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
        <!-- Modal end-->

    </div>

    {{-- 一覧表示 --}}

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
                                @switch($post->file_ext)
                                    @case(1)
                                        <img src="{{ asset('storage/'.$post->file_name) }}" alt="" style="max-width :200px; height: 100px;">
                                        @break
                                    @case(2)
                                        <video src="{{ asset('storage/'.$post->file_name) }}" controls muted playsinline style="max-width :373px; height: 210px;"></video>
                                        @break
                                    @case(3)
                                        <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$post->y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$post->y_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        @break
                                    @default
                                @endswitch
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
