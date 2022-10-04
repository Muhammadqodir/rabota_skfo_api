@extends("./layouts/app")

@section("title")
- Резюме
@endsection

@section('content')
@if($resume != null)

<div class="row">
    <div class="col-lg-9">
        <span class="updated_date"><i class="far fa-clock"></i> Обновлено {{$resume->updated_at}}</span>
        <br>
        @if(Auth::check())
            @if(Auth::user()->role == 'organization')
                <i style="float: right; color: {{Auth::user()->getDetails()->isFav($resume->id) ? '#F7B519' : '#444'}};" id="btnFav" onclick="addToFav()" class="{{Auth::user()->getDetails()->isFav($resume->id) ? 'fas' : 'far'}} fa-star btnFav"></i>
            @endif
        @endif
        <h3>{{$resume->getPosition()}}</h3>
        <span class="resume_status badge badge-success"> В активном поиске </span>
        <br>
        <h5>{{$resume->getUser()->name}}</h5>
        <span class="age_region"> {{$resume->getUser()->getAgeStr()}}, {{$resume->getUser()->getRegionName()}}</span>

        <img class="resume_pic" src="{{$resume->getUser()->isUserHasPic() ? asset($resume->getUser()->pic) : asset('res/icons/no-photo.jpeg')}}">
        <div>
            @php
            $et = array('Полный рабочий день', 'Неполный рабочий день', 'Удаленная работа (фриланс)', 'Посменный график', 'Временная работа');
            @endphp
            <!-- <table style="margin-top: 12px;">
                        <tr>
                            <th class="r_label">
                            График работы
                            </th>
                            <th class="r_value">
                            {{$et[$resume->employment_type]}}
                            </th>
                        </tr>
                        <tr>
                            <th class="r_label">
                            Пол
                            </th>
                            <th class="r_value">
                            {{$resume->getUser()->getDetails()->sex == "m" ? 'Мужской':'Женский'}}
                            </th>
                        </tr>
                    </table> -->

            <table style="margin-top: 10px; font-size: 14px;" cellpadding="2">
                <tr>
                    <th style="font-weight: normal; text-align: left;">
                        Гражданство:
                    </th>
                    <th style="text-align: left; font-weight: bold;">
                        {{$resume->citizenship}}
                    </th>
                </tr>
                <tr>
                    <th style="font-weight: normal; text-align: left;">
                        Год рождения:
                    </th>
                    <th style="text-align: left; font-weight: bold;">
                        {{$resume->getUser()->getDetails()->bday . ' ('. $resume->getUser()->getDetails()->getAge().' '.$resume->getUser()->yearTextArg($resume->getUser()->getDetails()->getAge()).')'}}
                    </th>
                </tr>
                <tr>
                    <th style="font-weight: normal; text-align: left;">
                        Пол:
                    </th>
                    <th style="text-align: left; font-weight: bold;">
                        {{$resume->getUser()->getDetails()->sex == 'm' ? 'мужской' : 'женский'}}
                    </th>
                </tr>
                <tr>
                    <th style="font-weight: normal; text-align: left;">
                        Семейное положение:
                    </th>
                    <th style="text-align: left; font-weight: bold;">
                        {{$resume->getFamilyStatus();}}
                    </th>
                </tr>
				@if($resume->getDLString() != "")
                <tr>
                    <th style="font-weight: normal; text-align: left;">
                        Водительские права:
                    </th>
                    <th style="text-align: left; font-weight: bold;">
                        {{$resume->getDLString()}}
                    </th>
                </tr>
                @endif
            </table>
            @if(!Auth::check())
            <div class="contact row" style="padding: 12px; margin: 0px; margin-top:12px; display: flex; align-items: center;">
                <div class="col-md-1 col-sm-2 col-2" style="padding: 0px;">
                    <img src="{{asset('res/icons/contacts.svg')}}" align="left">
                </div>
                <div class="col-md-8 col-sm-10  col-10" style="padding: 0px;">
                    <span style="font-size: 15px; font-weight: bold; width: 100%;">Контакты</span><br>
                        <span style="font-size: 12px; line-height: 12px;">Чтобы увидеть контакты пожалуйста зарегистрируйтесь</span>
                </div>
                <div class="col-md-3" style="padding: 0px;">
                    <button onclick="window.location.href = '{{route('user.login')}}'" style="font-size: 13px; float: right;" class="btnColorWarning">Получить контакты</button>
                </div>
            </div>
            @else
                
                @if(Auth::user()->role == "organization")
                    @if($resume->isResponsed(Auth::user()->id))
                        <button class="btn btn-success" disabled style="font-size: 13px; margin-top: 12px; width: 100%;" class="btnColorSuccess"><i class="fas fa-check"></i> Отклик отправлен</button>
                    @else
                        <button onclick="response()" id="btnResponse" style="font-size: 13px; margin-top: 12px;" class="btnColorSuccess">Откликнутся</button>      
                    @endif
                @endif
                <button onclick="showContacts()" id="btnShowContants" style="font-size: 13px; margin-top: 12px; color: #333;" class="btnColorWarning">Получить контакты</button>
                <div id="contactBlock" style="display: none;">
                    <hr style="border: solid 1px;">
                    <h4>Контакты<h4>
                    
                    <table style="margin-top: 10px; font-size: 14px;" cellpadding="2">
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Телефон:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {{$resume->getUser()->phone}}
                            </th>
                        </tr>
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Почта:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {{$resume->getUser()->email}}
                            </th>
                        </tr>
                        @php ($contact_icons = ['IMO'=>'imo.png', 'Telegram' => 'telegram_.png', 'Почта'=>'email_c.png', 'Linkedin'=>'linkedin.png', 'Instagram'=>'inst_icon.png', 'Facebook'=>'facebook.png', 'Twitter'=>'twitter.png', 'Viber'=>'viber.png', 'WhatsApp'=>'whatsapp.png', 'VK'=>'vk_v.png'])
                        @foreach($resume->getContacts() as $item)
                            <tr>
                                <th style="font-weight: normal; text-align: left;">
                                <img src="{{asset('resume_template/icons/'.$contact_icons[$item->key])}}" width="24"> {{$item->key}}:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->value}}
                                </th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
            <hr style="border: solid 1px;">

            <div class="card" style="padding: 12px;">
                
                <h4>Образование<h4>

                @php ($isFirst = true)
                @foreach ($resume->getEducation() as $item)
                @if(!$isFirst)
                <hr>
                @else
                @php ($isFirst = false)
                @endif
                <table style="margin-top: 10px; font-size: 14px;" cellpadding="2">
                    <tr>
                        <th style="font-weight: normal; text-align: left;">
                            Учебное заведение:
                        </th>
                        <th style="text-align: left; font-weight: bold;">
                            {{$item->eduName}}
                        </th>
                    </tr>
                    @if($item->eduFaculty != '')
                    <tr>
                        <th style="font-weight: normal; text-align: left;">
                            Факультет:
                        </th>
                        <th style="text-align: left; font-weight: bold;">
                            {{$item->eduFaculty}}
                        </th>
                    </tr>
                    @endif
                    <tr>
                        <th style="font-weight: normal; text-align: left;">
                            Специальность:
                        </th>
                        <th style="text-align: left; font-weight: bold;">
                            {{$item->eduSpeciality}}
                        </th>
                    </tr>
                    <tr>
                        <th style="font-weight: normal; text-align: left;">
                            Форма обучения:
                        </th>
                        <th style="text-align: left; font-weight: bold;">
                            {{$item->eduType}}
                        </th>
                    </tr>
                    @if($item->eduStart != "")
                    <tr>
                        <th style="font-weight: normal; text-align: left;">
                            Период:
                        </th>
                        <th style="text-align: left; font-weight: bold;">
                            @if($item->checkEduNowDays == "true")
                            {{explode('.', $item->eduStart)[2] . ' - наст. время'}}
                            @else
                            {{explode('.', $item->eduStart)[2] . ' - ' . explode('.', $item->eduEnd)[2]}}
                            @endif
                        </th>
                    </tr>
		    @endif
