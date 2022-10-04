@extends("./layouts/app")


@section("title")
   - Главная
@endsection

@section("head")
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/slider.css')}}"/>
@endsection

@section('content')
    @include('inc.popular_vacancies')

    @include('inc.new_items')
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>

//showInfo('СТАВРОПОЛЬСКИЙ КРАЙ', {{\App\Http\Controllers\StatisticsController::activeVacanciesByRegion(5)}}, {{\App\Http\Controllers\StatisticsController::resumesByRegion(5)}}, 'sk')    

$('.slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  centerMode: true,
  responsive: [
    {
      breakpoint: 999999,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>
@endsection
