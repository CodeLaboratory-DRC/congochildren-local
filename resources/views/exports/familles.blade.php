@extends('exports.template')
@section('containts')
    <table>
        <thead>
            <tr>
                <th>NOM PAPA </th>
                <th>NOM MAMAN</th>
                <th>ETAT MATRIMONIAL</th>
                <th>NIVEAU D'INSTRUCTION PAPA</th>
                <th>NIVEAU D'INSTRUCTION MAMAN</th>
                <th>NOMBRE D'ENFANTS</th>
                <th>NOMBRE DES GARCONS</th>
                <th>NOMBRE DES FILLES</th>
                <th>ACTIVITE PRINCIPALE</th>
                <th>ACTIVITE SECONDAIRE</th>
                <th>REVENU PAR JOUR</th>
                <th>NOMBRE D'ENFANTS DANS LA MINE</th>
            </tr> 
        </thead>
        <tbody>
            @foreach($families as $family)
                <tr>
                    <td>{{ $family->nom_pere }}</td>
                    <td>{{ $family->nom_mere }}</td>
                    <td>{{ $family->matrimonial }}</td>
                    <td>{{ $family->instruction_pere }}</td>
                    <td>{{ $family->instruction_mere }}</td>
                    <td>{{ $family->nb_enfant }}</td>
                    <td>{{ $family->nb_homme }}</td>
                    <td>{{ $family->nb_femme }}</td>
                    <td>{{ $family->activite_princ }}</td>
                    <td>{{ $family->activite_sec }}</td>
                    <td>{{ $family->revenu_jour }}</td>
                    <td>{{ $family->nb_enfant_mine }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

