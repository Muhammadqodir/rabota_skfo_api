<div class='card card-shadow' style="margin-top: 20px;">
    <div class="card-body">
        <h5 class="card-title">Сброс пароля</h5>
        @if($errors->has("err_rpass"))
        <div class="alert alert-danger formControl" style="margin-top: 5px;">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('user.resetPassword')}}" method="GET">
            @csrf
            <div class="formControl" style="margin-top: 0px; max-width: none;">
                <label class="less-padding" for="old_password">Старый пароль <span class="necessarly">*</span></label>
                <input type="password" placeholder="Введите старый пароль" id="old_password" name="old_password">

                <label class="less-padding" for="new_password">Новый пароль <span class="necessarly">*</span></label>
                <input type="password" placeholder="Введите новый пароль" id="new_password" name="new_password">

                <label class="less-padding" for="new_password_retype">Подтверждение нового пароля <span class="necessarly">*</span></label>
                <input type="password" placeholder="Новый пароль ещё раз" id="new_password_retype" name="new_password_retype">
            </div>
            <div class="formControl" style="margin-top: 30px; margin-left: auto; margin-right: 0px; width: 100px;">
                <button onclick="">Изменить</button>
            </div>
        </form>
    </div>
</div>