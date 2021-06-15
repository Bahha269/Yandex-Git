<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Блог')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container">
			<header class="blog-header py-3">
				<div class="row flex-nowrap justify-content-between align-items-center">
					<div class="col-4 pt-1 d-none d-md-flex"></div>
					<div class="col-4 text-center">
						<a class="blog-header-logo text-dark" href="{{route('home')}}">Блог</a>
					</div>
					<div class="col-8 col-md-4 d-flex justify-content-end align-items-center">
						<form action="{{route('home')}}" class="d-inline-block mr-3">
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm" name="q" placeholder="Поиск..." @if(isset($q)) value="{{$q}}" @endif>
								<div class="input-group-append">
									<div class="input-group-text px-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"></circle><path d="M21 21l-5.2-5.2"></path></svg>
									</div>
								</div>
							</div>
						</form>
						@guest
						<a class="btn btn-sm btn-outline-secondary" href="{{route('login')}}">Вход</a>
						@else
						<form action="{{route('logout')}}" method="post">
							@csrf
							<button class="btn btn-outline-secondary btn-sm btn-block">Выход</button>
						</form>
						@endguest
					</div>
				</div>
			</header>
  
			<main role="main" class="mt-5">
				<div class="row">
					<div class="col-md-8 blog-main">
						@if(session()->has('message'))
							<div class="alert alert-info">{{session('message')}}</div>
						@endif
						@yield('content')
					</div><!-- /.blog-main -->

					<aside class="col-md-4 blog-sidebar">
						@if(auth()->check() && auth()->user()->admin)
						<div class="px-4 mb-3">
							<a href="{{route('posts.create')}}" class="btn btn-sm btn-block btn-outline-secondary mb-3">Добавить запись</a>
							<hr>
							<a href="{{route('profile.edit')}}" class="btn btn-sm btn-block btn-outline-secondary mb-3">Сменить пароль</a>
						</div>
						@endif
						<div class="px-4 mb-3">
							
						</div>
						<div class="px-4">
							<h4 class="font-italic">Соц сети</h4>
							<ol class="list-unstyled">
							<li><a href="#">GitHub</a></li>
							<li><a href="#">Twitter</a></li>
							<li><a href="#">Facebook</a></li>
							</ol>
						</div>
					</aside><!-- /.blog-sidebar -->

				</div><!-- /.row -->

			</main>
			<footer class="blog-footer mt-5">
				<p><a class="text-secondary" href="#">В начало</a></p>
			</footer>
		</div>
	</div>
</body>
</html>
