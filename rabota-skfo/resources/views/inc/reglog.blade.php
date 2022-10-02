                    @if (Auth::check())
                    @php($notifications = Auth::user()->getNotifications())
                    <li class="nav-item dropdown" style="text-align: right; list-style-type: none;">
                    	<a class="nav-link dropdown-toggle" sty id="navbarDropdown" data-toggle="dropdown" style="color: #003974;" href="#">
                    		@if($notifications > 0)
                    		<span class="badge badge-danger">
                    			{{$notifications}}
                    		</span>
                    		@endif
                    		@if(Auth::user()->role == 'university')
                    		{{Auth::user()->getDetails()->shortName}}
                    		@else
                    		{{explode(' ', Auth::user()->name)[0]}}
                    		@endif
                    		<img class="circle" style="height: 40px; margin-left: 5px; border: solid 2px #00397444;" src="{{Auth::user()->isUserHasPic() ? asset(Auth::user()->pic) : asset('res/icons/no-photo.jpeg')}}"></a>
                    	{{-- <img class="circle" style="height: 40px; margin-left: 5px; border: solid 2px #00397444;" src="{{asset(Auth::user()->pic)}}"></a> --}}
                    	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    		<a class="dropdown-item" href="{{route('student.resume')}}">
                    			@if($notifications > 0)
                    			<span class="badge badge-danger">
                    				{{$notifications}}
                    			</span>
                    			@endif
                    			<i class="fas fa-user"></i>
                    			Мой кабинет
                    		</a>
                    		<a class="dropdown-item" href="{{route('profile')}}"><i class="fas fa-address-card"></i> Мой профиль</a>
                    		<div class="dropdown-divider"></div>
                    		<a class="dropdown-item" href="{{route('user.logout')}}"><i class="fas fa-sign-out-alt"></i> Выйти</a>
                    	</div>
                    </li>

                    @else
                    <li class="nav-item">
                    	<a class="nav-link" style="color: #003974;" href="{{route('user.reg')}}">+ Создать резюме</a>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link" style="color: #003974;" href="{{route('user.regOrg')}}">+ Создать вакансию</a>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link" style="color: #003974;" href="{{route('user.login')}}">| <i class="fas fa-sign-in-alt"></i></a>
                    </li>
                    @endif