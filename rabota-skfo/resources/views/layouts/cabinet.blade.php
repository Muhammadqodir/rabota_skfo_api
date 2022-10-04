<!DOCTYPE html>
<html>
<head>
	<title>Кавказ возможностей@yield("title")</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/3a96fafdff.js" crossorigin="anonymous"></script>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
	@yield('head')
</head>
<body style="font-family: myfont" class="cool-bg2" class="noselect">

    @include('inc.navbar')

	<div class="container" style="padding-top: 90px">
		<h5 style="font-weight: bold;">@yield('sub_title')</h5>
			@if(Auth::user()->role == "student")
				@include('inc.st_menu')
			@endif
			@if(Auth::user()->role == "organization")
				@include('inc.org_menu')
			@endif
			@if(Auth::user()->role == "university")
				@include('inc.univer_menu')
			@endif
			@if(Auth::user()->role == "moderator")
				@include('inc.mod_menu')
			@endif
	</div>

    @yield('content')
	{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script><script src="{{asset('js/utils.js')}}"></script>
	<script src="{{asset('js/masks.js')}}"></script>
	<script src="{{asset('js/cabinet.js')}}"></script>
	@yield('js')

	@include('inc.alert')
    @include('inc.footer')
</body>
</html>
