@extends('layouts.site')

@section('content')
    <form action="{{route('posts.update', $post->id)}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label>Заголовок</label>
            <input type="text" class="form-control" name="name" value="{{old('name') ? old('name') : $post->name}}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Текст</label>
            <textarea name="text" rows="10" class="form-control">{{old('text') ? old('text') : $post->text}}</textarea>
            @error('text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-outline-secondary">Сохранить</button>
        </div>
    </form>
@stop