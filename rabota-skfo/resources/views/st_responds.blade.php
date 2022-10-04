@extends("./layouts/cabinet")

@section("title")
- Отклики
@endsection

@section('sub_title')
Отклики
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div id="resumeView" class="col-sm-12 col-md-9">
			<div id="tab_content" style="padding-top: 20px;">
            @if($hasResume)

                @if(count($responds) == 0)
                    <div style="text-align: center;">
                        <img src="{{asset('res/illustrations/empty.svg')}}" style="max-width: 250px;"><br>
                        Список откликов пуст
                    </div>
                @endif
                @foreach($responds as $item)
                    <div class="col-12" style="margin-bottom: 12px;">
                        <div class="card" style="cursor: pointer;">
                            <div class="card-body" style="padding: 12px;">
                                    <div class="row">
                                        <div class="col-lg-2 d-lg-block d-md-none d-none"> <img src="{{$item->getUser()->isUserHasPic() ? asset($item->getUser()->pic) : asset('res/icons/company.svg')}}" class="item_image round_rect"> </div>
                                        
                                        <div class="col-md-12 col-lg-10">
                                            <div class="item_date">{{$item->updated_at}}</div>
                                            <div class="item_title">{{$item->getUser()->name}} (
                                                <a style="text-decoration: none;" href="{{route('orgDetails', ['id'=>$item->getUser()->getDetails()->id])}}">{{$item->getUser()->getDetails()->getOrgFullName()}}</a>)
                                            </div>
                                            <div class="item_description">{!! str_replace("\n", '<br>', $item->message) !!}</div>
                                            <label class="less-padding" style="margin-top: 0px !important">Ответить:</label>
                                            <br>
                                            <a style="text-decoration: none;" href="tel: {{$item->getUser()->phone}}"> <i class="fas fa-phone-alt"></i> {{$item->getUser()->phone}}</a>
                                            <br>
                                            <a style="text-decoration: none;" href="mailto: {{$item->getUser()->email}}"> <i class="fas fa-at"></i> {{$item->getUser()->email}}</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                Создайте резюме чтобы получать отклики
            @endif
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
function copyLink() {
  var copyText = document.getElementById("resume_link");

  /* Select the text field */
  copyText.focus();
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  document.execCommand('copy')
  /* Alert the copied text */
  showAlert("Скопировано!");
}
</script>
@endsection