@extends("./layouts/cabinet")

@section("title")
- Избранные
@endsection

@section('sub_title')
Избранные
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div id="resumeView" class="col-sm-12 col-md-9">
			<div id="tab_content" style="padding-top: 20px;">
                @if(count(Auth::user()->getDetails()->getFavs()) == 0)
                <div style="text-align: center;">
                    <img src="{{asset('res/illustrations/empty.svg')}}" style="max-width: 250px;"><br>
                    Список избранных пуст
                </div>
                @endif
                @foreach(Auth::user()->getDetails()->getFavs() as $item)
                    @php($resume = \App\Models\Resume::find($item->target_id))
                    @if($resume != null)
                    <div class="col-lg-12" style="margin-top: 18px;">
                        <a class="text-decoration-none" style="text-decoration: none;" href="{{route('open_resume', ['resume_id'=>$resume->id])}}">
                            <div class="card pointer_cursor">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-2"> <img src="{{$resume->getUser()->isUserHasPic() ? asset($resume->getUser()->pic) : asset('res/icons/no-photo.jpeg')}}" class="item_image circle"> </div>
                                        <div class="col-sm-10">
                                            <div class="item_title">{{explode(' ', $resume->getUser()->name)[1]}}</div>
                                            <div class="item_date">{{$resume->getUser()->getAgeStr()}}</div>
                                            <div class="item_description">
                                            <i class="fas fa-user-tie"></i> {{$resume->getPosition()}}<br>
                                                <i class="fas fa-map-marker-alt"></i> {{$resume->getUser()->getRegionName()}}<br>
                                                <i class="fas fa-circle"></i> {{$resume->family_status}}<br>
                                                @if($resume->salary_by_agreement)
                                                <i class="fas fa-money-bill-wave"></i> по договоренности
                                                @else
                                                <i class="fas fa-money-bill-wave"></i> {{$resume->salary}} руб.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <i class="fas fa-star btnFav" onclick="addToFav({{$resume->id}})" style="position: absolute; margin: 6px; font-size: 24px; color: #F7B519;"></i>
                            </div>
                        </a>
                    </div>
                    @endif
                @endforeach
			</div>
		</div>
		<!-- <div class="col-sm-12 col-md-3 order-1 order-sm-1 order-md-2" style="margin-top: 20px"> -->
		<div class="col-sm-12 col-md-3" style="margin-top: 20px">
			@include('inc.profile_widget')
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
    function addToFav(resume_id){
        var request_url = "{{route('org.addToFav')}}";
		var request = $.ajax({
			url: request_url,
			method: "GET",
            data: {
                'id': resume_id
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