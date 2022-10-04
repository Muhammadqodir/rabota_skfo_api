@extends("./layouts/app")


@section("title")
- Университеты
@endsection

@section('content')
<div class="container">

    <form action="{{route('search')}}" method="GET">
        <div class="row main_search" style="margin-top: 0px;">

            <div class="col-7" style="padding-right: 0px;">
                <i class="fas fa-search main_search_i"></i>
                <input type="text" placeholder="Поиск" value="{{$_GET['q']??''}}" onkeydown="if(event.key === 'Enter') {search()}" id="search_q" name="q">
            </div>
            <div class="col-3 search_type" style="background-color: #fff; padding-right: 0px;">
                <div></div>
                <select id="s_type" name="type">
                    @php($type = $_GET['type']??'')
                    <option value="vacancy" {{$type == "vacancy" ? 'selected' : ''}}>Ваканcии</option>
                    <option value="resume" {{$type == "resume" ? 'selected' : ''}}>Резюме</option>
                    <option value="org" {{$type == "org" ? 'selected' : ''}}>Компании</option>
                </select>
            </div>
            <div class="col-2" style="padding-left: 0px">
                <button class="btn_search"  style="height: 100%; width: 100%;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        @php($region_ = $_GET['region'] ?? 0)
        @php($sex = $_GET['sex'] ?? 0)
        @php($exp = $_GET['exp'] ?? 0)
        @php($sFrom = $_GET['sFrom'] ?? '')
        @php($sTo = $_GET['sTo'] ?? '')
        <?php
            $count = 0;
            if($region_ != 0){
                $count++;
            }
            if($sex != 0){
                $count++;
            }
            if($exp != 0){
                $count++;
            }
            if($sFrom != ''){
                $count++;
            }
            if($sTo != ''){
                $count++;
            }
        ?>
        @if($_GET["type"] != "org")

        <div style="text-align: right; padding-top: 8px;">
            <button type="button" onclick="switchAnvSearch()" class="btn btn-link">
                <i class="fas fa-sliders-h"></i> Расширенный поиск
                @if($count > 0)
                <span class="badge badge-danger">{{$count}}</span>
                @endif
            </button>
        </div>

        <div id="advanced" class="row formControl" style="max-width: none; margin-top: 0px; display: none;">
            <div class="col-md-6">
                <label for="region" class="less-padding">
                    Регион:
                </label>
                <select name="region" id="region">
                    <option value="0">Все</option>
                    @foreach(\App\Models\Region::all() as $region)
                    <option {{$region_ == $region->id ? 'selected' : ''}} value="{{$region->id}}">{{$region->name}}</option>
                    
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="exp" class="less-padding">
                    Опыт:
                </label>
                <select name="exp" id="exp">
                    <option value="0">Не имеет значения</option>
                    <option {{$exp == 1 ? 'selected' : ''}} value="1">Есть опыт</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="sFrom" class="less-padding">
                    Зарплата:
                </label>
                <div class="row">
                    <div class="col-6">
                        <input min="0" type="number" name="sFrom" id="sFrom" value="{{$sFrom}}" placeholder="От"></input>
                    </div>
                    <div class="col-6" style="padding-left: 0px;">
                        <input min="0" type="number" name="sTo" value="{{$sTo}}" placeholder="До"></input>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif

   @if(empty($trudvsem))
	<h5 style="margin-top: 12px;">
        	Результаты поиска {{isset($data) ? '('.count($data).')':''}}:
    	</h5>
    @else

	<h5 style="margin-top: 12px;">
                Результаты поиска {{isset($data) ? '('.count($data)+$trudvsem['meta']['total'].')':''}}:
	</h5>
    @endif
    

    @if((isset($data) && count($data) > 0) || (isset($trudvsem) && count($trudvsem) > 0))
    <div class="row">
        @if($type == 'vacancy')
        @foreach($data as $item)
        <div class="col-12" style="margin-bottom: 12px;">
            <div class="card" style="cursor: pointer;" onclick="window.location.href = '{{route('vacancyDetails', ['id'=>$item->id])}}'">
                <div class="card-body" style="padding: 12px;">
                    <div class="row">
                        <div class="col-md-2"> <img src="{{$item->getUser()->isUserHasPic() ? asset($item->getUser()->pic) : asset('res/icons/company.svg')}}" class="item_image round_rect"> </div>
                        <div class="col-md-10">
                            <div class="item_date">{{$item->updated_at}}</div>
                            <a style="text-decoration: none;" href="{{route('vacancyDetails', ['id'=>$item->id])}}">
                                <div class="item_title">{{$item->position}} @if($item->is_for_dp) <i class="fa fa-wheelchair" style="color: green;" aria-hidden="true"></i> @endif </div>
                            </a>
                            <div class="item_description">{!! str_replace("\n", '<br>', $item->duties) !!}</div>
                            <div class="row" style="color: #444;">
                                <div class="col-md-4" onclick="window.open('{{route('orgDetails', ['id'=>$item->getUser()->getDetails()->id])}}', '_blank').focus()">
                                    <i class="far fa-building"></i> {{$item->getUser()->getDetails()->getOrgFullName()}}
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-map-marker"></i> {{$item->getUser()->getRegionName()}}
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-money-bill-wave"></i> {{$item->getSalaryGap()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	@endforeach	

	@foreach($trudvsem['results']['vacancies'] as $item)
        <div class="col-12" style="margin-bottom: 12px;">
            <div class="card" style="cursor: pointer;" onclick="window.location.href = '{{$item['vacancy']['vac_url']}}'">
                <div class="card-body" style="padding: 12px;">
                    <div class="row">
                        <div class="col-md-2"> <img src="https://rabota.smolensk.ru/image?file=%2Fcms_data%2Fusercontent%2Fregionaleditor%2F%D1%84%D0%BE%D1%82%D0%BE+%D0%B4%D0%BB%D1%8F+%D0%B1%D0%B0%D0%BD%D0%BD%D0%B5%D1%80%D0%BE%D0%B2%2F%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0-%D1%80%D0%BE%D1%81%D1%81%D0%B8%D0%B8_%D0%B1%D0%B5%D0%BB%D1%8B%D0%B5-%D0%B1%D1%83%D0%BA%D0%B2%D1%8B.png&width=0&height=0&crop=True&theme=default" class="item_image round_rect"> </div>
                        <div class="col-md-10">
                            <div class="item_date">{{$item['vacancy']['creation-date']}}</div>
                            <a style="text-decoration: none;" href="{{$item['vacancy']['vac_url']}}">
                                <div class="item_title">{{$item['vacancy']['job-name']}}</div>
			    </a>
