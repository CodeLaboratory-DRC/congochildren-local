@extends('print.template')
@section('title', 'Liste des localités')
@section('containt')
<table class="table table-bordered mb-5">
    <thead>
        <tr>
            <th class="border-0 text-uppercase small font-weight-bold">Initial</th>
            <th>Nom</th>
            <th>Province</th>
            <th>Territoire</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $localite)
            <tr>
                <th scope="row">{{ $localite->initial }}</th>
                <td>{{ $localite->intitule }}</td>
                <td>{{ $localite->province }}</td>
                <td>{{ $localite->territoire }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection