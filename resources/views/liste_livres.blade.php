@extends ('index')
@section ('section')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Catégorie</th>
      <th scope="col">Titre</th>
      <th scope="col">Résumé</th>
      <th scope="col">Prix</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($livres as $livre)
    <tr>
      <td>{{ $livre->libelle }}</td>
      <td>{{ $livre->titre }}</td>
      <td>{{ $livre->resume }}</td>
      <td>{{ $livre->prix }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop