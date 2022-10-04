@extends("./layouts/cabinet")

@section("title")
- Статистика
@endsection

@section('sub_title')
Статистика
@endsection

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="container">
    <div class="row" style="margin-top: 10px; margin-bottom: 24px">
        <!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
        <div class="col-sm-12 col-md-9">
            <div style="margin-top: 20px;">
                <h5>Общая статистика:</h5>
                <div class="row">
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{$users ?? '--'}}</span><br>
                            <span style="font-size: 16px;">Пользователей</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{$active_vacancies ?? '--'}}</span><br>
                            <span style="font-size: 16px;">Активных вакансии</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{$resumes ?? '--'}}</span><br>
                            <span style="font-size: 16px;">Резюме</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{$orgs ?? '--'}}</span><br>
                            <span style="font-size: 16px;">Компании</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3" style="margin-top: 14px;">
                        <div class="s_card">
                            <span style="font-size: 30px;">{{$univers ?? '--'}}</span><br>
                            <span style="font-size: 16px;">Университеты</span>
                        </div>
                    </div>
                </div>

                <h5 style="margin-top: 20px;">Трафик</h5>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-12">
                        <div class="s_card">
                            <canvas id="myChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-3 order-1 order-sm-1 order-md-2" style="margin-top: 20px"> -->
        <div class="col-sm-12 col-md-3" style="margin-top: 20px">
            <h5>Пользователи</h5>
            <div class="s_card" style="margin-top: 20px;">
                <canvas id="statChartPie" height="300"> </canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script>
    var stat = JSON.parse(@json($traffic));

    function initPieChart() {
        var ctx1 = document.getElementById('statChartPie').getContext('2d');
        var data = {
            labels: ['Вакансии', 'Резюме', 'Компании', 'Университы'],
            datasets: [{
                fill: true,
                backgroundColor: [
                    '#BF211E',
                    '#69A197',
                    '#E9CE2C',
                    '#4CA255'
                ],
                data: [{{$active_vacancies ?? 0}}, {{$resumes ?? 0}}, {{$orgs ?? 0}}, {{$univers ?? 0}}]}]
        };

        new Chart(ctx1, {
            type: "pie",
            data: data
        });
    }

    initPieChart();

    function initTraficChart() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: stat['labels'],
                datasets: [{
                    label: 'Трафик',
                    data: stat['values'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
    initTraficChart();
</script>
@endsection
