@extends('layouts.app')
@section('content')
<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

<div class="w-50 m-auto" style="padding-bottom: 18px;">
  <div style="font-size: 18px;">行政の管理ページ</div>

  <div style="font-size: 18px;">登録地:{{config('city.city')[$city]}}</div>
</div>

<div class="tab-area">
  <div class="tab active admintab">
    ヒヤリハット
  </div>
  <div class="tab admintab">
    投稿一覧
  </div>
</div>

<div class="content-area">
  {{-- ヒヤリハットのエリア --}}
  <div class="content show">
    @if (count($posts) > 0)
    <!-- テーブル本体 -->
    @include('table.table')
    @else
      <div>投稿はありません</div>
    @endif
  </div>
  {{-- 投稿一覧のエリア --}}
  <div class="content">
    @if (count($admins) > 0)
    <!-- テーブル本体 -->
    @include('table.adminTable')
    @else
      <div>投稿はありません</div>
    @endif
  </div>
</div>
@endsection
