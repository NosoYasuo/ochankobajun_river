<tr class="card mx-auto w-100 px-1 py-2" style="border: none; border-bottom: 0.5px solid #81D8D0">
  <td class="table-text mt-1 h4 m-0 p-0 px-2 mt-4" style="color: #48908A;">
    <div class="title">{{ config("river.river.".$river_id)}}</div>
  </td>
  <td class="table-text d-flex justify-content-between m-0 p-0 px-2 pt-1">
    <div class="text-secondary small">
      @運営
    </div>
    <span class="badge rounded-pill text-dark" style="background-color: #81D8D0;">
      {{ config("river.river.".$river_id)}}
    </span>
  </td>
  <td class="table-text mt-1">
    <div class="title">東京都水防チャンネルからの映像になります</div>
  </td>
  <td>
      @foreach(config("river.youtube_id.".$river_id) as $y_id)
          <iframe style="max-width :373px; height: 210px;" src="https://www.youtube.com/embed/{{$y_id}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$y_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      @endforeach
  </td>
</tr>
