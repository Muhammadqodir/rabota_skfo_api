@extends("./layouts/blank")

@section('content')
<div class="container" style="margin-bottom: 100px;">
	<form action="{{route('user.regPost')}}" method="POST">
		<div class="form">

			@csrf
			<div style="font-size: 30px; max-width: 500px; margin: auto;">Регистрация</div>

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
				<label for="fullName">Ф.И.О.
					<span class="necessarly">*</span>
				</label>
				<input type="" placeholder="Иванов Иван Иванович" value="{{old('fullName')}}" id="name" name="fullName">
			</div>
			<div class="formControl">
				<label for="region">Регион
					<span class="necessarly">*</span>
				</label>
				<select placeholder="Выбетите ваш регион" onchange="fillUniversities()" id="region" name="region">
					@foreach (App\Models\Region::all() as $item)
					<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="formControl">
				<label for="univer">Образовательное учреждение
					<span class="necessarly">*</span>
				</label>
				<select placeholder="Выбетите ваше образовательное учреждение" id="univer" name="univer">
				
				</select>
			</div>
			<div class="formControl">
					<label for="sex">Пол <span class="necessarly">*</span></label>
					<select id="sex" name="sex">
						<option value="m">Мужской</option>
						<option value="f">Женский</option>
					</select>
			</div>
			<div class="row formControl">
				<div class="col-6" style="padding-left: 0px;">
					<label for="burnDate">Дата рождения <span class="necessarly">*</span></label>
					<input type="" id="burnDate" name="burnDate" value="{{old('burnDate')}}" placeholder="дд.мм.гггг" maxlength="10">
				</div>
				<div class="col-6" style="padding-right: 0px;">
					<label for="phoneNum">Номер телефона <span class="necessarly">*</span></label>
					<input type="" placeholder="+7__________" value="{{old('phoneNumber')}}" name="phoneNumber" maxlength="12" id="phoneNum">
				</div>
			</div>
			<div class="formControl">
				<label for="email">Email <span class="necessarly">*</span></label>
				<input type="" placeholder="example@example.com" value="{{old('email')}}" id="email" name="email">
			</div>
			<div class="formControl">
				<label for="password">Пароль <span class="necessarly">*</span></label>
				<input type="password" placeholder="12345678 :)" value="{{old('password')}}" id="password" name="password">
			</div>
			<div class="formControl" style="margin-top: 30px;">
				<div class="form-group form-check" style="margin-bottom: 0px;">
					<input type="checkbox" style="width: 20px;" class="form-check-input" name="rememberMe" id="allowPersonalData">
					<label class="form-check-label" style="margin-top: 12px; margin-left: 12px;" for="allowPersonalData">Соглашаюсь на <a target="_blank" href="../privacy/index.html">обработку персональных данных</a></label>
				</div>
				<button style="margin-top: 15px;" onclick="">Зарегистрироватся</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('js')
<script type="text/javascript">
	var requestUrl = '{{route('api.getUniverByRegion')}}';
	var selUniverId = 0;
	dateInputMask(document.getElementById('burnDate'));
	phoneInputMask(document.getElementById('phoneNum'));
</script>
<script src="{{asset('js/profile.js')}}"></script>
<script type="text/javascript">
	fillUniversities();
</script>
@endsection

@section('nav_btn')
<a href="{{route('user.login')}}" style="text-decoration: none;">
	<div class="backButton" style="text-align: right;">
		<i class="fas fa-sign-in-alt"></i> Войти
	</div>
</a>
@endsection
