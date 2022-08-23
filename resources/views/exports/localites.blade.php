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
            @foreach ($sites->unique('localite') as $localite)
                <tr>
                    <td>{{ $localite->localite }}</td>
                    <td>{{ $localite->province }}</td>
                    <td>{{ $localite->territoire }}</td>
                    <td>{{ App\Models\Site::countByLocalite($localite->localite) }}</td>
            @endforeach
        </tbody>
    </table>
@endsection
