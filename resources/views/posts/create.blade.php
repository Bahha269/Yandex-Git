@extends('layouts.site')

@section('content')
    <form action="{{route('posts.store')}}" method="post">
        @csrf
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
            <label>Заголовок</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>Текст</label>
            <textarea name="text" rows="10" class="form-control">{{old('text')}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-outline-secondary">Сохранить</button>
        </div>
    </form>
@stop