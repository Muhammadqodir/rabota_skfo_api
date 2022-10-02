@if($errors->any())
<div class="alert alert-danger formControl" style="margin-top: 5px;">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class='card card-shadow' style="margin-top: 20px;">
    <div class="card-body">
        <h5 class="card-title">Персональные данные</h5>
        <form action="{{route('org.updateProfile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input hidden value="{{$user->id}}" name="user_id">
            <div class="row" style="margin-top: 20px">
                <div class="col-12 col-sm-3" style="padding-right: 0px; padding-left: 0px">
                    <div style="width: 100%">
                        <input type="file" accept="image/png,image/jpeg" hidden name="userPic" id="userPic">
                        <img style="width: 100%; object-fit: cover;" class="circle" id="previewUserPic" src="{{$user->isUserHasPic() ? asset($user->pic) : asset('res/icons/company.svg')}}">
                        <div class="editPic" onclick="selectFile()">
                            <img src="{{asset('res/icons/edit.svg')}}" style="width: 100%;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-9">
                    <div class="formControl" style="margin-top: 0px; max-width: none;">
                        @php($types = [
                            "ООО",
                            "ПАО",
                            "АО",
                            "УП",
                            "Нек. орг.",
                            "Фонд",
                            "Гос. корп.",
                            "ИП",
                            "АОА",
                            "ЗОА",
                            "ТОО",
                            "Другое",
                            ])
                        <label for="orgForm" class="less-padding">Форма и название организации <span class="necessarly">*</span></label>
                            <div class="row">
                                <div class="col-3">
                                    <select id="orgForm" name="orgForm">
                                        @foreach($types as $type)
                                            <option {{$user->getDetails()->form == $type ? 'selected':''}}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-9" style="padding-left: 0px;">
                                    <input type="" placeholder="Введите название организации" value="{{$user->getDetails()->name}}" id="orgName" name="orgName">
                                </div>
                            </div>

                        <label class="less-padding" for="region">Регион
                            <span class="necessarly">*</span>
                        </label>
                        <select placeholder="Выбетите ваш регион" onchange="fillUniversities()" id="region" name="region">

                            @foreach (App\Models\Region::all() as $item)
                            <option value="{{$item->id}}" {{$user->region_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                            @endforeach

                        </select>

						<label class="less-padding" for="orgSphere">Сфера деятельности<span class="necessarly">*</span></label>
						<select id="orgSphere" name="orgSphere">
							@foreach(App\Models\Sphere::all() as $item)
							<option value="{{$item->id}}" {{$user->getDetails()->sphere == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
							@endforeach
						</select>

                        <div class="less-padding" style="padding-right: 0px;">
                            <label for="description">Описание организации <span class="necessarly">*</span></label>
                            <textarea type="" placeholder="Опишите вашу компанию подробнее"  id="description" name="description">{{$user->getDetails()->description}}</textarea>
                        </div>

                        <div class="less-padding" style="padding-right: 0px;">
                            <label for="website">Веб-сайт </label>
                            <input type="" placeholder="www.example.com" value="{{$user->getDetails()->web_site}}" id="website" name="website">
                        </div>

                        <div class="less-padding" style="padding-left: 0px;">
                            <label for="fullName">Имя контактного лица<span class="necessarly">*</span></label>
                            <input type="" id="fullName" name="fullName" value="{{$user->name}}" placeholder="Ф.И.О.">
                        </div>

                        <div class="less-padding" style="padding-right: 0px;">
                            <label for="phoneNumber">Номер контактного лица <span class="necessarly">*</span></label>
                            <input type="" placeholder="+7__________" value="{{$user->phone}}"  maxlength="12" id="phoneNumber" name="phoneNumber">
                        </div>

                        <label class="less-padding" for="email">eMail <span class="necessarly">*</span></label>
                        <input type="email" disabled placeholder="example@example.com" value="{{$user->email}}" id="email" name="email">
                    </div>
                    <div class="formControl" style="margin-top: 30px; margin-left: auto; margin-right: 0px; width: 100px;">
                        <button onclick="">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>