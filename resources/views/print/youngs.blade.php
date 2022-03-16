@extends('print.template')
@section('title', 'Liste des jeunes')
@section('containt')
<table class="table table-bordered mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Genre</th>
            <th>Adresse</th>
            <th>Enqueteur</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $younger)
        <tr>
            <td>PABEA-{{ $younger->id }}</td>
            <td>{{ $younger->nom }}</td>
            <td>{{ $younger->age}}ans</td>
            <td>{{ ($younger->genre == 'm') ? 'Masculin' : 'Feminin'  }}</td>
            <td>{{ $younger->adresse }}</td>
            <td>
              {{ App\Models\User::getName($younger->users_id); }}
            </td>
        </tr>
          @endforeach
    </tbody>
</table>
@endsection
