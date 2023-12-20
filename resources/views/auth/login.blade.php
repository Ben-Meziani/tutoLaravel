@extends('base')

@section('content')

<h1>Se connecter</h1>
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe </label>
                <input type="password" class="form-control" name="password" id="password">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</div>

@endsection