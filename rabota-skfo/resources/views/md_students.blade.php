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
    <div style="text-align: right;">
        <label><a class="btn btn-success" href="{{route('moderator.studentsToExcel')}}">Экспорт <i class="fas fa-file-export"></i></a></label>
        
        <button onclick="showImportView()" class="btn btn-primary">Импорт <i class="fas fa-file-import"></i></button>
        <div id="importForm" style="display: none;">
            <form action="{{route('moderator.importStudents')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <a href="{{asset('import/шаблон1.xlsx')}}"><i class="far fa-file-alt"></i> Скачать пример</a> 
                <input type="file" name="importFile">
                <input type="submit" value="Импортировать" class="btn btn-success">
            </form>
        </div>
    </div>
        <form action="{{route('univer.students')}}" method="GET">
            <label>Поиск:</label>
            <div class="input-group mb-3">
            <input type="text" name="q" class="form-control" placeholder="Поиск по ФИО" value="{{$_GET['q'] ?? ''}}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary" type="button">
                <i class="fas fa-search"></i> Поиск
                </button>
            </div>
            </div>
            @if(isset($_GET['q']) && !empty($_GET['q']))
                <div>Результаты поиска для <span class="badge badge-primary">"{{$_GET['q']}}"</span>: <span class="badge badge-{{$students->total() == 0 ? 'danger' : 'success'}}">{{$students->total()}} найдено</span></div>
            @endif
        </form>
        <div>
            @if($students->total() == 0)
            <div style="text-align: center;">
                <img src="{{asset('res/illustrations/search_result.svg')}}" style="max-width: 300px">
                <br>
                Поиск не дал Результатов
            </div>
            @else
            <table class="table table-striped table-hover table-bordered" style="background-color: #fff;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Возраст</th>
                        <th scope="col">Пол</th>
                        <th scope="col">Университет</th>
                        <th scope="col">Резюме</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                @php($no = ($students->perPage() * ($students->currentPage() - 1)))
                @foreach($students as $student)
                    @php($no++)
                    <tr>
                        <th scope="row">{{$no}}</th>
                        <td>{{$student->name}}</td>
                        <td>{{$student->getAgeStr()}}</td>
                        <td>{{$student->getDetails()->sex == 'm' ? 'М':'Ж'}}</td>
                        <td>{{$student->getDetails()->getUniversity()->shortName}}</td>
                        <td>
                            @if($student->isResumeExist())
                                <a target="_blank" class="btn btn-primary" href="{{route('public_resume', ['resume_id'=>$student->getResume()->id])}}"><i class="far fa-file-alt"></i></a>
                                <a target="_blank" href="{{route('moderator.editResume', ['id'=>$student->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                            @else
                                <button disabled class="btn btn-primary"><i class="far fa-file-excel"></i></button>
                                <a target="_blank" href="{{route('moderator.editResume', ['id'=>$student->id])}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('moderator.editProfile', ['id'=>$student->id])}}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                            <button class="btn btn-danger"data-toggle="modal" data-target="#removeUser_{{$student->id}}"><i class="fas fa-trash-alt"></i></button>
                            <!-- Modal -->
                            <div class="modal fade" style="z-index: 999999999;" id="removeUser_{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Подтверите действие</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Вы действительно хотите удалить студента: <br><b>{{$student->name}}</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                    <a href="{{route('moderator.removeStudent', ['id'=>$student->id])}}"><button type="button" class="btn btn-danger">Удалить</button></a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="text-align: center;">
                {{$students->links()}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var isImportViewVisible = false;
    function showImportView(){
        if(isImportViewVisible){
            $('#importForm').css('display', 'none')
            isImportViewVisible = false;
        }else{
            $('#importForm').css('display', 'block')
            isImportViewVisible = true;
        }
    }
</script>
@endsection
