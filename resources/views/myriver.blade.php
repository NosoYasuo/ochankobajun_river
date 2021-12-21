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
@else
    <table class="table table-borderless d-flex align-items-center w-100">
        <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
            @foreach(config("river.youtube_id.".$river_id) as $y_id)
                @include('youtube')
            @endforeach
        <tbody>
    </table>
@endif

@endsection
