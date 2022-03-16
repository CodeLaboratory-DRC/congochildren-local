@extends('print.template')
@section('title', 'Liste des enfants')
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
        @foreach ($data as $child)
            <tr>
                <td>PABEA-{{ $child->id }}</td>
                <td>{{ $child->nom }}</td>
                <td>{{ $child->age }}ans</td>
                <td>{{ ($child->genre == 'm') ? 'Masculin' : 'Feminin' }}</td>
                <td>{{ $child->adresse }}</td>
                <td>
                {{ App\Models\User::getName($child->users_id); }}
                </td>
            </tr>
        @endforeach 
    </tbody>
</table>
@endsection
