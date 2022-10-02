@extends("./layouts/blank")

@section('content')
<div class="container" style="margin-bottom: 100px;">
	<form action="{{route('user.loginPost')}}" method="POST">
		<div class="form">
			@csrf
			<div style="font-size: 30px; max-width: 500px; margin: auto;">Вход</div>

			@if($errors->any())
			<div class="alert alert-danger formControl" style="margin-top: 5px;">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			<div class="formControl">
				<label for="email">Email <span class="necessarly">*</span></label>
				<input type="" placeholder="example@example.com" id="email" name="email">
			</div>
			<div class="formControl">
				<label for="password">Пароль <span class="necessarly">*</span></label>
				<input type="password" placeholder="12345678 :)" id="password" name="password">
			</div>
			<div class="formControl" style="margin-top: 30px;">
				<div class="form-group form-check" style="margin-bottom: 0px;">
					<input type="checkbox" style="width: 20px;" class="form-check-input" id="allowPersonalData">
					<label class="form-check-label" style="margin-top: 12px; margin-left: 12px;" for="allowPersonalData">Запомнить меня</label>
				</div>
				<button style="margin-top: 15px;" onclick="">Войти</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('nav_btn')
<a href="{{route('user.reg')}}" style="text-decoration: none;">
	<div class="backButton" style="text-align: right;">
		<i class="fas fa-user-plus"></i> Регистрация
	</div>
</a>
@endsection