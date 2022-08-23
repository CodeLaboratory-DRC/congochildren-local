@extends('exports.template')
@section('containts')
    <table>
        <thead>
            <tr>
                <th>NOM</th>
                <th>AGE</th>
                <th>GENRE</th>
                <th>ADRESSE</th>
                <th>PARENT EN VIE</th>
                <th>DEPLACE OU REFUGIER</th>
                <th>HABITATION</th>
                <th>RANG FAMILLE D'ENFANT</th>

                <th>NOM PAPA </th>
                <th>NOM MAMAN</th>
                <th>NIVEAU D'INSTRUCTION PAPA</th>
                <th>NIVEAU D'INSTRUCTION MAMAN</th>

                <th>ETUDE</th>
                <th>NIVEAU D'ETUDE</th>
                <th>CHARGE FRAIS SCOLAIRE</th>
                <th>COMBINER TRAVAIL ETUDE</th>
                <th>HORAIRE</th>
                <th>FREQUENTATION</th>

                <th>ANNÉE DEBUT</th>
                <th>TRAVAIL ANTERIEURE</th>
                <th>AMENER PAR</th>
                <th>OCCUPATION DANS LA MINE</th>
                <th>MOTIVATION</th>
                <th>SATISFACTION </th>
                <th>MALADIE DANS LA MINE</th>
                <th>ACCIDENT DANS LA MINE</th>
                <th>CENTRE DE SANTE</th>
                <th>DISTANCE CENTRE DE SANTE-MAISON</th>
                <th>DISTANCE CENTRE DE SANTE-MINE</th>
                <th>PATRON</th>
                <th>VOULOIR ABANDONNER</th>
                <th>AUTRE ACTIVITE</th>
            </tr>
        </thead>
        <tbody>
            {{ dd($children) }}
            @foreach ($children->chunk(500) as $item)
                {{-- {{ dd($item->count()) }} --}}
                @foreach ($item as $child)
                    <tr>
                        <td>{{ $child->nom }}</td>
                        <td>{{ $child->age }}</td>
                        <td>{{ $child->genre == 'm' ? 'Masculin' : 'Feminin' }}</td>
                        <td>{{ $child->adresse }}</td>
                        <td>{{ $child->parent_vie == '1' ? 'oui' : 'non' }}</td>
                        <td>{{ $child->deplace == '1' ? 'oui' : 'non' }}</td>
                        <td>{{ $child->habitation }}</td>
                        <td>{{ $child->rang_famille }}</td>

                        <td>{{ $child->nom_pere }}</td>
                        <td>{{ $child->nom_mere }}</td>
                        <td>{{ $child->instruction_pere }}</td>
                        <td>{{ $child->instruction_mere }}</td>

                        <td>{{ $child->etude }}</td>
                        <td>{{ $child->niveauEtude }}</td>
                        <td>{{ $child->chargeFrais }}</td>
                        <td>{{ $child->travailEtude }}</td>
                        <td>{{ $child->horaire }}</td>
                        <td>{{ $child->frequentation }}</td>

                        <td>{{ $child->debut }}</td>
                        <td>{{ $child->travail_ant }}</td>
                        <td>{{ $child->ameneur }}</td>
                        <td>{{ $child->occupation }}</td>
                        <td>{{ $child->motivation }}</td>
                        <td>{{ $child->satisfaction }}</td>
                        <td>{{ $child->maladie }}</td>
                        <td>{{ $child->accident }}</td>
                        <td>{{ $child->soin }}</td>
                        <td>{{ $child->distance_soin }}</td>
                        <td>{{ $child->distance_mine }}</td>
                        <td>{{ $child->patron }}</td>
                        <td>{{ $child->abandonner }}</td>
                        <td>{{ $child->autre_activite }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
