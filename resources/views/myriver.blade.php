@extends('layouts.app')
@section('content')

<style>
  .liked {
    color: pink;
  }
</style>

{{-- modal --}}
@include('post')
{{-- modal end--}}

<div class="w-50 m-auto" style="padding-bottom: 18px;">
  <div><span style="font-size: 18px; color: #4D7298;">{{config('river.river')[$river_id]}}</span> 投稿一覧</div>
  <p>投稿数：{{$posts->count()}}</p>
  <a href="https://twitter.com/search?q=%23{{config('river.river')[$river_id]}}&src=typed_query&f=live">ツイッターで{{config('river.river')[$river_id]}}</a>
</div>
@if (count($posts) > 0)
<!-- テーブル本体 -->
@include('table')
@else
<table class="table table-borderless d-flex align-items-center w-100">
  <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
    @include('youtube')
  <tbody>
</table>
@endif

@endsection
