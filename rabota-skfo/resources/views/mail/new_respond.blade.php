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
        <img src="{{$respond->getUser()->isUserHasPic() ? asset($respond->getUser()->pic) : asset('res/icons/company.svg')}}" style="width: 100px">
        
        <h3 style="margin: 0px;">{{$respond->getUser()->getDetails()->getOrgFullName()}}</h3>
    </a>
    <div class="item_title"><i class="fas fa-user-tie"></i> {{$respond->getUser()->name}}
    </div>
    <div class="item_description" style="margin-left: 24px;">{!! str_replace("\n", '<br>', $respond->message) !!}</div>
    <div class="item_date" style="text-align: right;">{{$respond->created_at}}</div>
    <label class="less-padding" style="margin-top: 0px !important">Ответить:</label>
    <br>
    <a style="text-decoration: none;" href="tel: {{$respond->getUser()->phone}}"> <i class="fas fa-phone-alt"></i> {{$respond->getUser()->phone}}</a>
    <br>
    <a style="text-decoration: none;" href="mailto: {{$respond->getUser()->email}}"> <i class="fas fa-at"></i> {{$respond->getUser()->email}}</a>

    <p></p>
</body>
</html>