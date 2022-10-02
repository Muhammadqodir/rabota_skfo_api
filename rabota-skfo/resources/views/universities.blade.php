@extends("./layouts/app")

@section("title")
   - Университеты
@endsection

@section('content')
    
	<div class="row" style="text-align: center;">
        @foreach($universities as $item)
            <div class="col-md-4" style="text-align: center;">
				<div class="univer_item">
					<img width="80%" class="univer_item_img" src="{{asset($item->getUser()->pic)}}" style=" position: relative; top: 50%; -webkit-transform: translateY(-50%); -ms-transform: translateY(-50%); transform: translateY(-50%);">
				</div>
				<h4 class="univer_title">{{$item->fullName}}<h4>
			</div>
        @endforeach
    </div>

@endsection
