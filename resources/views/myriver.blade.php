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


<div>{{config('river.river')[$river_id]}}投稿一覧</div>
<h2>投稿数：{{$posts->count()}}</h2>
@if (count($posts) > 0)
    <!-- テーブル本体 -->
    @include('table')
@endif

@endsection
