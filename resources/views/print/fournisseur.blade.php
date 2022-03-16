@extends('print.template')
@section('title', 'Liste des entreprises locales fournisseurs des materiaux de construction')
@section('containt')
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Catégorisation</th>
                <th>Gérant</th>
                <th>Status juridique</th>
                <th>Domaine</th>
                <th>Téléphone</th>
                <th>adresse</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $fournisseurs)
                <tr>
                    <td>{{ $fournisseurs->id }}</td>
                    <td>{{ $fournisseurs->nom }}</td>
                    <td>{{ $fournisseurs->categorisation }}</td>
                    <td>{{ $fournisseurs->nomGerant }}</td>
                    <td>{{ $fournisseurs->statutJuridique }}</td>
                    <td>{{ $fournisseurs->domaine }}</td>
                    <td>{{ $fournisseurs->telephone }}</td>
                    <td>{{ $fournisseurs->adresse }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
