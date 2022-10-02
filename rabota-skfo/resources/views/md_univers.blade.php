@extends("./layouts/cabinet")

@section("title")
- Студенты
@endsection

@section('sub_title')
Студенты
@endsection

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="container">
    <div style="margin-top: 30px; margin-bottom: 24px">
        <form action="{{route('univer.students')}}" method="GET">
            <label>Поиск:</label>
            <div class="input-group mb-3">
            <input type="text" name="q" class="form-control" placeholder="Поиск" value="{{$_GET['q'] ?? ''}}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary" type="button">
                <i class="fas fa-search"></i> Поиск
                </button>
            </div>
            </div>
            @if(isset($_GET['q']) && !empty($_GET['q']))
                <div>Результаты поиска для <span class="badge badge-primary">"{{$_GET['q']}}"</span>: <span class="badge badge-{{$univers->total() == 0 ? 'danger' : 'success'}}">{{$univers->total()}} найдено</span></div>
            @endif
        </form>
        <div>
            @if($univers->total() == 0)
            <div style="text-align: center;">
                <img src="{{asset('res/illustrations/search_result.svg')}}" style="max-width: 300px">
                <br>
                Поиск не дал Результатов
            </div>
            @else
            <table style="background-color: #fff;" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Университет</th>
                        <th scope="col">Кол-во студентов</th>
                        <th scope="col">Регион</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                @php($no = ($univers->perPage() * ($univers->currentPage() - 1)))
                @foreach($univers as $univer)
                    @php($no++)
                    <tr>
                        <th scope="row">{{$no}}</th>
                        <td>{{$univer->name}}</td>
                        <td>{{$univer->getDetails()->getStudentsCount()}}</td>
                        <td>{{$univer->getRegionName()}}</td>
                        <td style="width: 120px;">
                            <a href="{{route('moderator.editProfile', ['id'=>$univer->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="text-align: center;">
                {{$univers->links()}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

</script>
@endsection
