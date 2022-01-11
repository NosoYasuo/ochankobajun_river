@extends('layouts.app')
@section('content')

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
@endsection
