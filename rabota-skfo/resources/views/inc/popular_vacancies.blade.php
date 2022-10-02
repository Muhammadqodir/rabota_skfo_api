<!-- Popular vacancies -->
<div class="row" style="margin-top: 24px;">
    <div class="col-12">
        <h5><i class="fas fa-star" style="color: #FBC945;"></i> Популярные вакансии</h5>
    </div>
</div>
<div class="row slider" style="padding-left: 15px; padding-right: 15px">
    @foreach(\App\Http\Controllers\VacancyController::getPopularVacancies() as $vacancy)
    <div class="col-md-3 popular_v">
        <div class="divider_abs"></div>
        <div class="company"><i class="far fa-building"></i> {{$vacancy->getOrg()->getOrgFullName()}}</div>
        <div class="position">{{$vacancy->position}}</div>
        <i class="fas fa-arrow-right go" style="color: #003974; position: absolute; right: 18px; bottom: 18px;"></i>
    </div>
    @endforeach
</div>