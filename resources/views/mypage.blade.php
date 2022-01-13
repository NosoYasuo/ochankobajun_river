@extends('layouts.app')
@section('content')

<div class="container" style="padding: 0;">
  <div class="px-4">
    <div>こんにちは <span style="font-size: 18px;">{{Auth::user()->name}}</span> さん
    <div class = pt-1>市区町村:{{ Auth::user()->CityName}}</div>
    </div>
    <div>
      <p class="m-0 pt-3">マイリバー</p>
      <button type="button" class="btn text-dark w-100 mb-4" style="background-color: #81D8D0; font-size: 24px;">
        {{ Auth::user()->riverName}}
      </button>
    </div>



    <!-- テーブルヘッダ -->
    <!-- <p class="m-0 pt-4">自分の投稿一覧</p> -->
  </div>
  @if (count($posts) > 0)
    @include('table.table')
  @else
  まだ投稿がありません
  @endif


  @endsection
</div>
