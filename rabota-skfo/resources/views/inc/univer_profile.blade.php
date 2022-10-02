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
        @if($user == Auth::user())
            <form action="{{route('univer.updateProfile')}}" method="POST" enctype="multipart/form-data">
        @else
            @if(Auth::user()->role == "moderator")
                <form action="{{route('moderator.updateUniverProfile')}}" method="POST" enctype="multipart/form-data">
            @endif
        @endif
            @csrf
            <input hidden value="{{$user->id}}" name="user_id">
            <div class="row" style="margin-top: 20px">
                <div class="col-12 col-sm-3" style="padding-right: 0px; padding-left: 0px">
                    <div style="width: 100%">
                        <input type="file" accept="image/png,image/jpeg" hidden name="userPic" id="userPic">
                        <img style="width: 100%; object-fit: cover;" class="circle" id="previewUserPic" src="{{$user->isUserHasPic() ? asset($user->pic) : asset('res/icons/no-photo.jpeg')}}">
                        <div class="editPic" onclick="selectFile()">
                            <img src="{{asset('res/icons/edit.svg')}}" style="width: 100%;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-9">
                    <div class="formControl" style="margin-top: 0px; max-width: none;">
                        <label class="less-padding" for="fullName">Название ВУЗа <span class="necessarly">*</span></label>
                        <input type="" value="{{$user->name}}" placeholder="Ф.И.О" id="fullName" name="fullName">

                        <label class="less-padding" for="region">Регион
                            <span class="necessarly">*</span>
                        </label>
                        <select placeholder="Выбетите ваш регион" onchange="fillUniversities()" id="region" name="region">

                            @foreach (App\Models\Region::all() as $item)
                            <option value="{{$item->id}}" {{$user->region_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                            @endforeach

                        </select>

                        <label class="less-padding" for="shortName">Аббревиатура <span class="necessarly">*</span></label>
                        <input type="" value="{{$user->getDetails()->shortName}}" placeholder="Аббревиатура" id="shortName" name="shortName">

                        <label class="less-padding one_line_text" for="phoneNum">Номер телефона</label>
                        <input type="" value="{{$user->phone}}" placeholder="Номер телефона" name="phoneNumber" maxlength="12" id="phoneNum">

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