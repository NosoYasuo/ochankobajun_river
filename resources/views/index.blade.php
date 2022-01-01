@extends('layouts.app')
@section('content')
        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->

        
        {{-- スクレイピング結果表示 --}}
        <div class="w-50 m-auto" style="padding-bottom: 18px;">
          <div>{{$title}}</div>
          <div>{{$info}}</div>
        </div>

        {{-- modal --}}
        @include('post')
        {{-- modal end--}}

    {{-- 一覧表示 --}}
    @if (count($posts) > 0)
            <!-- テーブル本体 -->
            @include('table')
    @endif
@endsection
