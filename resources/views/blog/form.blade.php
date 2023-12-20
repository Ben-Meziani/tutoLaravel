<form action="" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" id="title" value="Article de démonstration">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea class="form-control" name="content" id="content">Article de démonstration</textarea>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">Catégorie</label>
        <select  name="category_id" id="category">
        <option value="">Selectionner une catégorie</option>
            @foreach($categories as $category)
                <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    @php
        $tagsIds = $post->tags->pluck('id');
    @endphp
    <div class="form-group">
        <label for="content">Tags</label>
        <select name="tags[]" id="tag" multiple>
            @foreach($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        @error('tags')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        @if($post->id)
            Modifier
        @else
            Enregistrer
        @endif
    </button>
</form>
