@extends('layouts.app')
@section('content')

<style>
    .liked {
        color: pink;
    }
</style>

{{-- {{$id = "river.river_id.".$river_id}}
{{dd($id)}} --}}

@foreach(config("river.youtube_id.".$river_id) as $y_id)
    <iframe width="300" height="250" src="https://www.youtube.com/embed/{{$y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$y_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@endforeach

<h2>投稿数：{{$posts->count()}}</h2>
@if (count($posts) > 0)
<div class="card-body">
    <div class="card-body">
        <table class="table table-striped task-table">
            <!-- テーブルヘッダ -->
            <thead>
                <th>{{config('river.river')[$river_id]}}投稿一覧</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            @include('post')
        </table>
    </div>
</div>
@endif

@endsection
