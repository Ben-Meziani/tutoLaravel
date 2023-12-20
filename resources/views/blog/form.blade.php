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
    <button type="submit" class="btn btn-primary">
        @if($post->id)
            Modifier
        @else
            Enregistrer
        @endif
    </button>
</form>
