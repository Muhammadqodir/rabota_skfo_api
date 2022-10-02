@extends("./layouts/cabinet")

@section("title")
- Гости
@endsection

@section('sub_title')
Гости
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div class="col-sm-12 col-md-9">
            @if(count(Auth::user()->getDetails()->getGuests()) == 0)
            <div style="text-align: center;">
                <img src="{{asset('res/illustrations/empty.svg')}}" style="max-width: 250px;"><br>
                Список гостей пуст
            </div>
            @endif
            <div class="row">
                @foreach(Auth::user()->getDetails()->getGuests() as $item)
                    @php($guest = \App\Models\User::find($item->user_id))
                    @if($guest != null)
                    <div class="col-md-12 col-lg-6"  style="margin-bottom: 12px;">
                        <div class="card">
                            <div class="card-body" style="cursor: pointer; display: flex; align-items: center;">
                                <img class="circle" style="width: 40px; float: left; margin-right: 12px;" src="{{$guest->isUserHasPic() ? asset($guest->pic) : asset('res/icons/no-photo.jpeg')}}">
                                <div>
                                    <span style="font-size: 12px; color: #888;">{{$item->created_at}}</span><br>
                                    {{$guest->name}}
                                </div>
                            </div>
                        </div>
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