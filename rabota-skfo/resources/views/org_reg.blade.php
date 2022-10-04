@extends("./layouts/blank")

@section('content')
<div class="container" style="margin-bottom: 100px;">
	<form action="{{route('user.regOrgPost')}}" method="POST">
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
				<label for="orgForm">Форма и название организации <span class="necessarly">*</span></label>
				<div class="row">
					<div class="col-3">
						<select id="orgForm" name="orgForm">
							<option>ООО</option>
							<option>ПАО</option>
							<option>АО</option>
							<option>УП</option>
							<option>Нек. орг.</option>
							<option>Фонд</option>
							<option>Гос. корп.</option>
							<option>ИП</option>
							<option>АОА</option>
							<option>ЗОА</option>
							<option>ТОО</option>
							<option>Другое</option>
						</select>
					</div>
					<div class="col-9" style="padding-left: 0px;">
						<input type="" placeholder="Введите название организации" id="orgName" name="orgName">
					</div>
				</div>
			</div>

			<div class="formControl">
				<label for="region">Регион
					<span class="necessarly">*</span>
				</label>
				<select placeholder="Выбетите ваш регион" id="region" name="region">
					@foreach (App\Models\Region::all() as $item)
					<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
			</div>

            <div class="row formControl">
				<div class="col-12" style="padding-left: 0px;">
						<label for="orgSphere">Сфера деятельности<span class="necessarly">*</span></label>
						<select id="orgSphere" name="orgSphere">
							@foreach(App\Models\Sphere::all() as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
				</div>
			</div>

			<div class="row formControl">
				<div class="col-6" style="padding-left: 0px;">
						<label for="fullName">Имя контактного лица<span class="necessarly">*</span></label>
						<input type="" id="fullName" name="fullName" placeholder="Ф.И.О.">
				</div>
				<div class="col-6" style="padding-right: 0px;">
					<label for="phoneNumber">Номер контактного лица <span class="necessarly">*</span></label>
					<input type="" placeholder="+79682659013" maxlength="12" id="phoneNumber" name="phoneNumber">
				</div>
			</div>


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