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
    @foreach(config("river.youtube_id.".$river_id) as $y_id)
            <iframe width="300" height="250" src="https://www.youtube.com/embed/{{$y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$y_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    @endforeach
@endif

@endsection
