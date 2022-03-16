@extends('exports.template')
@section('containts')
    <table>
        <thead>
            <tr>
                <th><b>NOM</b></th>
                <th><b>CATÉGORISATION</b></th>
                <th><b>GÉRANT</b></th>
                <th><b>SERVICE PUBLIC D'AGREMENT</b></th>
                <th><b>DOMAINE</b></th>
                <th><b>AUTRE DOMAINE</b></th>
            </tr> 
        </thead>
        <tbody>
            @foreach($mines as $mine)
                <tr>
                    <td>{{ $mine->nom }}</td>
                    <td>{{ $mine->categorisation }}</td>
                    <td>{{ $mine->nomGerant }}</td>
                    <td>{{ $mine->serviceAgrement }}</td>
                    <td>{{ $mine->domaine }}</td>
                    <td>{{ $mine->autreDomaine }}</td>                
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