@if(property_exists($item, "eduPractice"))
@if($item->eduPractice != "" && $item->eduPractice != "undefined")
		    <tr>
			<th style="font-weight: normal; text-align: left;">
		    Производственная практика<br> при прохождении обучения:
                        </th>
                        <th style="text-align: left; font-weight: bold;">
                            {{$item->eduPractice}}
                        </th>
		    </tr>
@endif
@endif
                </table>
                @endforeach
            </div>

                 @if(count($resume->getExperience()) > 0)
                <hr style="border: solid 1px;">
                <div class="card" style="padding: 12px;">
                    <h4>Опыт работы</h4>

                    @php ($isFirst = true)
                    @foreach($resume->getExperience() as $item)
                    @if(!$isFirst)
                    <hr style="margin-right: 20px; border: solid .5px #ccc;">
                    @else
                    @php ($isFirst = false)
                    @endif

                    <table style="margin-top: 10px; font-size: 14px;" cellpadding="2">
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Организация:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {{$item->expCompanyName}}
                            </th>
                        </tr>
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Должность:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {{$item->expPosition}}
                            </th>
                        </tr>
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Сфера:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {{$item->expSphere}}
                            </th>
                        </tr>
                        @if($item->expStart != "")
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Период работы:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                @if($item->checkExpNowDays == "true")
                                {{explode('.', $item->expStart)[2] . ' - наст. время'}}
                                @else
                                {{explode('.', $item->expStart)[2] . ' - ' . explode('.', $item->expEnd)[2]}}
                                @endif
                            </th>
                        </tr>
                        @endif
                        @if($item->expDuties != "")
                        <tr>
                            <th style="font-weight: normal; text-align: left; vertical-align: top;">
                                Должностные обязанности:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {!! str_replace("\n", '<br>', $item->expDuties) !!}
                            </th>
                        </tr>
                        @endif
                    </table>
                    @endforeach
                </div>
                    @endif

                    @if(count($resume->getAchievements()) > 0)
                    <hr style="border: solid 1px;">
                    <div class="card" style="padding: 12px">
                    <h4>Достижения<h4>

                            <table style="margin-top: 10px; font-size: 14px; width: 100%;" cellpadding="2">
                                @php ($isFirst = true)
                                @foreach ($resume->getAchievements() as $item)
                                @if(!$isFirst)
                                <hr style="margin-right: 20px; border: solid .5px #ccc;">
                                @php ($isFirst = false)
                                @endif
                                <tr>
                                    <th align="left">
                                        {{$item->achievementCountry}}
                                        <!-- <i>(Узбекистан)</i> -->
                                    </th>
                                    <th align="right">
                                        {{$item->achievementYear}}
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2" align="left" style="font-weight: normal;">
                                        {!! str_replace("\n", '<br>', $item->achievementAbout) !!}
                                        <hr>
                                    </th>
                                </tr>
                                @endforeach
                            </table>
                            </div>
                            @endif

                            @if($resume->interests != "")
                            <hr style="border: solid 1px;">
                            <div class="card" style="padding: 12px">
                            <h4>Интересы и хобби</h4>
                            <p style="margin-top: 10px; text-align: left; font-size: 14px;">
                                {!!str_replace("\n", "<br>", $resume->interests)!!}
                            </p>
                            </div>
                            @endif

                            @if($resume->additional_info != "")
                            <hr style="border: solid 1px;">
                            <div class="card" style="padding: 12px">
                            <h4>Дополнительная информация</h4>
                            <p style="margin-top: 10px; text-align: left; font-size: 14px;">
                                {!!str_replace("\n", "<br>", $resume->additional_info)!!}
                            </p>
                            </div>
                            @endif
                            <a target="_blank" href="{{route('public_resume', ['resume_id'=>$resume->id])}}?download=true" style="text-decoration: none; color: #333;">
                            <div style="display: flex; align-items: center; border: solid 1px #2ABEEB; cursor: pointer; background-color: #F0F9FC; border-radius: 15px; padding: 8px; margin-top: 12px;">
                                <img src="{{asset('res/icons/pdf.svg')}}" width=60 style="float: left;">
                                <div style="display: flex; margin-left: 12px; flex-direction: column;">
                                    <span style="font-size: 15px; font-weight: bold; width: 100%;">Резюме</span>
                                    <span style="font-size: 12px; margin-top: 4px; line-height: 12px;">Нажмите чтобы скачать резюме</span>
                                </div>
                            </div>
                            </a>
                            
                        @if(Auth::check())
                            @if(Auth::user()->role == 'organization' && !$resume->isResponsed(Auth::user()->id))
                                <div name="formResponse" id="formResponse" style="display: none; margin-top: 12px; text-align: center;">
                                    <div style="max-width: 100%;">
                                        <div class="formControl" style="margin-top: 12px; max-width: 100%; text-align: left;">
                                            <label>Откликнутся</label>
                                            <textarea placeholder="Введите текст сообшения. Соискатели могут увидеть ваше сообшение и ответить на ваши вопросы." id="responseText"></textarea>
                                        </div>
                                        <button class="btn btn-success" onclick="responseSend()" style="margin: auto;">Отправить</button>
                                    </div>
                                </div>
                            @endif
                        @endif
        </div>
    </div>
    <div class="col-lg-3" style="margin-top: 24px;">
        <div class="add_banner" style="width: 100%; height: 500px; background-color: #cccccc99">

        </div>
    </div>
