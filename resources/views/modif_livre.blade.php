@extends('index')
@section('section')
    <form action="valider_modif" method="get">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du livre</label>
            <input type="hidden" class="form-control" id="id" name="id" ariadescribedby="id" value="{{$livre->id}}">
            <input type="text" class="form-control" id="titre" name="titre" ariadescribedby="titre" value="{{$livre->titre}}">
        </div>
        <div class="mb-3">
        <label for="titre" class="form-label">Catégorie</label>
        <select name="categorie" class="form-select" aria-label="Default select example">
            @foreach ($cats as $cat)
            @if ($cat->id === $livre->categorie_id)
            <option selected value="{{$cat->id}}">{{$cat->libelle}}</option>
            @else
            <option value="{{$cat->id}}">{{$cat->libelle}}</option>
            @endif
            @endforeach
        </select>
    </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resumé</label>
            <input type="text" class="form-control" id="resume" name="resume" value="{{$livre->resume}}">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix du livre</label>
            <input type="text" class="form-control" id="prix" name="prix" value="{{$livre->prix}}">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
@stop
