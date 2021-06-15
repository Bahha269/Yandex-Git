@extends('layouts.site')

@section('title')
{{$post->name}}
@stop

@section('content')
<h1>{{$post->name}}</h1>
<small class="text-muted">{{$post->created_at->format('d.m.y H:i')}}</small>
@if(auth()->check() && auth()->user()->admin)
    <a href="{{route('posts.edit', $post->id)}}" class="text-warning small mr-2">Редактировать</a>
    <form action="{{route('posts.destroy', $post->id)}}" class="confirmed d-inline-block" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-link text-danger">Удалить</button>
    </form>
@endif
<hr>
{!!$post->text!!}
<hr>
<h4>Комментарии <big class="text-info">{{$post->comments->count()}}</big></h4>
@foreach($post->comments as $comment)
<div class="media text-muted pt-3">
    <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
    <strong class="d-block text-gray-dark">@ {{$comment->user->name}} <small>{{$comment->created_at->format('d.m.Y H:i')}}</small></strong>
    {{$comment->text}}
    </p>
</div>
@endforeach
@guest
<a href="{{route('login')}}">Авторизуйтесь, чтобы оставлять комментарии</a>
@else
<form action="{{route('posts.comment', $post->id)}}" method="post">
    @csrf
    <div class="form-group">
        <label>Ваш комментарий</label>
        <textarea name="text" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-outline-secondary btn-sm">Отправить</button>
    </div>
</form>
@endguest

@stop