@extends('exports.template')
@section('containts')
    <br>
    <h3 class="text-center mb-3">Pabea Cobalt - liste des localités</h3>
    <br>
    <table>
        <thead>
            <tr>
                <th><b>NOM</b></th>
                <th><b>PROVINCE</b></th>
                <th><b>TERRITOIRE</b></th>
                <th><b>NOMBRE DES SITES</b></th>
            </tr> 
        </thead>
        <tbody>
            @foreach($sites as $site)
                <tr>
                    <td>{{ $site->nom }}</td>
                    <td>{{ $site->province }}</td>
                    <td>{{ $site->territoire }}</td>
                    <td>{{ $intitule = App\Models\Site::countByLocalite($localite->id)  }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

