<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  {{-- fontawsome --}}
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <!-- Select2.css
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
  Select2本体 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
  <!-- Select2日本語化 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/ja.js"></script>
  <!-- Styles -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">

</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #81d8d0;">
      <div class=" container">

        @auth
        <div class="d-flex">

          <!-- モーダルを表示させるボタン-->
          <button type="button" class="input_button m-auto border-0 rounded-pill text-secondary px-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            投稿 <i class="fas fa-plus-circle"></i>
          </button>
          {{-- 各川へ検索して飛べる --}}
          <form action="{{ url('change') }}" method="GET" class="form-horizontal px-2">
            <div class="d-flex">

              <select class=" river_id" name="river_id" id="select4" style="min-width: 150px">
                @foreach(config('river.river') as $index => $name)
                <option value="{{ $index }}" {{ $index === Auth::user()->river_id ? "selected" : ""}}>{{ $name }}</option>
                @endforeach
              </select>
              <button id=submit type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>
        @endif

        {{-- ハンバーガーメニュー --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">

            <!-- </ul> -->
            <a class="navbar-brand" href="{{ url('/') }}">
              {{ config('app.name', 'Laravel') }}
            </a>

            <!-- Right Side Of Navbar -->
            <!-- <ul class="navbar-nav ms-auto"> -->
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <h6 id="navbarDropdown" class="dropdown-item" style="color: #212529" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'">{{ Auth::user()->name }} さん</h6>

              <div class="d-flex">
                <a href="{{ url('myriver/'.Auth::user()->river_id) }}" class="dropdown-item" style="color: #212529" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'"><svg xmlns="http://www.w3.org/2000/svg" class="mb-2" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                  </svg> マイリバー</a>
                <a href="{{ url('mypage')}}" class="dropdown-item" style="color: #212529" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'"><svg xmlns="http://www.w3.org/2000/svg" class="mb-2" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg> マイページ</a>
                <a class="dropdown-item" style="color: #212529" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                  <svg xmlns="http://www.w3.org/2000/svg" class="mb-2" width=" 18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                  </svg>
                  {{ __('ログアウト') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>

              <div class="dropdown-divider"></div>


              <a href="https://twitter.com/tokyo_suibo" class="dropdown-item" style="color: #ffffff" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'"><i class="fab fa-twitter"></i> 東京都水防公式ツイッター</a>
              <a href="https://www.kasen-suibo.metro.tokyo.lg.jp/im/uryosuii/tsim0102g.html" class="dropdown-item" style="color: #ffffff" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'"><svg xmlns="http://www.w3.org/2000/svg" class="mb-1" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                </svg> 降雨・河川水位情報</a>
              <div class="d-flex">
                <a href="https://www.kensetsu.metro.tokyo.lg.jp/jigyo/road/information/tukou/pass.html" class="dropdown-item" style="color: #ffffff" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'"><svg xmlns="http://www.w3.org/2000/svg" class="mb-1" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg> 道路通行止め情報</a>
                <a href="https://map.bosai.metro.tokyo.lg.jp/?l=35-0%2C38-0%2C51-0%2C53-0%2C59-0%2C60-0%2C61-0%2C1015-0&ll=35.69187929999999%2C139.389038&z=10" class="dropdown-item" style="color: #ffffff" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#81d8d0'"><svg xmlns="http://www.w3.org/2000/svg" class="mb-1" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                  </svg> 東京都防災マップ</a>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>
  {{-- JS --}}
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script src="{{ asset('js/index.js') }}"></script>
  <script src="{{ asset('js/like.js') }}"></script>
  <script>
    $(document).ready(function() {
      $("#select2").select2({
        dropdownParent: $("#select-wrapper"),
        dropdownAutoWidth: true,
        width: 'auto'
      });
    });
    $(document).ready(function() {
      $("#select3").select2();
    });
    $(document).ready(function() {
      $("#select4").select2();
    });
  </script>
</body>

</html>
