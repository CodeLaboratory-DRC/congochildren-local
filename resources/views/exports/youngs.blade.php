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

                <th>ÉTAT CIVIL</th>
                <th>CONJOINT</th>
                <th>NOMBRE D'ENFANTS</th>
                <th>NOMBRE DES GARCONS</th>
                <th>NOMBRE DES FILLES</th>
                <th>NOMBRE D'ENFANTS SCOLARISES</th>

            </tr> 
        </thead>
        <tbody>
            @foreach($youngers as $young)
                <tr>
                    <td>{{ $young->nom }}</td>
                    <td>{{ $young->age }}</td>
                    <td>{{ ($young->genre == 'm') ? 'Masculin' : 'Feminin' }}</td>
                    <td>{{ $young->adresse }}</td>
                    <td>{{ ($young->parent_vie == '1') ? 'oui' : 'non' }}</td>
                    <td>{{ ($young->deplace == '1') ? 'oui' : 'non' }}</td>
                    <td>{{ $young->habitation }}</td>
                    <td>{{ $young->rang_famille }}</td>
                    
                    <td>{{ $young->nom_pere }}</td>
                    <td>{{ $young->nom_mere }}</td>
                    <td>{{ $young->instruction_pere }}</td>
                    <td>{{ $young->instruction_mere }}</td>
                    
                    <td>{{ $young->etude }}</td>
                    <td>{{ $young->niveauEtude }}</td>
                    <td>{{ $young->chargeFrais }}</td>
                    <td>{{ $young->travailEtude }}</td>
                    <td>{{ $young->horaire }}</td>
                    <td>{{ $young->frequentation }}</td>

                    <td>{{ $young->debut }}</td>
                    <td>{{ $young->travail_ant }}</td>
                    <td>{{ $young->ameneur }}</td>
                    <td>{{ $young->occupation }}</td>
                    <td>{{ $young->motivation }}</td>
                    <td>{{ $young->satisfaction }}</td>
                    <td>{{ $young->maladie }}</td>
                    <td>{{ $young->accident }}</td>
                    <td>{{ $young->soin }}</td>
                    <td>{{ $young->distance_soin }}</td>
                    <td>{{ $young->distance_mine }}</td>
                    <td>{{ $young->patron }}</td>
                    <td>{{ $young->abandonner }}</td>
                    <td>{{ $young->autre_activite }}</td>

                    <td>{{ $young->etat_civil }}</td>
                    <td>{{ $young->coinjoint }}</td>
                    <td>{{ $young->nb_enfant }}</td>
                    <td>{{ $young->nb_garcon }}</td>
                    <td>{{ $young->nb_fille }}</td>
                    <td>{{ $young->nb_scolarise }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

