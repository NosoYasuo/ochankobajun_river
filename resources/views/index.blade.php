@extends('layouts.app')
@section('content')
<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

{{-- スクレイピング結果表示 --}}
<div class="d-flex justify-content-around" style="padding-bottom: 18px;">
  <div>洪水予報<br /><small>{{$kouzui}}</small></div>
  <div>水位周知河川<br /><small>{{$suii}}</small></div>

</div>

{{-- 一覧表示 --}}
@if (count($posts) > 0)
<!-- テーブル本体 -->
@include('table.table')
@endif

@endsection
