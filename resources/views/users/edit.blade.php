@extends('layouts.site')

@section('content')
<form action="{{route('profile.update')}}" method="post">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    @if($errors->count())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        <label>Новый пароль</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Подтвердите пароль</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-outline-secondary">Сохранить</button>
    </div>
</form>
@stop