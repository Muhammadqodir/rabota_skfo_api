@extends("./layouts/cabinet")

@section("title")
- Статистика
@endsection

@section('sub_title')
Статистика
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div id="resumeView" class="col-sm-12 col-md-9">
			<div id="tab_content" style="padding-top: 20px;">
            @if(Auth::user()->isResumeExist())
                <div class="row">
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{count(Auth::user()->getResume()->getViews())}}</span><br>
                            <span style="font-size: 16px;">Просмотры</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{count(Auth::user()->getResume()->getDownloads())}}</span><br>
                            <span style="font-size: 16px;">Скачивания</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{count(Auth::user()->getResume()->getContactRequests())}}</span><br>
                            <span style="font-size: 16px;">Запрос контактов</span>
                        </div>
                    </div>
                </div>
            @else
                Создайте резюме чтобы увидеть статистику
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