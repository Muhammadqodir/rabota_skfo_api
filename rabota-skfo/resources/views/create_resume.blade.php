@extends("./layouts/app")

@section("title")
- Конструктор резюме
@endsection

@section('sub_title')
Конструктор резюме
@endsection

@section('content')
<nav class="navigation" id="mainNav">
    <a href="#0">
        <div class="navigation__link active">
            Личная информация
        </div>
    </a>
    <a href="#1">
        <div class="navigation__link active">
            Пожелания
        </div>
    </a>
    <a href="#2">
        <div class="navigation__link">
            Образование
        </div>
    </a>
    <a href="#3">
        <div class="navigation__link">
            Опыт работы
        </div>
    </a>
    <a href="#4">
        <div class="navigation__link">
            Навыки и умения
        </div>
    </a>
    <a href="#5">
        <div class="navigation__link">
            Достижения
        </div>
    </a>
    <a href="#6">
        <div class="navigation__link">
            Интересы и хобби
        </div>
    </a>
    <a href="#7">
        <div class="navigation__link">
            Доп. информация
        </div>
    </a>
</nav>

<div class="pages" style="font-family: myfont_light; margin-top: 25px; margin-bottom: 30px;">
    <div class="row no-gutters" style="width: 100%;">
        <div class="col-md-9 col-xl-9 col-sm-12" style="min-height: 500px;">
            <h2>Создать резюме</h2>
            <div class="page-section" id="0" style="padding-top: 0px;">
                <div class="row">
                    <div class="col-lg-3 col-md-12" style="margin-top: 12px;">
                        <div style="width: 100%">
                            <img style="width: 100%; border-radius: 50px;" src="{{Auth::user()->isUserHasPic() ? asset(Auth::user()->pic) : asset('res/icons/no-photo.jpeg')}}">
                            <div class="editPic">
                                <a href="{{route('profile')}}"><img src="{{asset('res/icons/edit.svg')}}" style="width: 100%;"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12" style="margin-top: 12px;">
                        <h5 style="font-family: myfont">Личная информация <a href="{{route('profile')}}"><i class="fas fa-edit btn_text"></i></a></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="formControl" style="margin-top: 10px;">
                                    <label for="name">Ф.И.О. <span class="necessarly">*</span></label>
                                    <input type="" placeholder="Иванов Иван Иванович" disabled value="{{Auth::user()->name}}" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formControl" style="margin-top: 10px;">
                                    <label for="burnDate" class="one_line_text">Дата рождения <span class="necessarly">*</span></label>
                                    <input type="" id="burnDate" value="{{Auth::user()->getDetails()->bday}}" disabled placeholder="06.08.2001" maxlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="formControl">
                                    <label for="city">Регион <span class="necessarly">*</span></label>
                                    <input type="" placeholder="Ставрополь" disabled value="{{Auth::user()->getRegionName()}}" id="city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formControl">
                                    <label for="sex">Пол <span class="necessarly">*</span></label>
                                    <select id="sex" disabled>
                                    <option value="m" {{Auth::user()->getDetails()->sex == 'm' ? 'selected':''}}>Мужской</option>
                                        <option value="f" {{Auth::user()->getDetails()->sex == 'f' ? 'selected':''}}>Женский</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="formControl">
                                    <label for="family_status" class="one_line_text">Семейное положение <span class="necessarly">*</span></label>
                                    <select id="family_status">
                                        <option>Холост / Незамужем</option>
                                        <option>Женат / Замкжем</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formControl">
                                    <label for="citizenship">Гражданство <span class="necessarly">*</span></label>
                                    <input type="" id="citizenship" placeholder="" value="{{Auth::user()->getResume()->citizenship}}" maxlength="10">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <h5 style="font-family: myfont">Контакты</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="formControl" style="margin-top: 10px;">
                                    <label for="phoneNum" class="one_line_text">Номер телефона <span class="necessarly">*</span></label>
                                    <input type="" maxlength="10" placeholder="+79682659013" disabled value="{{Auth::user()->phone}}" id="phoneNum" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formControl" style="margin-top: 10px;">
                                    <label for="secondPhoneNum">Email</label>
                                    <input id="secondPhoneNum" disabled value="{{Auth::user()->email}}" placeholder="example@example.com">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-6">
                                <h5 style="font-family: myfont">Альтернативный способ связи</h5>
                            </div>
                            <div class="col-6" style="text-align: right;">
                                <h5 style="font-family: myfont_light; padding: 0px; color: #5A308C;" class="backButton" onclick="contactData.addAltContactRow()">Добавить</h5>
                            </div>
                        </div>
                        <div id="altContacts">

                        </div>
                    </div>
                </div>
            </div>

            <div class="page-section" id="1">
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="formControl" style="margin-top: 10px; max-width: none;">
                            <label for="position">Желаемая должность <span class="necessarly">*</span></label>
                            <input type="text" id="position" value="{{Auth::user()->getResume()->position}}">
                            <!-- <select id="position">
                                @foreach (App\Models\Position::all() as $item)
                                    <option value="{{$item->id}}" {{Auth::user()->getResume()->position == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="formControl" style="max-width: none;">
                            <label for="salary">Желаемая зарплата <span class="necessarly">*</span></label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="salary" value="{{Auth::user()->getResume()->salary}}" placeholder="50 000" onkeyup="currencyInputMask(this, event)">
                                </div>
                                <div class="col-md-6" style="margin-top: 8px;">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" {{Auth::user()->getResume()->salary_by_agreement == 1 ? 'checked' : ''}} id="salary_by_agreement">
                                    <label class="custom-control-label" for="salary_by_agreement">По договоренности</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formControl" style="max-width: 100000px;">
                    <label for="employment_type">Тип занятости <span class="necessarly">*</span></label>
                    <select onchange="" id="employment_type">
                        <option value="0" {{Auth::user()->getResume()->employment_type == 0 ? 'selected' : ''}}>Полный рабочий день</option>
                        <option value="1" {{Auth::user()->getResume()->employment_type == 1 ? 'selected' : ''}}>Неполный рабочий день</option>
                        <option value="2" {{Auth::user()->getResume()->employment_type == 2 ? 'selected' : ''}}>Удаленная работа (фриланс)</option>
                        <option value="3" {{Auth::user()->getResume()->employment_type == 3 ? 'selected' : ''}}>Посменный график</option>
                        <option value="4" {{Auth::user()->getResume()->employment_type == 4 ? 'selected' : ''}}>Временная работа</option>
                    </select>
                </div>
                

                <div class="formControl" style="max-width: 100000px;">
                    <label>Переезд и командировки <span class="necessarly">*</span></label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" {{Auth::user()->getResume()->b_trip == 1 ? 'checked' : ''}} class="custom-control-input" id="b_trip">
                            <label class="custom-control-label" for="b_trip">Готов к командировкам</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" {{Auth::user()->getResume()->moving == 1 ? 'checked' : ''}} id="moving">
                            <label class="custom-control-label" for="moving">Готов к переезду</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-section" id="2">
                <hr>
                <h5 style="font-family: myfont">Образование</h5>
                <div id="educationItems">

                </div>
                <h5 style="margin: auto; text-align: center; font-family: myfont_light; padding: 0px; margin-top: 20px; color: #5A308C;" class="backButton" onclick="eduView.addEduRow()">+ Добавить образование</h5>

                <!-- <hr> -->
                <!-- <h5 style="font-family: myfont">Дополнительное образование</h5>
                <div id="educationItems">
                    <div class="card" id="education0" style="padding: 15px;">
                        <div class="row">
                            <div class="col-6">
                                <div class="formControl" style="margin-top: 5px;">
                                    <label for="eduName">Учебное заведение <span class="necessarly">*</span></label>
                                    <input id="eduName" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="formControl" style="margin-top: 5px;">
                                    <label for="eduSpeciality">Специальность <span class="necessarly">*</span></label>
                                    <input id="eduSpeciality" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="formControl">
                                    <label for="eduStart">Начало обучения <span class="necessarly">*</span></label>
                                    <input class=".date_mask" id="eduStart" maxlength="10" placeholder="01.08.2001">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="formControl">
                                    <label for="eduEnd">Окончание обучения <span class="necessarly">*</span></label>
                                    <input class=".date_mask" id="eduEnd" maxlength="10" placeholder="01.08.2001">
                                </div>
                                <div style="margin-top: 20px;" class="custom-control formControl custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="chekEduNowDays">
                                    <label class="custom-control-label" for="chekEduNowDays">Учусь в данный момент</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 style="margin: auto; text-align: center; font-family: myfont_light; padding: 0px; margin-top: 20px; color: #5A308C;" class="backButton" onclick="addAltContactRow()">Добавить дополнительное образование</h5> -->

            </div>
            <!-- <div class="page-section" id="3">
                <h1>First</h1>
            </div> -->
            <div class="page-section" id="3">

                <hr>
                <h5 style="font-family: myfont">Опыт работы</h5>
                <div id="experienceItems">

                </div>
                <h5 style="margin: auto; text-align: center; font-family: myfont_light; padding: 0px; margin-top: 20px; color: #5A308C;" class="backButton" onclick="expView.addExpRow()">+ Добавить опыт работы</h5>
            </div>

            <div class="page-section" id="4">
                <hr>
                <h5 style="font-family: myfont">Навыки и умения</h5>
                <div id="langItems">
                    <div class="row" id="langItem0">
                        <div class="col-6">
                            <div class="formControl" style="margin-top: 5px;">
                                <label>Язык <span class="necessarly">*</span></label>
                                <input onchange="langsView.setLangName(0)" id="langName0" placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="formControl" style="margin-top: 5px;">
                                <label class="one_line_text">Уровень владения <span class="necessarly">*</span></label>
                                <select onchange="langsView.setLangLevel(0)" id="langLevel0">
                                    <option value="0">Начальный</option>
                                    <option value="1">Средний</option>
                                    <option value="2">Хороший</option>
                                    <option value="3">Свободное владение</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <h5 style="margin: auto; text-align: center; font-family: myfont_light; padding: 0px; margin-top: 20px; color: #5A308C;" class="backButton" id="addLangBtn">+ Добавить язык</h5>
                <hr>
                <div class="formControl" style="max-width: 10000px;">
                    <label for="edSkill">Дополнительные навыки <span class="necessarly">*</span></label></label>
                    <div class="row">
                        <div class="col-9" style="padding-right: 0px;">
                            <div class="formControl" style="max-width: 10000px; margin-top: 5px;">
                                <input id="edSkill" name="edSkill" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;">
                            </div>
                        </div>
                        <div class="col-3" style="padding-left: 0px;">
                            <button id="btnAddSkill" style="margin-top: 5px; height: 40px; border-top-left-radius: 0px;border-bottom-left-radius: 0px;">Добавить</button>
                        </div>
                    </div>
                    <div id="skillsList" style="margin-top: 10px;">

                    </div>
                </div>
                <h5 style="font-family: myfont; margin-top: 20px;">Водительские права</h5>
                <div class="row" id="driver_license">
                    <div class="col-sm-2">
                        <div style="margin-top: 10px;" class="custom-control formControl custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" onchange="driverLicense.setData('A', this.checked)" id="driverLitA">
                            <label class="custom-control-label" for="driverLitA">A</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div style="margin-top: 10px;" class="custom-control formControl custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" onchange="driverLicense.setData('B', this.checked)" id="driverLitB">
                            <label class="custom-control-label" for="driverLitB">B</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div style="margin-top: 10px;" class="custom-control formControl custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" onchange="driverLicense.setData('C', this.checked)" id="driverLitC">
                            <label class="custom-control-label" for="driverLitC">C</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div style="margin-top: 10px;" class="custom-control formControl custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" onchange="driverLicense.setData('D', this.checked)" id="driverLitD">
                            <label class="custom-control-label" for="driverLitD">D</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div style="margin-top: 10px;" class="custom-control formControl custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" onchange="driverLicense.setData('E', this.checked)" id="driverLitE">
                            <label class="custom-control-label" for="driverLitE">E</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-section" id="5">

                <hr>
                <h5 style="font-family: myfont">Достижения</h5>
                <div id="achievementsItems">

                </div>
                <h5 style="margin: auto; text-align: center; font-family: myfont_light; padding: 0px; margin-top: 20px; color: #5A308C;" class="backButton" onclick="achievementView.addRow()">+ Добавить достижение</h5>
            </div>
            <div class="page-section" id="6">
                <hr>
                <h5 style="font-family: myfont">Интересы и хобби</h5>
                <div class="formControl" style="max-width: 10000px;margin-top: 10px;">
                    <textarea placeholder="-Играю на гитаре&#10;-Шахматы&#10;-Программирование" style="height: 50px;" id="interests">{{Auth::user()->getResume()->interests}}</textarea>
                </div>
            </div>
            <div class="page-section" id="7">
                <hr>
                <h5 style="font-family: myfont">Доп. информация</h5>
                <div class="formControl" style="max-width: 10000px;margin-top: 10px;">
                    <textarea placeholder="Мои сильные стороны — хорошие управленческие и лидерские навыки, клиентоориентированность, системное мышление, позитивный настрой. Не пью, не курю." style="height: 50px;" id="additional_info">{{Auth::user()->getResume()->additional_info}}</textarea>
                </div>
            </div>
            <div style="width: 100%; text-align: center;">
                <button class="btnColor" onclick="submitResume()" style="max-width: 200px; margin: auto;">Сохранить</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/autocompleteInput.js')}}"></script>
<script src="{{asset('js/cabinet.js')}}"></script>
<script src="{{asset('js/dynamicForms.js')}}"></script>
<script src="{{asset('js/createresume.js')}}"></script>
<script>
    document.querySelector("#root").classList.remove("cool-bg2");;
</script>
<script>
    var submitUrl = '{{route("student.createResume")}}';
    var csrf_token = '{{csrf_token()}}';
    var resume_route = '{{route("student.resume")}}';
    contactData = new ContactData('altContacts', @json(Auth::user()->getResume()->getContacts()));
    skillsView = new SkillsView('skillsList', 'edSkill', 'btnAddSkill', @json(Auth::user()->getResume()->getSkills()));
    langsView = new LangsView('langItems', 'addLangBtn', @json(Auth::user()->getResume()->getLangs()));
    eduView = new EducationView('educationItems', @json(Auth::user()->getResume()->getEducation()));
    expView = new ExpView('experienceItems', @json(Auth::user()->getResume()->getExperience()));
    achievementView = new AchievementsView('achievementsItems', @json(Auth::user()->getResume()->getAchievements()));
    driverLicense = new DriverLicense('driver_license', @json(Auth::user()->getResume()->getDL()));
</script>
@endsection
