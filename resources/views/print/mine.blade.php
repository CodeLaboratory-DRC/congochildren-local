@extends('print.template')
@section('title', 'Liste des coopératives mines')
@section('containt')
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Catégorisation</th>
                <th>Service d'agrement</th>
                <th>Gérant</th>
                <th>Domaine</th>
                <th>Autre domaine</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $mines)
                <tr>
                    <td>{{ $mines->id }}</td>
                    <td>{{ $mines->nom }}</td>
                    <td>{{ $mines->categorisation }}</td>
                    <td>{{ $mines->serviceAgrement }}</td>
                    <td>{{ $mines->nomGerant }}</td>
                    <td>{{ $mines->domaine }}</td>
                    <td>{{ $mines->autreDomaines }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
