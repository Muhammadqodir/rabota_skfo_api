@php($tabs = [
'student.resume' => 'Мое резюме',
'student.views' => 'Статистика',
'student.responds' => 'Отклики',
'student.favorites' => 'Избранное',
'student.subscriptions' => 'Мои подписки',
'student.profile' => 'Мой профиль',
])
@php($newResponds = Auth::user()->getDetails()->getResponses())
<div id="tabs" style="margin-top: 20px;">
    <div class="dropdown d-md-none d-sm-block" style="width: 100%;">
        <button class="btn btn-secondary dropdown-toggle" style="width: 100%" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$tabs[Route::currentRouteName()]}}
        </button>
        <div class="dropdown-menu" style="width: 100%;" aria-labelledby="dropdownMenuButton">
            @foreach($tabs as $tab => $title)
            <a class="dropdown-item {{ Route::currentRouteName() == $tab ? 'active' : '' }}" href="{{route($tab)}}">
                {{$title}}
                @if($title == 'Октлики' && $newResponds > 0)
                    <span class="badge badge-danger">
                        {{$newResponds}}
                    </span>
                @endif
            </a>
            @endforeach
        </div>
    </div>

    <div class="d-md-block d-sm-none d-none">
        @foreach($tabs as $tab => $title)
        <a href="{{route($tab)}}" style="text-decoration: none;">
            <span class="{{ Route::currentRouteName() == $tab ? 'tab_selector_active' : 'tab_selector' }}" style="font-size: 16px;" id="tab_1">
                {{$title}}
                @if($title == 'Октлики' && $newResponds > 0)
                    <span class="badge badge-danger">
                        {{$newResponds}}
                    </span>
                @endif
            </span>
        </a>
        @endforeach
    </div>
</div>
