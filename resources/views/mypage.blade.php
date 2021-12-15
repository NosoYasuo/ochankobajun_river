@extends('layouts.app')
@section('content')

<div class="container" style="padding: 0;">
  <div class="px-4">
    <div>こんにちは <span style="font-size: 18px;">{{Auth::user()->name}}</span> さん
    </div>
    <div>
      <p class="m-0 pt-4">マイリバー</p>
      <button type="button" class="btn text-dark w-100 mb-4" style="background-color: #81D8D0; font-size: 24px;">
        {{config('river.river')[Auth::user()->river_id]}}
      </button>
    </div>

    @if (count($posts) > 0)

    <!-- テーブルヘッダ -->
    <!-- <p class="m-0 pt-4">自分の投稿一覧</p> -->
  </div>

  <table class="table table-borderless d-flex align-items-center w-100">
    <!-- テーブル本体 -->
    <tbody class="card-body w-100" style="display:flex; flex-direction: column-reverse; padding: 0;">
      @foreach ($posts as $post)
      <tr class="card border border-0 mx-auto w-100 px-1">
        <!-- <tr style=" display:flex; flex-direction: column;"> -->
        <!-- 本タイトル -->
        <td class="table-text mt-4">
          <div class="title">{{ $post->message}}</div>
        </td>
        <td class="table-text d-flex justify-content-between">
          <div class="text-secondary small">
            @ {{ $post->user_name}}
          </div>
          <span class="badge rounded-pill text-dark" style="background-color: #81D8D0;">
            {{config('river.river')[$post->river_id]}}
          </span>
        </td>
        <td class="bd-placeholder-img card-img-top border border-0">
          <!-- <td class="table-text"> -->
          @switch($post->file_ext)
          @case(1)
          <img src="{{ asset('storage/'.$post->file_name) }}" alt=""
            style="width: 100%; height: 280px; object-fit: cover;" class="img-responsive center-block">
          @break
          @case(2)
          <video src="{{ asset('storage/'.$post->file_name) }}" controls muted playsinline
            style="max-width :373px; height: 210px;"></video>
          @break
          @case(3)
          <iframe width="100%" height="240"
            src="https://www.youtube.com/embed/{{$post->y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$post->y_id}}"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
          @break;
          @default
          @endswitch
        </td>
        <td class="border-bottom pb-4 justify-content-center">
          <span class="likes">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" style="color: #E96A6A;"
              viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                clip-rule="evenodd" />
            </svg>
            <!-- <i class="fas fa-heart heart"></i> -->
            <span class="like-counter" style="vertical-align: sub;">{{$post->likes_count}}</span>
          </span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
  まだ投稿がありません
  @endif


  @endsection
</div>
