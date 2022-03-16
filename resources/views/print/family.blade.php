@extends('print.template')
@section('title', 'Liste des ménages')
@section('containt')
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du Pere</th>
                <th>Nom de la mere</th>
                <th>Etat matrimonial</th>
                <th>Nombre d'enfants</th>
                <th>Activité principale</th>
                <th>Enqueteur</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($data as $family)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $family->nom_pere }}</td>
                        <td>{{ $family->nom_mere }}</td>
                        <td>{{ $family->matrimonial }}</td>
                        <td>{{ $family->nb_enfant }}</td>
                        <td>{{ $family->activite_princ }}</td>
                        <td>
                            {{ App\Models\User::getName($family->users_id); }}
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
@endsection
