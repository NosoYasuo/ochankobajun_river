@extends('layouts.app')
@section('content')

<h1>ヒヤリハット情報</h1>

  {{-- スクレイピング結果表示 --}}
  <div class="w-50 m-auto" style="padding-bottom: 18px;">
    <div>{{$title}}</div>
    <div>{{$info}}</div>
  </div>


@include('table')

@endsection
