<table class="table table-borderless d-flex align-items-center w-100">
  <tbody class="card-body w-100" style="display:flex; flex-direction: column; padding: 0;">
    @foreach ($admins as $post)
    <tr class="card mx-auto w-100 px-1 py-2" style="border: none; border-bottom: 0.5px solid #81D8D0">
      <!-- <tr style=" display:flex; flex-direction: column;"> -->
      <!-- タイトル -->
      <td class="table-text mt-1 h4 m-0 p-0 px-2 mt-4" style="color: #48908A;">
        <div class="title">{{ $post->title}}</div>
        {{-- 削除ボタン --}}
        @if(Request::is('mypage'))
          <form  action="{{ url('delete/'.$post->id) }}" method="GET" class="form-horizontal px-4">
            {{ csrf_field() }}
            <button type="submit">削除</button>
          </form>
        @endif
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
        <video src="{{ asset('storage/'.$post->file_name) }}" controls muted playsinline style="max-width :100%; height: 210px;"></video>
        @break
        @case(3)
        <iframe max-width="100%" height="240" src="https://www.youtube.com/embed/{{$post->y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$post->y_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @break;
        @default
        @endswitch
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
          <div class="d-flex" id=a{{$post->id}}>
            <div><i class="far fa-comment-alt"></i> コメント</div>
            <div>{{$post->comments_count}} 件</div>
          </div>
        </div>
        <div id="a_commentArea{{$post->id}}" style="display: none" class="px-4 mt-4">

          @if ($post->comments)
          @foreach ($post->comments as $comment)
          <div class="small p-2" style="border-bottom: 0.5px solid #a8eae4;">{{$comment->comment}}</div><br>

          @endforeach
          @endif
        </div>
        {{-- mypage以外でコメントの投稿ができるようにしています --}}
        @if (!Request::is('mypage'))
        <form id="a_commentForm{{$post->id}}" style="display: none" action="{{ url('comment') }}" method="POST" class="form-horizontal px-4">
          <div class="input-group mb-3 m-auto">
            {{ csrf_field() }}
            <input id=comment type="text" name=comment class="form-control m-0">
            <input type="hidden" id=post_id name=post_id value="{{$post->id}}">
            <div class="input-group-prepend">
              <button id=submit type="submit" class="input-group-text"><i class="fas fa-angle-double-up"></i></button>
            </div>
        </form>
        @endif
      </td>
    </tr>
    @if(Request::is('myriver/*'))
      @if (count ($admins) < 3)
        @if (count ($admins)==1)
            @include('youtube')
        @else
            @if ($loop->iteration == 2)
              @include('youtube')
            @endif
        @endif
      @else
        @if($loop->iteration === 3)
              @include('youtube')
        @endif
      @endif
    @endif
    @endforeach
  </tbody>
</table>
<script>
  let admins = @json($admins);
  let adminId = admins.map(admin => admin.id)
  console.log(adminId);
  adminId.forEach((id) => {
    document.getElementById("a"+id).addEventListener('click', () => {

      document.getElementById("a_commentArea" + id).style.display = 'block';
      document.getElementById("a_commentForm" + id).style.display = 'block';
    })

  })
</script>
