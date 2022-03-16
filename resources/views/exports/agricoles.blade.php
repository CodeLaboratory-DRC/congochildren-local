@extends('exports.template')
@section('containts')
    <table>
        <thead>
            <tr>
                <th><b>NOM</b> </th>
                <th><b>CATÉGORISATION</b> </th>
                <th><b>GÉRANT</b> </th>
                <th><b>SERVICE PUBLIC D'AGREMENT</b> </th>
                <th><b>DOMAINE</b> </th>
                <th><b>CAPACITE DE PRODUCTION</b> </th>
            </tr> 
        </thead>
        <tbody>
            @foreach($agricoles as $agricole)
                <tr>
                    <td>{{ $agricole->nom }}</td>
                    <td>{{ $agricole->categorisation }}</td>
                    <td>{{ $agricole->nomGerant }}</td>
                    <td>{{ $agricole->serviceAgrement }}</td>
                    <td>{{ $agricole->domaine }}</td>
                    <td>{{ $agricole->capaciteProduction }}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

