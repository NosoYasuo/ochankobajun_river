@extends('layouts.app')
@section('content')

@if (count($posts) > 0)
<div class="card-body">
    <div class="card-body">
        <table class="table table-striped task-table">
            <!-- テーブルヘッダ -->
            <thead>
                <th>自分の投稿一覧</th>
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
                            <img src="{{ asset('storage/'.$post->file_name) }}" alt="" style="max-width :200px; height: 100px;">
                        </td>
                        <td class="table-text">
                            <video src="{{ asset('storage/'.$post->file_name) }}" controls muted playsinline style="max-width :300px; height: 150px;"></video>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
まだ投稿がありません
@endif


@endsection
