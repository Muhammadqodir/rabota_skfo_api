@if(!Auth::user()->isResumeExist())
    @php
        header("Location: " . URL::to(route('student.createCV')), true, 302);
        exit();
    @endphp
@endif
<!DOCTYPE html>
<html>
<head>
	<title>Резюме</title>
	<link rel="stylesheet" type="text/css" href="{{asset('resume_template/fonts.css')}}">
</head>
<body>
	<div style="width: 1000px; margin: auto; margin-top: 30px; margin-bottom: 30px;">
		<table width="100%">
			<tr>
				<th width="100">
					<div style="width: 100px; height: 30px; background-color: #0747A7"></div>
				</th>
				<th align="left">
					<div style="font-size: 60px; font-weight: normal;">
						{{explode(" ", Auth::user()->name)[0]}}
					</div>
					<div style="font-size: 60px; font-weight: bold; margin-top: -10px;">
						{{explode(" ", Auth::user()->name)[1]}}
					</div>
					<div style="font-size: 28px; font-style: italic; color: #0747A7; margin-top: 5px;">
						{{Auth::user()->getResume()->position}}
					</div>
				</th>
				<th align="right">
					<img src="{{Auth::user()->isUserHasPic() ? asset(Auth::user()->pic) : asset('res/icons/no-photo.jpeg')}}" width="200" align="right">
				</th>
				<th width="100">
					<div style="width: 100px; height: 30px; background-color: #0747A7"></div>
				</th>
			</tr>
		</table>
		<table width="800px" style="margin-left: 100px; margin-top: 30px; margin-right: 100px;">
			<tr>
				<th width="600" style="vertical-align: top;">

					<table style="margin-bottom: 15px; font-size: 14px;">
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Желаемая зарплата:
							</th>
							<th style="text-align: left; font-weight: bold;">
								{{Auth::user()->getResume()->getSalary()}}
							</th>
						</tr>
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Готовность к командировкам:
							</th>
							<th style="text-align: left; font-weight: bold;">
                                {{Auth::user()->getResume()->b_trip == 1 ? 'да' : 'нет'}}
							</th>
						</tr>
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Готовность к переезду:
							</th>
							<th style="text-align: left; font-weight: bold;">
                                {{Auth::user()->getResume()->moving == 1 ? 'да' : 'нет'}}
							</th>
						</tr>
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Занятость:
							</th>
							<th style="text-align: left; font-weight: bold;">
                                @php
                                    $et = array('Полный рабочий день', 'Неполный рабочий день', 'Удаленная работа (фриланс)', 'Посменный график', 'Временная работа');
                                @endphp
								{{$et[Auth::user()->getResume()->employment_type]}}
							</th>
						</tr>
					</table>

					<div style="border-bottom: solid 2px #0747A7; width: 570px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/user.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Личная информация
					</div>
					<table style="margin-top: 10px; font-size: 14px;">
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Гражданство:
							</th>
							<th style="text-align: left; font-weight: bold;">
								{{Auth::user()->getResume()->citizenship}}
							</th>
						</tr>
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Год рождения:
							</th>
							<th style="text-align: left; font-weight: bold;">
								{{Auth::user()->getDetails()->bday . ' ('. Auth::user()->getDetails()->getAge().' лет)'}}
							</th>
						</tr>
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Пол:
							</th>
							<th style="text-align: left; font-weight: bold;">
								{{Auth::user()->getDetails()->sex == 'm' ? 'мужской' : 'женский'}}
							</th>
						</tr>
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Семейное положение:
							</th>
							<th style="text-align: left; font-weight: bold;">
								{{Auth::user()->getResume()->family_status}}
							</th>
						</tr>
						@if($resume->getDLString() != "")
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left;">
								Водительские права:
							</th>
							<th style="text-align: left; font-weight: bold;">
								{{Auth::user()->getResume()->getDLString()}}
							</th>
						</tr>
						@endif
					</table>

					
					<div style="margin-top: 15px; border-bottom: solid 2px #0747A7; width: 570px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/education.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Образование
					</div>

                    @php ($isFirst = true)
                    @foreach (Auth::user()->getResume()->getEducation() as $item)
                        @if(!$isFirst)
                        <hr style="margin-right: 20px; border: solid .5px #ccc;">
                        @else
                            @php ($isFirst = false)
                        @endif
                        <table style="margin-top: 10px; font-size: 14px;">
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Учебное заведение:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->eduName}}
                                </th>
                            </tr>
                            @if($item->eduFaculty != '')
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Факултет:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->eduFaculty}}
                                </th>
                            </tr>
                            @endif
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Специальность:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->eduSpeciality}}
                                </th>
                            </tr>
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Форма обучения:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->eduType}}
                                </th>
                            </tr>
							@if($item->eduStart != "")
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Пероид:
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
                        </table>
                    @endforeach


					<div style="margin-top: 15px; border-bottom: solid 2px #0747A7; width: 570px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/work.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Опыт работы
					</div>

                    @php ($isFirst = true)
                    @foreach(Auth::user()->getResume()->getExperience() as $item)
                        @if(!$isFirst)
                            <hr style="margin-right: 20px; border: solid .5px #ccc;">
                        @else
                            @php ($isFirst = false)
                        @endif

                        <table style="margin-top: 10px; font-size: 14px;">
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Организация:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->expCompanyName}}
                                </th>
                            </tr>
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Должность:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->expPosition}}
                                </th>
                            </tr>
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Сфера:
                                </th>
                                <th style="text-align: left; font-weight: bold;">
                                    {{$item->expSphere}}
                                </th>
                            </tr>
                            <tr>
                                <th style="font-weight: normal; width: 200px; text-align: left;">
                                    Период работы:
                                </th>
							<th style="text-align: left; font-weight: bold;">
								06.2016 - 07.2018
							</th>
						</tr>
						<tr>
							<th style="font-weight: normal; width: 200px; text-align: left; vertical-align: top;">
								Должностные обязанности и достижения:
							</th>
							<th style="text-align: left; font-weight: bold;">
								{!! str_replace("\n", '<br>', $item->expDuties) !!}
							</th>
						</tr>
					</table>
                    @endforeach

