@extends('exports.template')
@section('containts')
    <table>
        <thead>
            <tr>
                <th><b>NOM</b> </th>
                <th><b>CATÉGORISATION</b> </th>
                <th><b>GÉRANT</b> </th>
                <th><b>STATUT JURIDIQUE</b> </th>
                <th><b>DOMAINE</b> </th>
                <th><b>TÉLÉPHONE</b> </th>
                <th><b>ADRESSE</b> </th>
                <th><b>EMAIL</b> </th>
                <th><b>SITE WEB</b> </th>
            </tr> 
        </thead>
        <tbody>
            @foreach($fournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->nom }}</td>
                    <td>{{ $fournisseur->categorisation }}</td>
                    <td>{{ $fournisseur->nomGerant }}</td>
                    <td>{{ $fournisseur->statutJuridique }}</td>
                    <td>{{ $fournisseur->domaine }}</td>
                    <td>{{ $fournisseur->telephone }}</td>
                    <td>{{ $fournisseur->adresse }}</td>
                    <td>{{ $fournisseur->email }}</td>
                    <td>{{ $fournisseur->website }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

