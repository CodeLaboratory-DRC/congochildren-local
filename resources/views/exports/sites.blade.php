@extends('exports.template')
@section('containts')
    <br>
    <h3 class="text-center mb-3">Pabea Cobalt - liste des sites minières de la localité de kipushi</h3>
    <br>
    <table>
        <thead>
            <tr>
                <th><b>NOM</b></th>
                <th><b>PROVINCE</b></th>
                <th><b>TERRITOIRE</b></th>
                <th><b>LOCALITE</b></th>
                <th><b>INITIAL</b></th>
                <th><b>RESPONSABLE</b></th>
                <th><b>TELEPHONE</b></th>
            </tr> 
        </thead>
        <tbody>
            @foreach($sites as $site)
                <tr>
                    <td>{{ $site->nom }}</td>
                    <td>{{ $site->province }}</td>
                    <td>{{ $site->territoire }}</td>
                    <td>{{ $site->localite }}</td>
                    <td>{{ $site->initial }}</td>
                    <td>{{ $site->responsable }}</td>
                    <td>{{ $site->phone }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