<br>



					<div style="margin-top: 15px; border-bottom: solid 2px #0747A7; width: 570px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/certificate.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Достижения
					</div>

					<table style="margin-top: 10px; width: 570px; font-size: 14px;">
                        @php ($isFirst = true)
                        @foreach (Auth::user()->getResume()->getAchievements() as $item)
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
<br>
                    @if(Auth::user()->getResume()->interests != "")
                    <div style="margin-top: 15px; border-bottom: solid 2px #0747A7; width: 570px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/hobbi.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Интересы и хобби
					</div>
					<p style="margin-top: 10px; text-align: left; width: 570px; font-size: 14px;">
						{!!str_replace("\n", "<br>", Auth::user()->getResume()->interests)!!}
                    </p>

<br>
@endif
                    @if(Auth::user()->getResume()->additional_info != "")
                    <div style="margin-top: 15px; border-bottom: solid 2px #0747A7; width: 570px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/hobbi.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Дополнительная информация
					</div>
					<p style="margin-top: 10px; text-align: left; width: 570px; font-size: 14px;">
						{!!str_replace("\n", "<br>", Auth::user()->getResume()->additional_info)!!}
                    </p>
                    @endif
				</th>
				<th width="200" style="vertical-align: top;" align="left">
					<div style="border-bottom: solid 2px #0747A7; width: 200px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/contscts.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Контакты
					</div>
					<table style="margin-top: 10px; font-size: 14px;">
						<tr align="left">
							<th>
								<img src="{{asset('resume_template/icons/phone_c.png')}}" width="24">
							</th>
							<th style="padding-bottom: 4px;">
								{{Auth::user()->phone}} 
							</th>
						</tr>
						<tr align="left">
							<th>
								<img src="{{asset('resume_template/icons/email_c.png')}}" width="24">
							</th>
							<th style="padding-bottom: 4px;">
								{{Auth::user()->email}}
							</th>
						</tr>
						<tr align="left">
							<th>
								<img src="{{asset('resume_template/icons/loc_c.png')}}" width="24">
							</th>
							<th style="padding-bottom: 4px;">
								{{Auth::user()->getRegionName()}}
							</th>
						</tr>
                        @php ($contact_icons = ['IMO'=>'imo.png', 'Telegram' => 'telegram_.png', 'Почта'=>'email_c.png', 'Linkedin'=>'linkedin.png', 'Instagram'=>'inst_icon.png', 'Facebook'=>'facebook.png', 'Twitter'=>'twitter.png', 'Viber'=>'viber.png', 'WhatsApp'=>'whatsapp.png', 'VK'=>'vk_v.png'])
                        @foreach(Auth::user()->getResume()->getContacts() as $item)
                            <tr align="left">
                                <th>
                                    <img src="{{asset('resume_template/icons/'.$contact_icons[$item->key])}}" width="24">
                                </th>
                                <th style="padding-bottom: 4px;">
                                {{$item->value}}
                                </th>
                            </tr>
                            
                        @endforeach
						
					</table>


					<div style="margin-top: 15px; border-bottom: solid 2px #0747A7; width: 200px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/language.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Языки
					</div>
					<table style="margin-top: 10px; font-size: 14px; width: 200px;">
                    @php($langLevels = array('Начальный', 'Средний', 'Хороший', 'Свободное владение'))
                    @foreach(Auth::user()->getResume()->getLangs() as $item)
                    
                            <tr align="left">
                                <th  style="font-weight: normal; text-align: left; width: 100px;">
                                Язык
                                </th>
                                <th style="padding-bottom: 4px;">
                                {{$item->key}}
                                </th>
                            </tr>
                            <tr align="left">
                                <th  style="font-weight: normal; text-align: left; width: 100px;">
                                Уровень
                                </th>
                                <th style="padding-bottom: 4px;">
                                {{$langLevels[$item->value]}}
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <hr>
                                </th>
                            </tr>
                    @endforeach
					</table>

                    <div style="margin-top: 15px; border-bottom: solid 2px #0747A7; width: 200px; text-align: left; font-size: 20px; padding-bottom: 4px;">
						<img src="{{asset('resume_template/icons/skills.png')}}" width="24" style="margin-bottom: -10px; background-color: #0747A7; padding: 5px;"> Навыки
					</div>
					<table style="margin-top: 10px; font-size: 14px; width: 200px;">
                    @foreach(Auth::user()->getResume()->getSkills() as $item)
                    
                            <tr align="left">
                                <th style="padding-bottom: 4px;">
                                • {{$item}}
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <hr>
                                </th>
                            </tr>
                    @endforeach
					</table>

				</th>
			</tr>
		</table>
	</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

	function makeResume(){
        html2pdf().set({jsPDF: {format: [1000, 1414],unit: 'px'}}).from(document.querySelector('body')).toPdf().save('{{Auth::user()->name}}.pdf');
	}
    @if(array_key_exists('download', $_GET))
        makeResume();
    @endif

</script>
</body>
</html>