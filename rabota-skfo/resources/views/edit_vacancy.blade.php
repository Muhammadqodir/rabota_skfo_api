@extends("./layouts/app")

@section("title")
- Создать вакансию
@endsection

@section('sub_title')
Создать вакансию
@endsection

@section('content')

<nav class="navigation" id="mainNav">
    <a href="#0">
        <div class="navigation__link active">
            Вакансия
        </div>
    </a>
    <a href="#1">
        <div class="navigation__link active">
            Требования
        </div>
    </a>
    <a href="#2">
        <div class="navigation__link">
            Условия работы
        </div>
    </a>
    <a href="#3">
        <div class="navigation__link">
            Доп. информация
        </div>
    </a>
    <a href="#4">
        <div class="navigation__link">
            Доп. вопросы
        </div>
    </a>
</nav>

<div class="pages" style="font-family: myfont_light;">
    <div class="row">
        <div class="col-md-9 col-xl-9 col-sm-12" style="min-height: 500px;">

            <div class="page-section" id="0">
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
                        <h5 style="font-family: myfont">Вакансия</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="formControl" style="margin-top: 10px; max-width: 10000px;">
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
                                    <label for="orgForm" style="padding-top: 12px;">Форма и название организации <span class="necessarly">*</span></label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select disabled id="orgForm" name="orgForm">
                                                @foreach($types as $type)
                                                <option {{Auth::user()->getDetails()->form == $type ? 'selected':''}}>{{$type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-9" style="padding-left: 0px;">
                                            <input type="" disabled placeholder="Введите название организации" value="{{Auth::user()->getDetails()->name}}" id="orgName" name="orgName">
                                        </div>
                                    </div>

                                    <label style="padding-top: 12px;" for="region">Регион
                                        <span class="necessarly">*</span>
                                    </label>
                                    <select disabled placeholder="Выбетите ваш регион" onchange="fillUniversities()" id="region" name="region">

                                        @foreach (App\Models\Region::all() as $item)
                                        <option value="{{$item->id}}" {{Auth::user()->region_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                    <label style="padding-top: 12px;" for="orgSphere">Сфера деятельности<span class="necessarly">*</span></label>
                                    <select disabled id="orgSphere" name="orgSphere">
                                        @foreach(App\Models\Sphere::all() as $item)
                                        <option value="{{$item->id}}" {{Auth::user()->getDetails()->sphere == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>

                                    <hr>
                                    <h5 style="font-family: myfont">Контакты</h5>
                                    <div style="padding-top: 12px;">
                                        <label for="phoneNumber">Номер контактного лица <span class="necessarly">*</span></label>
                                        <input disabled type="" placeholder="+7__________" value="{{Auth::user()->phone}}" maxlength="12" id="phoneNumber" name="phoneNumber">
                                    </div>

                                    <label style="padding-top: 12px;" for="email">eMail <span class="necessarly">*</span></label>
                                    <input type="email" disabled placeholder="example@example.com" value="{{Auth::user()->email}}" id="email" name="email">
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

                <div class="formControl" style="margin-top: 10px; max-width: none;">
                    <label for="position">Наименование вакансии <span class="necessarly">*</span></label>
                    <input type="" value="{{$vacancy->position}}" placeholder="Наименование вакансии" id="position" name="position">
                </div>
                <div class="formControl" style="max-width: none;">
                    <label for="duties">Обязанности <span class="necessarly">*</span></label>
                    <textarea name="duties" id="duties">{{$vacancy->duties}}</textarea>
                </div>
                <div class="formControl" style="max-width: none;">
                    <label for="conditions">Условия работы <span class="necessarly">*</span></label>
                    <textarea name="conditions" id="conditions">{{$vacancy->conditions}}</textarea>
                </div>
                <hr>
                <h5 style="font-family: myfont; margin-top: 12px;">Требования</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formControl" style="margin-top: 10px;">
                            @php($items = [
                                "Не имеет значения",
                                "от 1 до 3 лет",
                                "от 3 до 5 лет",
                                "от 5 до 10 лет",
                                "более 10 лет"
                                ])
                            <label for="experience">Опыт работы <span class="necessarly">*</span></label>
                            <select id="experience" name="experience">
                                @foreach($items as $item)
                                    <option {{$vacancy->experience == $item ? 'selected' : ''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formControl" style="margin-top: 10px;">
                            @php($items = [
                                "Не имеет значения",
                                "Среднее",
                                "Неполное среднее",
                                "Средне-специальное",
                                "Незаконченное высшее",
                                "Высшее",
                                "Ученая cтепень"
                                ])
                            <label for="education">Образование <span class="necessarly">*</span></label>
                            <select id="education" name="education">
                                @foreach($items as $item)
                                    <option {{$vacancy->education == $item ? 'selected' : ''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="formControl" style="margin-top: 10px;">
                            @php($items = [
                                "Не имеет значения",
                                "Мужской",
                                "Женский"
                                ])
                            <label for="sex">Пол <span class="necessarly">*</span></label>
                            <select id="sex" name="sex">
                                @foreach($items as $item)
                                    <option {{$vacancy->sex == $item ? 'selected' : ''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formControl" style="margin-top: 10px;">
                            @php($items = [
                                "Не имеет значения",
                                "Базовый уровень",
                                "Начальный",
                                "Средний пользователь",
                                "Уверенный пользователь",
                                "Продвинутый пользователь",
                                "Эксперт"
                                ])
                            <label for="tech_knowledges">Знание компьютера <span class="necessarly">*</span></label>
                            <select id="tech_knowledges" name="tech_knowledges">
                                @foreach($items as $item)
                                    <option {{$vacancy->tech_knowledges == $item ? 'selected' : ''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
<div class="row" style="margin-top: 12px;">
                        <div class="col-md-12">
<div class="formControl" style="height: 100%; margin-top: 0px;">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" {{$vacancy->is_for_dp ? "checked" : ""}} class="custom-control-input" id="is_for_dp">
                                <label class="custom-control-label" for="is_for_dp">Для людей с ограниченными возможностями</label>
                            </div>

                        </div>
                        </div>
                </div>
                <label style="font-family: myfont_light; margin-top: 20px;">Водительские права</label>
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

            <div class="page-section" id="2">
                <hr>
                <h5 style="font-family: myfont">Условия</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formControl" style="margin-top: 10px;">
                            <label for="salaryFrom">Оклад <span class="necessarly">*</span></label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="salaryFrom">От:</label>
                                    <input id="salaryFrom" value="{{$vacancy->salary_from}}" onkeyup="currencyInputMask(this, event)" placeholder="50 000">
                                </div>
                                <div class="col-6">
                                    <label for="salaryTo">До:</label>
                                    <input id="salaryTo" value="{{$vacancy->salary_to}}" onkeyup="currencyInputMask(this, event)" placeholder="150 000">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 12px;">
                        <div class="formControl" style="height: 100%; margin-top: 0px; display: flex; align-items: flex-end;">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="salary_by_agreement">
                                <label class="custom-control-label" {{$vacancy->salary_by_agreement ? 'checked' : ''}} for="salary_by_agreement">По договоренности</label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="formControl" style="max-width: 100000px;">
                    <label for="salary">Бонусы <span class="necessarly">*</span></label>
                    <div class="row">
                        <div class="col-9" style="padding-right: 0px;">
                            <div class="formControl" style="max-width: 10000px; margin-top: 5px;">
                                <input id="edBonuses" name="edBonuses" placeholder="парковка" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;">
                                <label class="less-padding">Например: мед. страхование; бесплатный обед; парковка; спорт. зал и т.д</label>
                            </div>
                        </div>
                        <div class="col-3" style="padding-left: 0px;">
                            <button id="btnAddBonus" style="margin-top: 5px; height: 40px; border-top-left-radius: 0px;border-bottom-left-radius: 0px;">Добавить</button>
                        </div>
                    </div>
                    <div id="bonusesList" style="margin-top: 10px;">

                    </div>
		</div>
<div class="formControl" style="max-width: 100000px;">
                    <label for="social_package">Соц. пакет льгот:</label></label>
                    <textarea id="social_package">{{$vacancy->social_package}}</textarea>
                </div>
            </div>
            </div>

            <div class="page-section" id="3">

                <hr>
                <h5 style="font-family: myfont">Дополнительная информация</h5>

                <div class="formControl" style="max-width: 100000px;">
                    <label for="additional_info">Укажите дополнительную информацию о вакансии <span class="necessarly">*</span></label></label>
                    <textarea id="additional_info">{{$vacancy->additional_info}}</textarea>
                </div>
                <div class="formControl" style="max-width: 100000px;">
                    <label for="additional_requirements">Дополнительные требования <span class="necessarly">*</span></label></label>
                    <textarea id="additional_requirements">{{$vacancy->additional_requirements}}</textarea>
                </div>
            </div>
<!--
            <div class="page-section" id="4">
                <hr>
                <div style="background-color: #8697AC; padding: 15px; color: #fff; border-radius: 5px;">
                    <h5 style="font-family: myfont; font-size: 18px;">Дополнительные вопросы для соискателя</h5>
                    <label>Здесь вы можете создать вопросы, на которые кандидаты должны будут ответить при отклике на вашу вакансию. Ответы кандидатов покажут Вам сразу насколько данный кандидат соответствует Вашим требованиям.</label>
                    <button class="btnQuation">Добавить вопрос</button>
                </div>
            </div> -->
            <div style="width: 100%; text-align: center;">
                <button class="btnColor" onclick="submitVacancy()" style="max-width: 200px; margin: auto;">Сохранить</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/cabinet.js')}}"></script>
<script src="{{asset('js/dynamicForms.js')}}"></script>
<script src="{{asset('js/createvacancy.js')}}"></script>
<script src="{{asset('js/masks.js')}}"></script>
<script>
    document.querySelector("#root").classList.remove("cool-bg2");;
</script>
<script>
    var submitUrl = '{{route("org.createVacancyPost")}}';
    var csrf_token = '{{csrf_token()}}';
    var vacancies_route = '{{route("org.vacancies")}}';
    var vacancy_id = {{$vacancy->id}};
    contactData = new ContactData('altContacts', @json($vacancy->getContacts()));
    skillsView = new SkillsView('bonusesList', 'edBonuses', 'btnAddBonus', @json($vacancy->getBonuses()));
    driverLicense = new DriverLicense('driver_license', @json($vacancy->getDL()));
    quize = new Quize([]);
</script>
@endsection
