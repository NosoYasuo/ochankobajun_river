<tbody>
    @foreach ($posts as $post)
        <tr>
            <!-- 本タイトル -->
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
            {{-- 画像や動画の表示 --}}
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
            {{-- コメント表示 --}}
            <td class="table-text">
                @if ($post->comments)
                <div>コメント数:{{$post->comments_count}}</div>
                    @foreach ($post->comments as $comment)
                    <div>{{$comment->comment}}</div><br>
                    @endforeach
                @endif
                <form action="{{ url('comment') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <input id=comment type="text" name=comment placeholder="コメント記入欄">
                    <input type="hidden" id=post_id name=post_id value="{{$post->id}}">
                    <button id=submit type="submit" class="btn btn-primary">Save</button>
                </form>
            </td>
            <!--いいね-->
            <td>
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
        </tr>
    @endforeach
</tbody>
