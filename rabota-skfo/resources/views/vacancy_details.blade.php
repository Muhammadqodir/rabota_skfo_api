@extends("./layouts/app")

@section("title")
- Резюме
@endsection

@section('content')
@if($vacancy != null)

<div class="row">
    <div class="col-lg-9">
        <span class="updated_date"><i class="far fa-clock"></i> Обновлено {{$vacancy->updated_at}}</span>
        <br>
        @if(Auth::check())
            @if(Auth::user()->role == 'student')
                <i style="float: right; color: {{Auth::user()->getDetails()->isFav($vacancy->id) ? '#F7B519' : '#444'}};" id="btnFav" onclick="addToFav()" class="{{Auth::user()->getDetails()->isFav($vacancy->id) ? 'fas' : 'far'}} fa-star btnFav"></i>
            @endif
        @endif
        <h3>{{$vacancy->position}}</h3>
        <h4>от {{$vacancy->getSalaryGap()}}</h4>
        <div style="margin-top: 12px">
            <div><i class="far fa-building"></i> <a style="text-decoration: none;" href="{{route('orgDetails', ['id'=>$vacancy->getUser()->getDetails()->id])}}">{{$vacancy->getUser()->getDetails()->getOrgFullName()}}</a></div>
            <div><i class="fas fa-map-marker-alt"></i> {{$vacancy->getUser()->getRegionName()}}</div>
            <div style="margin-top: 12px;">Опыт работы: <b>{{$vacancy->experience}}</b></div>
            <div>Образование: <b>{{$vacancy->education}}</b></div>
	    <div>Пол: <b>{{$vacancy->sex}}</b></div>
@if($vacancy->is_for_dp)
<i class="fa fa-wheelchair" aria-hidden="true"></i> Для людей с ограниченными возможностями
	@endif
            <div>Знание компьютера: <b>{{$vacancy->sex}}</b></div>
            @if($vacancy->getDLString() != "")
                <div>Водительские права: <b>{{$vacancy->getDLString()}}</b></div>
            @endif

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
                @if(Auth::user()->role == "student" && false)
                <button onclick="response()" id="btnResponse" style="font-size: 13px; margin-top: 12px;" class="btnColorSuccess">Откликнутся</button>
                @endif
                <button onclick="showContacts()" id="btnShowContants" style="font-size: 13px; margin-top: 12px; color: #333;" class="btnColorWarning">Получить контакты</button>
                <div id="contactBlock" style="display: {{Auth::user()->id == $vacancy->getUser()->id ? 'block' : 'none'}};">
                    <hr style="border: solid 1px;">
                    <h4>Контакты<h4>
                    
                    <table style="margin-top: 10px; font-size: 14px;" cellpadding="2">
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Телефон:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {{$vacancy->getUser()->phone}}
                            </th>
                        </tr>
                        <tr>
                            <th style="font-weight: normal; text-align: left;">
                                Почта:
                            </th>
                            <th style="text-align: left; font-weight: bold;">
                                {{$vacancy->getUser()->email}}
                            </th>
                        </tr>
                        @php ($contact_icons = ['IMO'=>'imo.png', 'Telegram' => 'telegram_.png', 'Почта'=>'email_c.png', 'Linkedin'=>'linkedin.png', 'Instagram'=>'inst_icon.png', 'Facebook'=>'facebook.png', 'Twitter'=>'twitter.png', 'Viber'=>'viber.png', 'WhatsApp'=>'whatsapp.png', 'VK'=>'vk_v.png'])
                        @foreach($vacancy->getContacts() as $item)
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
            <div class="card" style="margin-top: 12px; padding: 12px">
                <h5>Обязанности:</h5>{!! str_replace("\n", '<br>', $vacancy->duties) !!}
            </div>
            <hr style="border: solid 1px;">
            <div class="card" style="margin-top: 12px; padding: 12px"><h5>Условия:</h5>{!! str_replace("\n", '<br>', $vacancy->conditions) !!}</div>
            @if($vacancy->bonuses != "[]")
            <hr style="border: solid 1px;">
            <div class="card" style="margin-top: 12px; padding: 12px">
                <h5>Бонусы:</h5>
                @foreach($vacancy->getBonuses() as $item)
                - {{$item}}<br>
                @endforeach
            </div>
	    @endif
 @if($vacancy->social_package != "-")
            <hr style="border: solid 1px;">
            <div class="card" style="margin-top: 12px; padding: 12px"><h5>Соц. пакет льгот:</h5>{!! str_replace("\n", '<br>', $vacancy->social_package) !!}</div>
            @endif
            @if($vacancy->additional_requirements != "")
            <hr style="border: solid 1px;">
            <div class="card" style="margin-top: 12px; padding: 12px"><h5>Дополнительные требования:</h5>{!! str_replace("\n", '<br>', $vacancy->additional_requirements) !!}</div>
            @endif
            @if($vacancy->additional_info != "")
            <hr style="border: solid 1px;">
            <div class="card" style="margin-top: 12px; padding: 12px"><h5>Дополнительная информация:</h5>{!! str_replace("\n", '<br>', $vacancy->additional_info) !!}</div>
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
    function showContacts(){
        var request_url = "{{route('vGetContacts')}}";
        var vacancy_id = {{$vacancy->id}};
		var request = $.ajax({
			url: request_url,
			method: "GET",
			data: {
				"vacancy_id": vacancy_id
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

    function addToFav(){
        var request_url = "{{route('student.addToFav')}}";
		var request = $.ajax({
			url: request_url,
			method: "GET",
            data: {
                'id': {{$vacancy->id}}
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
</script>
@endsection
