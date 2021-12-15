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
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td class="table-text">
                            <div>{{ $post->title}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $post->message}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $post->user_name}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $post->riverName}}</div>
                        </td>
                        <td class="table-text">
                        @switch($post->file_ext)
                            @case(1)
                                <img src="{{ asset('storage/'.$post->file_name) }}" alt="" style="max-width :200px; height: 100px;">
                                @break
                            @case(2)
                                <video src="{{ asset('storage/'.$post->file_name) }}" controls muted playsinline style="max-width :373px; height: 210px;"></video>
                                @break
                            @case(3)
                                <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$post->y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$post->y_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @break
                            @default
                        @endswitch
                        </td>
                        <td>
                        <!--いいね-->
                            @if (!$post->isLikedBy(Auth::user()))
                            <span class="likes">
                                <i class="fas fa-heart like-toggle" data-review-id="{{ $post->id }}"></i>
                                <span class="like-counter">{{$post->likes_count}}</span>
                            </span><!-- /.likes -->
                            @else
                            <span class="likes">
                                <i class="fas fa-heart like-toggle liked" data-review-id="{{ $post->id }}"></i>
                                <span class="like-counter">{{$post->likes_count}}</span>
                                </span><!-- /.likes -->
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
