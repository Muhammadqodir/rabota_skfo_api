<div id="tabs" style="margin-top: 30px;">
    <span class="tab_selector_active" id="tab_1" onclick="switchTab('tab_1')"><i class="fas fa-briefcase"></i> Новые ваканcии</span>
    <span class="tab_selector" id="tab_2" onclick="switchTab('tab_2')"><i class="fas fa-user"></i> Новые сотрудники</span>
</div>
<div id="new_vacancies" style="display: block;">

    <div class="row" style="margin-top: 18px;">
        @foreach(\App\Models\Vacancy::where('is_active', 1)->orderBy('updated_at')->take(10)->get() as $item)

            <div class="col-12" style="margin-bottom: 12px;">
                <div class="card" style="cursor: pointer;" onclick="window.location.href = '{{route('vacancyDetails', ['id'=>$item->id])}}'">
                    <div class="card-body" style="padding: 12px;">
                            <div class="row">
                                <div class="col-md-2"> <img src="{{$item->getUser()->isUserHasPic() ? asset($item->getUser()->pic) : asset('res/icons/company.svg')}}" class="item_image round_rect"> </div>
                                
                                <div class="col-md-10">
                                    <div class="item_date">{{$item->updated_at}}</div>
                                    <a style="text-decoration: none;" href="{{route('vacancyDetails', ['id'=>$item->id])}}">    
                                    <div class="item_title">{{$item->position}}</div>
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
    </div>

</div>

<div id="new_cvs" style="display: none; margin-top: 12px;">
    <div class="row" style="margin-top: 18px;">

	@foreach(\App\Models\Resume::all() as $item)
	@if($item->getUser() != null)
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
	@else
	{{$item->delete()}}
	@endif
        @endforeach

    </div>
</div>
