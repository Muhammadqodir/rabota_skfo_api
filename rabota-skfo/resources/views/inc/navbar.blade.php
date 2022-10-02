
<nav style="opacity: .9; position: fixed; width: 100%; text-align: center; z-index: 9999999;" class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			  <a class="navbar-brand title_logo" href="{{ URL::to('/'); }}">

<!--<span id="title_my" style="font-family: pacifico; color: #003974;">работа </span><span style="font-family: myfont_bold; color: #003974;">СКФО</span>-->
<img src="{{asset('res/rabota1.png')}}" height="50">
</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item menu_item {{ Request::is('univercities') ? 'active' : '' }}">
			        <a class="nav-link" href="{{route('univercities')}}">Университеты</a>
			      </li>
			      <li class="nav-item menu_item">
			        <a class="nav-link" href="{{route('search')}}?type=vacancy">Ищу работу <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item menu_item">
			        <a class="nav-link" href="{{route('search')}}?type=resume">Ищу сотрудника</a>
			      </li>
			      <li class="nav-item menu_item {{ Request::is('companies') ? 'active' : '' }}">
			        <a class="nav-link" href="{{route('search')}}?type=org">Каталог компаний</a>
			      </li>
			      <li class="nav-item menu_item {{ Request::is('companies') ? 'active' : '' }}">
			        <a class="nav-link" href="{{route('search')}}?type=org">Test</a>
			      </li>
			    </ul>
			    <ul class="navbar-nav my-2 my-lg-0">

					@include('inc.reglog')
					
			    </ul>
			  </div>
		</div>
	</nav>
