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
            <form action="{{route('student.updateProfile')}}" method="POST" enctype="multipart/form-data">
        @else
            @if(Auth::user()->role == "university")
            <form action="{{route('univer.updateStudentProfile')}}" method="POST" enctype="multipart/form-data">
            @elseif(Auth::user()->role == "moderator")
            <form action="{{route('moderator.updateStudentProfile')}}" method="POST" enctype="multipart/form-data">
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
                        <label class="less-padding" for="fullName">Ф.И.О <span class="necessarly">*</span></label>
                        <input type="" value="{{$user->name}}" placeholder="Ф.И.О" id="fullName" name="fullName">

                        <label class="less-padding" for="region">Регион
                            <span class="necessarly">*</span>
                        </label>
                        <select placeholder="Выбетите ваш регион" onchange="fillUniversities()" id="region" name="region">

                            @foreach (App\Models\Region::all() as $item)
                            <option value="{{$item->id}}" {{$user->region_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                            @endforeach

                        </select>


                        <label class="less-padding one_line_text" for="univer">Образовательное учреждение
                            <span class="necessarly">*</span>
                        </label>
                        <div class="">
                            <select placeholder="Выбетите ваше образовательное учреждение" id="univer" name="univer">
                                <option value="-1" style="max-width: 100%;">Выбетите ваше образовательное учреждение</option>
                            </select>
                        </div>

                        <label class="less-padding one_line_text" for="speciality">Специальность</label>
                        <input type="" id="speciality" value="{{$user->getDetails()->speciality}}" name="speciality" placeholder="Специальность">

                        <label class="less-padding one_line_text" for="burnDate">Дата рождения <span class="necessarly">*</span></label>
                        <input type="" id="burnDate" value="{{$user->getDetails()->bday}}" name="burnDate" placeholder="06.08.2001" maxlength="10">

                        <label class="less-padding" for="sex">Пол <span class="necessarly">*</span></label>
                        <select id="sex" name="sex">
                            <option value="m" {{$user->getDetails()->sex == 'm' ? 'selected':''}}>Мужской</option>
                            <option value="f" {{$user->getDetails()->sex == 'f' ? 'selected':''}}>Женский</option>
                        </select>
                        <label class="less-padding one_line_text" for="phoneNum">Номер телефона <span class="necessarly">*</span></label>
                        <input type="" value="{{$user->phone}}" placeholder="+79682659013" name="phoneNumber" maxlength="12" id="phoneNum">

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