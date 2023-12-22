@extends('base')

@section('title', 'accueil du blog')

@section('content')

<h1>Mon blog</h1>
@foreach($posts as $post)
<article>
    <h2>{{ $post->title }}</h2>
       <p>
       @if($post->category)
            <p class="small">Catégorie : <strong>{{ $post->category?->name }}</strong> @if(!$post->tags->isEmpty()), @endif</p>
            </p>
        @endif
        @if(!$post->tags->isEmpty())
            Tags :
            @foreach($post->tags as $tag)
                <span class="badge bg-secondary">{{ $tag->name }}</span>
            @endforeach
        @endif
       </p>
       @if($post->image)
           <img style="width: 100%; height: 250px; object-fit: cover" src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
       @endif
    <p>{{ $post->content }}</p>
    <p>
        <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id ]) }}" class="btn btn-primary">Lire la suite</a>
    </p>
</article>
@endforeach
{{ $posts->links() }}
@endsection