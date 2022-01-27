@extends('index')
@section('section')
<form action="ajout" method="get">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre du livre</label>
        <input type="text" class="form-control" id="titre" name="titre" ariadescribedby="titre">
    </div>
    <div class="mb-3">
        <label for="titre" class="form-label">Catégorie</label>
        <select name="categorie" id="categorie" class="form-select" aria-label="Default select example">
            @foreach ($cats as $cat)
            <option value="{{$cat->id}}">{{$cat->libelle}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="resume" class="form-label">Resumé</label>
        <input type="text" class="form-control" id="resume" name="resume">
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix du livre</label>
        <input type="text" class="form-control" id="prix" name="prix">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
@stop