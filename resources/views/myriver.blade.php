@extends('layouts.app')
@section('content')

<style>
    .liked {
        color: pink;
    }
</style>

<iframe width="600" height="350" src="https://www.youtube.com/embed/{{config('river.river_id')[$river_id]}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{config('river.river_id')[$river_id]}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                        <!-- 本タイトル -->
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
