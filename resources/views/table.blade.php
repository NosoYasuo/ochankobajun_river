<table class="table table-borderless d-flex align-items-center w-100">
  <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
      @foreach ($posts as $post)
        <tr class="card border border-0 mx-auto w-100 px-1">
          <!-- <tr style=" display:flex; flex-direction: column;"> -->
          <!-- タイトル -->
          <td class="table-text mt-4">
            <div class="title">{{ $post->title}}</div>
          </td>
          <td class="table-text d-flex justify-content-between">
            <div class="text-secondary small">
              @ {{ $post->user_name}}
            </div>
            <span class="badge rounded-pill text-dark" style="background-color: #81D8D0;">
              {{ $post->riverName}}
            </span>
          </td>
          <td class="table-text mt-1">
            <div class="title">{{ $post->message}}</div>
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
          {{-- </td>
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
          </td> --}}
          <!--いいね-->
          <td class="border-bottom pb-4 justify-content-center">
          {{-- ログイン時の表示 --}}
          @auth
              @if (!$post->isLikedBy(Auth::user()))
              <span class="likes">
                  <i class="fas fa-heart like-toggle" data-review-id="{{ $post->id }}"></i>
                  <span class="like-counter">{{$post->likes_count}}</span>
              </span>
              @else
              <span class="likes">
                  <i class="fas fa-heart like-toggle liked" data-review-id="{{ $post->id }}"></i>
                  <span class="like-counter">{{$post->likes_count}}</span>
                  </span>
              @endif
          @endauth
          {{-- ログイン時以外のの表示 --}}
          @guest
              <span class="likes">
                  <i class="fas fa-heart heart"></i>
                  <span class="like-counter">{{$post->likes_count}}</span>
              </span>
          @endguest
          </td>
          {{-- コメント表示 --}}
          <td>
              <div>コメント数:{{$post->comments_count}}</div>
              @if ($post->comments)
                  @foreach ($post->comments as $comment)
                  <div>{{$comment->comment}}</div><br>
                  @endforeach
              @endif
              {{-- mypage以外でコメントの投稿ができるようにしています --}}
              @if (!Request::is('mypage'))
              <form action="{{ url('comment') }}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <input id=comment type="text" name=comment placeholder="コメント記入欄">
                  <input type="hidden" id=post_id name=post_id value="{{$post->id}}">
                  <button id=submit type="submit" class="btn btn-primary">Save</button>
              </form>
              @endif
          </td>
        </tr>
      @endforeach
  </tbody>
</table>
