@extends('print.template')
@section('title', 'Liste des coopératives agricoles')
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
                <th>Capacité de production</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $agricoles)
                <tr>
                    <td>{{ $agricoles->id }}</td>
                    <td>{{ $agricoles->nom }}</td>
                    <td>{{ $agricoles->categorisation }}</td>
                    <td>{{ $agricoles->serviceAgrement }}</td>
                    <td>{{ $agricoles->nomGerant }}</td>
                    <td><?= str_replace('_', ' ', $agricoles->domaine) ?></td>
                    <td>{{ $agricoles->production . ' ' . $agricoles->capaciteProduction }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