@if(isset($item['vacancy']['duty']))
                            <div class="item_description">{!! $item['vacancy']['duty'] !!}</div>
@endif			    
<div class="row" style="color: #444;">
                                <div class="col-md-4" onclick="window.open('{{ $item['vacancy']['company']['url'] }}', '_blank').focus()">
                                    <i class="far fa-building"></i> {{ $item['vacancy']['company']['name'] }}
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-map-marker"></i> {{ $item['vacancy']['region']['name'] }}
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-money-bill-wave"></i> {{ $item['vacancy']['salary'] }} руб.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
   
	@endif
        
        @if($type == 'resume')
        @foreach($data as $item)

        <div class="col-lg-6" style="margin-top: 18px;">
            <a class="text-decoration-none" style="text-decoration: none;" href="{{route('open_resume', ['resume_id'=>$item->id])}}">
                <div class="card pointer_cursor">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4"> <img src="{{$item->getUser()->isUserHasPic() ? asset($item->getUser()->pic) : asset('res/icons/no-photo.jpeg')}}" class="item_image circle"> </div>
                            <div class="col-sm-8">
                                <div class="item_title">{{explode(' ', $item->getUser()->name)[1]}}</div>
                                <div class="item_date">{{$item->getUser()->getAgeStr()}}</div>
                                <div class="item_description">
                                    <i class="fas fa-user-tie"></i> {{$item->getPosition()}}<br>
                                    <i class="fas fa-map-marker-alt"></i> {{$item->getUser()->getRegionName()}}<br>
                                    <i class="fas fa-circle"></i> {{$item->family_status}}<br>
                                    @if($item->salary_by_agreement)
                                    <i class="fas fa-money-bill-wave"></i> по договоренности
                                    @else
                                    <i class="fas fa-money-bill-wave"></i> {{$item->salary}} руб.
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @endif

        @if($type == 'org')
        @foreach($data as $item)

        <div class="col-lg-6" style="margin-top: 18px;">
            <a class="text-decoration-none" style="text-decoration: none;" href="{{route('orgDetails', ['id'=>$item->id])}}">
                <div class="card pointer_cursor">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4"> <img src="{{$item->getUser()->isUserHasPic() ? asset($item->getUser()->pic) : asset('res/icons/no-photo.jpeg')}}" class="item_image circle">

                                @if(Auth::check())
                                @if(Auth::user()->role == 'student')
                                @if(Auth::user()->getDetails()->isSubscribed($item->id))
                                <div style="margin-top: 12px;"> <button class="btn text-ellipsis" style="width: 100%;" onclick="subscribe({{$item->id}})"><i class="fas fa-check"></i> Вы подписаны</button> </div>
                                @else
                                <div style="margin-top: 12px;"> <button class="btn btn-success text-ellipsis" style="width: 100%;" onclick="subscribe({{$item->id}})">Подписаться</button> </div>
                                @endif
                                @endif
                                @endif
                            </div>
                            <div class="col-sm-8" style="padding: 0px; color: #444">
                                <h5 class="item_title">{{$item->getOrgFullName()}}</h5>

                                <i class="fas fa-map-marker-alt"></i> {{$item->getUser()->getRegionName()}}<br>
                                <i class="far fa-dot-circle"></i> {{$item->getSphere()->name}}

                                <div><label class="less-padding" style="margin-top: 0px !important;">Ваканции</label><br><i class="fas fa-briefcase"></i> Активные вакансии: ({{count($item->getActiveVacancies())}})</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
	@endif
    </div>

    @else
    <div style="text-align: center;">
        <img src="{{asset('res/illustrations/search_result.svg')}}" style="max-width: 300px">
        <br>
        Поиск не дал Результатов
    </div>

    @endif

</div>
@endsection


@section('js')
<script>
    var isVisible = false;

    function switchAnvSearch() {
        if (isVisible) {
            $("#advanced").css("display", "none");
            isVisible = false;
        } else {
            $("#advanced").css("display", "flex");
            isVisible = true;
        }
    }

    function subscribe(id) {
        var request_url = "{{route('student.subscribe')}}";
        var request = $.ajax({
            url: request_url,
            method: "GET",
            data: {
                'id': id
            },
            dataType: "json"
        });

        request.done(function(msg) {
            console.log(msg);
            if (msg["success"]) {
                showAlert("Готово");
                location.reload();
            } else {
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
