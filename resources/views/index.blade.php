@extends('layouts.app')
@section('content')
<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

{{-- スクレイピング結果表示 --}}
<div class="m-auto d-flex" style="padding-bottom: 18px;">
<div>水位周知河川<div>{{$suii}}</div></div>
<div>洪水予報<div>{{$kouzui}}</div></div>

</div>

    {{-- 一覧表示 --}}
    @if (count($posts) > 0)
            <!-- テーブル本体 -->
            @include('table.table')
    @endif

@endsection
