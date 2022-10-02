<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <script src="https://kit.fontawesome.com/3a96fafdff.js" crossorigin="anonymous"></script>
</head>

<body style="font-family: myfont; padding: 24px;">
    <a style="text-decoration: none;" href="">
        <img src="{{$vacancy->getUser()->isUserHasPic() ? asset($vacancy->getUser()->pic) : asset('res/icons/company.svg')}}" style="width: 100px">

        <h3 style="margin: 0px;">{{$vacancy->getUser()->getDetails()->getOrgFullName()}}</h3>
    </a>
    <a style="text-decoration: none;" href="{{route('vacancyDetails', ['id'=>$vacancy->id])}}">
        <div class="item_title">{{$vacancy->position}}</div>
    </a>
    <div class="item_description">{!! str_replace("\n", '<br>', $vacancy->duties) !!}</div>
    
    <i class="fas fa-map-marker"></i> Регион: {{$vacancy->getUser()->getRegionName()}}<br>
    <i class="fas fa-money-bill-wave"></i> Зарплата: {{$vacancy->getSalaryGap()}}
</body>

</html>