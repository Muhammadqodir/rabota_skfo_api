<!DOCTYPE html>
<html>
<head>
	<title>Кавказ возможностей</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/3a96fafdff.js" crossorigin="anonymous"></script>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>
<body style="font-family: myfont" class="noselect">

	<div class="header">
		<div style="background: #F8F9FA;">
			<div class="container">
			<div class="row no-gutters">
				<div class="col-6 col-sm-4">
					<a href="{{route('main')}}" style="text-decoration: none;"><div class="backButton"><i class="fas fa-chevron-left"></i> Назад</div></a>
				</div>
				<div class="col-4 destroy-in-mobile" style="text-align: center; padding: 10px;">
					<img src="{{asset('res/rabota1.png')}}" height="40">
				</div>
				<div class="col-6 col-sm-4">
					@yield('nav_btn')
				</div>
			</div>
			</div>
		</div>
		<div style="background: linear-gradient(0deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.7875525210084033) 44%, rgba(255,255,255,1) 82%); height: 50px;"></div>
	</div>

    @yield('content')

	@include('inc.alert')
	@include('inc.footer')

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="{{asset('js/utils.js')}}"></script>
	<script src="{{asset('js/masks.js')}}"></script>
    @yield('js')
</body>
</html>
