<div class="userData" style="width: 100%; margin-bottom: 30px; background-color: #F8F9FA; padding: 10px; border-radius: 18px;">
    <div style="text-align: center;">
        <img height="70" width="70" style="margin-right: 6px;" class="circle" src="{{Auth::user()->isUserHasPic() ? asset(Auth::user()->pic) : asset('res/icons/no-photo.jpeg')}}"><br>
        
        @if(Auth::user()->role == 'student')
            {{Auth::user()->name}}
        @endif
        @if(Auth::user()->role == 'organization')
            {{Auth::user()->getDetails()->getOrgFullName()}}
        @endif
        <br>
        <span style="color: #555555; font-size: 14px;">
            @if(Auth::user()->role == 'student')
                {{Auth::user()->getAgeStr()}}
            @endif
            @if(Auth::user()->role == 'organization')
                {{Auth::user()->name}}
            @endif
        </span>
        <br>
        <a href="{{route('profile')}}" class="badge badge-primary">Редактировать <i class="fas fa-user-edit"></i></a>
    </div>
    <hr>
    <div id="moreData" style="font-family: myfont_light;">
        <span class="list-item-label">Регион:</span>
        <div class="list-item normal">
            {{Auth::user()->getRegionName()}}
        </div>
        <span class="list-item-label">Телефон:</span>
        <div class="list-item normal">
            {{Auth::user()->phone}}
        </div>
        <span class="list-item-label">eMail:</span>
        <div class="list-item {{Auth::user()->isEmailVerified() ? 'success':'danger'}}" data-toggle="tooltip" data-placement="bottom" title="{{Auth::user()->isEmailVerified() ? 'Почта подтвеждена':'Почта не подтвеждена'}}">
            {{Auth::user()->email}} 
        </div>
        @if (!Auth::user()->isEmailVerified())
            <a class="badge badge-success" href="{{route('verification.send')}}" style="color: #fff; cursor: pointer;">Отправить письмо повторно <i class="fas fa-sync"></i></a>
        @endif
    </div>
</div>
