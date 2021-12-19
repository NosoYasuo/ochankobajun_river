<table class="table table-borderless d-flex align-items-center w-100">
  <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
    @foreach ($posts as $post)
    <tr class="card border border-0 mx-auto w-100 px-1">
      <!-- <tr style=" display:flex; flex-direction: column;"> -->
      <!-- タイトル -->
      <td class="table-text mt-1 h4 m-0 p-0 px-2 mt-4" style="color: #48908A;">
        <div class="title">{{ $post->title}}</div>
      </td>
      <td class="table-text d-flex justify-content-between m-0 p-0 px-2 pt-1">
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
        <img src="{{ asset('storage/'.$post->file_name) }}" alt="" style="width: 100%; height: 280px; object-fit: cover;" class="img-responsive center-block">
        @break
        @case(2)
        <video src="{{ asset('storage/'.$post->file_name) }}" controls muted playsinline style="max-width :373px; height: 210px;"></video>
        @break
        @case(3)
        <iframe width="100%" height="240" src="https://www.youtube.com/embed/{{$post->y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$post->y_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
      <td class="justify-content-center">
        <div class="d-flex justify-content-between">

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


          {{-- コメント表示 --}}
          <div class="d-flex" id={{$post->id}}>
            <div>コメント</div>
            <div>{{$post->comments_count}} 件</div>
          </div>
          <div></div>
        </div>
        <div id="commentArea" class="px-4 mt-4">
          @if ($post->comments)
          @foreach ($post->comments as $comment)
          <div class="small p-2" style="border-bottom: 0.5px solid #a8eae4;">{{$comment->comment}}</div><br>
          @endforeach
          @endif
          {{-- mypage以外でコメントの投稿ができるようにしています --}}
          <div class="input-group mb-3 m-auto">
            @if (!Request::is('mypage'))
            <form id="commentForm" action="{{ url('comment') }}" method="POST" class="form-horizontal">
              {{ csrf_field() }}
              <input id=comment type="text" name=comment class="form-control">
              <input type="hidden" id=post_id name=post_id value="{{$post->id}}">
            </form>
            <div class="input-group-prepend">
              <button id=submit type="submit" class="input-group-text">コメントする</button>
            </div>
            @endif
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<script>
  // let posts = @json($posts);
  // console.log(posts);
  // let postId = posts.map(post => post.id)
  // console.log(postId);
  // postId.forEach((id) => {
  //   console.log(id);
  //   document.getElementById(id).addEventListener('click', () => {
  //     //style="display: none"
  //     document.getElementById("commentArea").style.display = 'block';
  //     document.getElementById("commentForm").style.display = 'block';

      // alert(id)

      // $('commentArea').show();
      // $('commentForm').show();
  //   })

  // })
</script>
