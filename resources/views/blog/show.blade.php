@extends('base')

@section('title', $post->title)

@section('content')


<article>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
</article>
<button class="btn btn-primary"><a href="{{ route('blog.edit', $post->id) }}">Edit</a></button>
@endsection
