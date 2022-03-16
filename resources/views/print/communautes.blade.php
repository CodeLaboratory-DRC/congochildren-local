@extends('print.template')
@section('title', 'Liste des communautés')
@section('containt')
<table class="table table-bordered mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Catégorisation</th>
            <th>Viabilité</th>
            <th>Capacité</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $communaute)
            <tr>
                <td>{{ $communaute->id }}</td>
                <td>{{ $communaute->nom }}</td>
                <td>{{ $communaute->categorisation }}</td>
                <td><?= str_replace('_', ' ', $communaute->viabilite) ?></td>
                <td>{{ $communaute->capacite . ' personne(s)' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
