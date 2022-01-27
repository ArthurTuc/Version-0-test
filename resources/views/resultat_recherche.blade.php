@extends ('index')
@section ('section')
<h2>Résulat de la recherche</h2>
@if (count($livres) == 0)
<p>Aucun livre n'a été trouvé pour la recherche "{{$search}}".</p>
@else 
<div class="table-responsive custom-table-responsive">
    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Résumé</th>
                <th scope="col">Prix</th>
              </tr>
        </thead>
        <tbody>
            @foreach ($livres as $livre)
            <tr><td>{{ $livre->titre }}</td><td>{{ $livre->resume }}</td><td>{{ $livre->prix }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@stop