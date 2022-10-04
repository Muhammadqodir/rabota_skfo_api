@extends("./layouts/blank")


@section('content')
    <div class="container" style="margin-top: 80px;">
        <h1>AdminPanel</h1>
        <br>
        <h2>
            {{Auth::user()->name}}
        </h2>
        <h2>
            {{Auth::user()->isEmailVerified()}}
        </h2>
    </div>
@endsection

@section('nav_btn')
<a href="{{route('user.logout')}}" style="text-decoration: none;">
	<div class="backButton" style="text-align: right;">
		<i class="fas fa-sign-in-alt"></i> Выйти
	</div>
</a>
@endsection