</div>
@endif
@endsection

@section('js')
<script>
@if(Auth::check())
    @if(Auth::user()->role == 'organization')

        function addToFav(){
            var request_url = "{{route('org.addToFav')}}";
            var request = $.ajax({
                url: request_url,
                method: "GET",
                data: {
                    'id': {{$resume->id}}
                },
                dataType: "json"
            });

            request.done(function(msg) {
                console.log(msg);
                if(msg["success"]){
                    showAlert("Готово");
                    location.reload();
                }else{
                    showAlert(msg["message"]);
                }
            });

            request.fail(function(jqXHR, textStatus) {
                console.log(textStatus);
                showAlert("Произошла ошибка");
            });
        }

        @if(!$resume->isResponsed(Auth::user()->id))
            function response(){
                $("#formResponse").css("display", "none");
                $("#formResponse").css("display", "block");
                document.querySelector("#formResponse").scrollIntoView();
                event.target.remove();
            }

            function responseSend(){
                var request_url = "{{route('rResponse')}}";
                var msg = $('#responseText').val();
                if(msg == ""){
                    showAlert("Введите текст сообшения")
                    return
                }
                var resume_id = {{$resume->id}};
                var request = $.ajax({
                    url: request_url,
                    method: "GET",
                    data: {
                        "resume_id": resume_id,
                        "msg": msg
                    },
                    dataType: "json"
                });

                request.done(function(msg) {
                    console.log(msg);
                    if(msg["success"]){
                        showAlert("Готово");
                        location.reload();
                    }else{
                        showAlert(msg["message"]);
                    }
                });

                request.fail(function(jqXHR, textStatus) {
                    console.log(textStatus);
                    showAlert("Произошла ошибка");
                });
            }
        @endif
    @endif
@endif

    function showContacts(){
        var request_url = "{{route('rGetContacts')}}";
        var resume_id = {{$resume->id}};
		var request = $.ajax({
			url: request_url,
			method: "GET",
			data: {
				"resume_id": resume_id
			},
			dataType: "json"
		});

		request.done(function(msg) {
            console.log(msg);
			if(msg["success"]){
				showAlert("Готово");
                $("#btnShowContants").css("display", "none");
                $("#contactBlock").css("display", "block");
			}else{
				showAlert(msg["message"]);
			}
		});

		request.fail(function(jqXHR, textStatus) {
			console.log(textStatus);
			showAlert("Произошла ошибка");
		});

    }

</script>
@endsection
