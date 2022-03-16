@extends('print.template')
@section('title', $data->localite->intitule . ': Liste des sites')
@section('containt')
<table class="table table-bordered mb-5">
    <thead>
        <tr>
            <th class="border-0 text-uppercase small font-weight-bold">Initial</th>
            <th>Nom</th>
            <th>Province</th>
            <th>Territoire</th>
            <th>Localite</th>
            <th>Responsable(Telephone)</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $site)
            <tr>
                <th scope="row">{{ $site->initial }}</th>
                <td>{{ $site->nom }}</td>
                <td>{{ $site->province }}</td>
                <td>{{ $data->localite->territoire }}</td>
                <td>{{ $data->localite->territoire }}</td>
                <td class="text-capitalize">{{ $site->responsable }}{{ ($site->phone) ?  (' - ' .$site->phone) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

