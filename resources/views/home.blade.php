@extends('layouts.site')

@section('content')
@if($posts->count())
    @foreach($posts as $post)
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="{{route('posts.show', $post->id)}}" class="text-reset">{{$post->name}}</a></h2>
        @if(auth()->check() && auth()->user()->admin)
            <a href="{{route('posts.edit', $post->id)}}" class="text-warning small mr-2">Редактировать</a>
            <form action="{{route('posts.destroy', $post->id)}}" class="confirmed d-inline-block" method="post">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-link text-danger">Удалить</button>
            </form>
        @endif
        <p class="blog-post-meta small">{{$post->created_at->format('d.m.Y H:i')}}</p>
        {!!mb_strimwidth($post->text, 0, 150, '...')!!} <a href="{{route('posts.show', $post->id)}}">Читать далее</a>
    </div>
    <hr>
    @endforeach
    {{$posts->links('vendor.pagination.bootstrap-4')}}
@else
    <h5>Записей не найдено</h5>
@endif
@stop