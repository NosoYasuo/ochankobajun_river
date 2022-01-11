@extends('layouts.app')
@section('content')

<style>
  .liked {
    color: pink;
  }
  /* tab操作のためのstyle */
  .tab-area {
    display: flex;
    justify-content: space-around;
    background-color: #222e3e;
    cursor: pointer;
  }
  .tab {
  width: 34%;
  height: 30px;
  line-height: 30px;
  text-align: center;
  color: white;
  border-right: 1px solid #50637b;
  border-left: 1px solid #222e3e;
  }
  .tab.active {
  background-color: #81d8d0;
  color: white;
  border: none;
  }
  .content-area {
    text-align: center;
  }

  .content {
      display: none;
  }
  .content.show {
      display: block;
  }
</style>

<div class="w-50 m-auto" style="padding-bottom: 18px;">
  <div><span style="font-size: 18px; color: #4D7298;">{{config('river.river')[$river_id]}}</span> 投稿一覧</div>
  <p>投稿数：{{$posts->count()}}</p>
  <a href="https://twitter.com/search?q=%23{{config('river.river')[$river_id]}}&src=typed_query&f=live">ツイッターで{{config('river.river')[$river_id]}}</a>
</div>

<div class="tab-area">
  <div class="tab active">
    投稿
  </div>
  <div class="tab">
    行政
  </div>
  <div class="tab">
    運営
  </div>
</div>
<div class="content-area">
  {{-- 投稿のエリア --}}
  <div class="content show">
    @if (count($posts) > 0)
    <!-- テーブル本体 -->
    @include('table.table')
    @else
    <table class="table table-borderless d-flex align-items-center w-100">
      <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
        @include('youtube')
      <tbody>
    </table>
    @endif
  </div>
  {{-- 行政のエリア --}}
  <div class="content">
    @if (count($admins) > 0)
    <!-- テーブル本体 -->
    @include('table.adminTable')
    @else
    <table class="table table-borderless d-flex align-items-center w-100">
      <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
        @include('youtube')
      <tbody>
    </table>
    @endif
  </div>
  {{-- 企業のエリア --}}
  <div class="content">
    @if (count($privates) > 0)
    <!-- テーブル本体 -->
    @include('table.privateTable')
    @else
    <table class="table table-borderless d-flex align-items-center w-100">
      <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
        @include('youtube')
      <tbody>
    </table>
    @endif
  </div>
</div>




<script>
  // tab操作のためのJS
$(function() {
  let tabs = $(".tab"); // tabのクラスを全て取得し、変数tabsに配列で定義
  $(".tab").on("click", function() { // tabをクリックしたらイベント発火
    $(".active").removeClass("active"); // activeクラスを消す
    $(this).addClass("active"); // クリックした箇所にactiveクラスを追加
    const index = tabs.index(this); // クリックした箇所がタブの何番目か判定し、定数indexとして定義
    $(".content").removeClass("show").eq(index).addClass("show"); // showクラスを消して、contentクラスのindex番目にshowクラスを追加
  })
})
</script>

@endsection
