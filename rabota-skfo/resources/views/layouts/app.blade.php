<!DOCTYPE html>
<html>
<head>
	<title>Кавказ возможностей@yield("title")</title>
<link rel="icon" type="image/x-icon" href="{{asset('res/rabota.png')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/3a96fafdff.js" crossorigin="anonymous"></script>
<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	@yield('head')
</head>
<body style="font-family: myfont" class="noselect cool-bg">

    @include('inc.navbar')

    @if(Request::is("/"))
        @include('inc/welcome')
    @endif

    @if(Request::is("univercities"))
		<div style="z-index: -1; position: fixed; background: url('../res/elbrus.jpg'); background-size: cover;  width: 100%; height: 100vh;">
			<div class="paralax" style="opacity: 0; width: 100%; height: 100%; background-color: #003974;"></div>
		</div>
		<div class="container">
			<!-- Search box -->
			<div class="row" style="margin: 0px;padding: 0px; min-height: 100vh;">
				<div class="col-md-12" style="margin: auto;">
					<div class="row">
						<div class="col-12" style="font-family: myfont_bold; text-align: center;">
						<h2>Университеты</h2></div>
					</div>
				</div>
			</div>
		</div>
    @endif

	<div style="background-color: #fff; padding-top: 30px; padding-bottom: 30px;" id="root" class="cool-bg2">
        <div class="container" style="padding-top: {{Request::is("/") ? '10':'80'}}px">  
            @yield('content')
        </div>
    </div>

	@include('inc.alert')

    @include('inc.footer')

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
<script src="{{asset('js/utils.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
	<script src="{{asset('js/masks.js')}}"></script>
	@yield('js')

</body>
</html>
