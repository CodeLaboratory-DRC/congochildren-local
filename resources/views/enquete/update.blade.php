@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification de l'enquete de: <b>{{ $enfant->nom }}</b> </h4>
                    @if (session('success'))
                        <div class="alert alert-success text-center msg" id="error">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger text-center msg" id="error">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                    <form class="forms-sample" method="POST" action="{{ route('enquete.update', $enquete->id) }}">
                        @csrf
                        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="debut" class="col-sm-3 col-form-label">Année du début du travail dans la
                                            mine</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="debut" value="{{ $enquete->debut }}"
                                                class="form-control" id="debut"
                                                placeholder="Inserer l'Année du début du travail dans la mine">
                                            @error('debut')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="travail_ant" class="col-sm-3 col-form-label">Travail antérieur dans
                                            d'autres mines</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="travail_ant" value="{{ $enquete->travail_ant }}"
                                                class="form-control" id="debut"
                                                placeholder="Travail antérieur dans d'autres mines">
                                            @error('travail_ant')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ameneur" class="col-sm-3 col-form-label text-lowercase">LA PERSONNE QUI
                                            A AMENE L'ENFANT DANS LA MINE</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="ameneur" id="ameneur" required>
                                                <option selected disabled value="">Selectionner la personne</option>
                                                <option @if ($enquete->ameneur == 'Père') selected @endif>Père</option>
                                                <option @if ($enquete->ameneur == 'Mère') selected @endif>Mère</option>
                                                <option @if ($enquete->ameneur == 'Membre de la famille') selected @endif>Membre de la famille</option>
                                                <option @if ($enquete->ameneur == "Influence d'autres enfants") selected @endif>Influence d'autres enfants</option>
                                                <option @if ($enquete->ameneur == 'Autre') selected @endif>Autre</option>
                                            </select>
                                            @error('ameneur')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="occupation" class="col-sm-3 col-form-label text-lowercase">OCCUPATIONS
                                            DE L'ENFANT DANS LA MINE</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="occupation" id="occupation" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->occupation == 'Creuseur') selected @endif>Creuseur</option>
                                                <option @if ($enquete->occupation == 'Trieur') selected @endif>Trieur</option>
                                                <option @if ($enquete->occupation == 'Ramasseur') selected @endif>Ramasseur</option>
                                                <option @if ($enquete->occupation == 'Vendeur / vendeuse') selected @endif>Vendeur / vendeuse</option>
                                                <option @if ($enquete->occupation == 'Débrouillard / débrouillarde') selected @endif>Débrouillard / débrouillarde</option>
                                                <option @if ($enquete->occupation == 'Tamiseur') selected @endif>Tamiseur</option>
                                                <option @if ($enquete->occupation == 'Transporteur') selected @endif>Transporteur</option>
                                                <option @if ($enquete->occupation == 'Concasseur') selected @endif>Concasseur</option>
                                                <option @if ($enquete->occupation == 'Autres') selected @endif>Autres</option>
                                            </select>
                                            @error('occupation')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="motivation" class="col-sm-3 col-form-label text-lowercase">MOTIVATION DE
                                            CHOIX DE L'OCCUPATION</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="motivation" id="motivation" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->motivation == 'Paie mieux') selected @endif>Paie mieux</option>
                                                <option @if ($enquete->motivation == 'Occupation intéressant les enfants') selected @endif>Occupation intéressant les enfants
                                                </option>
                                                <option @if ($enquete->motivation == "Nécessite moins d'effort") selected @endif>Nécessite moins d'effort</option>
                                                <option @if ($enquete->motivation == 'Sans alternative') selected @endif>Sans alternative</option>
                                                <option @if ($enquete->motivation == 'Autres motifs') selected @endif>Autres motifs</option>
                                            </select>
                                            @error('motivation')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="satisfaction"
                                            class="col-sm-3 col-form-label text-lowercase">SATISFACTION DU TRAVAIL DANS LA
                                            MINE</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="satisfaction" id="satisfaction" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option value="NULL" @if ($enquete->satisfaction == null) selected @endif>Non</option>
                                                <option @if ($enquete->satisfaction == 'Subvenir aux besoins du ménage') selected @endif>Subvenir aux besoins du ménage</option>
                                                <option @if ($enquete->satisfaction == 'Subvenir aux besoins Scolarité') selected @endif>Subvenir aux besoins Scolarité</option>
                                                <option @if ($enquete->satisfaction == "Subvenir aux besoins de l'alimentation") selected @endif>Subvenir aux besoins de l'alimentation
                                                </option>
                                                <option @if ($enquete->satisfaction == 'Subvenir aux besoins sanitaires') selected @endif>Subvenir aux besoins sanitaires</option>
                                                <option @if ($enquete->satisfaction == 'Autres motifs') selected @endif>Autres motifs</option>
                                            </select>
                                            @error('satisfaction')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="maladie" class="col-sm-3 col-form-label text-lowercase">MALADIES QUI
                                            AFFECTENT SOUVENT DANS LA MINE</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="maladie" id="maladie" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->maladie == 'Maladies de la peau') selected @endif>Maladies de la peau</option>
                                                <option @if ($enquete->maladie == 'Atteinte pulmonaire') selected @endif>Atteinte pulmonaire</option>
                                                <option @if ($enquete->maladie == 'IRA (Infections respiratoires aigües)') selected @endif>IRA (Infections respiratoires aigües)
                                                </option>
                                                <option @if ($enquete->maladie == 'Hernie') selected @endif>Hernie</option>
                                                <option @if ($enquete->maladie == 'IST/MST') selected @endif>IST/MST</option>
                                                <option @if ($enquete->maladie == 'VIH/SIDA') selected @endif>VIH/SIDA</option>
                                                <option @if ($enquete->maladie == 'Diarrhée') selected @endif>Diarrhée</option>
                                                <option @if ($enquete->maladie == 'Fièvre typhoïde') selected @endif>Fièvre typhoïde</option>
                                                <option @if ($enquete->maladie == 'Autres') selected @endif>Autres</option>
                                            </select>
                                            @error('maladie')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 offset-md-1">
                                    <div class="form-group row">
                                        <label for="accident" class="col-sm-4 col-form-label text-lowercase">ACCIDENTS
                                            RENCONTRES DANS LA MINE</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="accident" id="accident" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->accident == 'Eboulement de terre') selected @endif>Eboulement de terre</option>
                                                <option @if ($enquete->accident == 'Accidents de circulation routière') selected @endif>Accidents de circulation routière</option>
                                                <option @if ($enquete->accident == 'Accident de travail') selected @endif>Accident de travail</option>
                                                <option @if ($enquete->accident == 'Autres') selected @endif>Autres</option>
                                            </select>
                                            @error('accident')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="soin" class="col-sm-4 col-form-label text-lowercase">LIEU OU VOUS VOUS FAITES SOIGNER</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="soin" id="soin" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->soin == 'Hôpital') selected @endif>Hôpital</option>
                                                <option @if ($enquete->soin == 'Centre de santé') selected @endif>Centre de santé</option>
                                                <option @if ($enquete->soin == 'Dispensaire') selected @endif>Dispensaire</option>
                                                <option @if ($enquete->soin == 'Tradipraticien') selected @endif>Tradipraticien</option>
                                                <option @if ($enquete->soin == 'Chambre de prière') selected @endif>Chambre de prière</option>
                                                <option @if ($enquete->soin == 'Automédication') selected @endif>Automédication</option>
                                                <option @if ($enquete->soin == 'Autres') selected @endif>Autres</option>
                                            </select>
                                            @error('soin')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="distance_soin" class="col-sm-4 col-form-label text-lowercase">DISTANCE SEPARANT LE MENAGE ET LE CENTRE DE SANTE</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="distance_soin" id="distance_soin" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->distance_soin == '0 à 5Km') selected @endif>0 à 5Km</option>
                                                <option @if ($enquete->distance_soin == '5 à 10Km') selected @endif>5 à 10Km</option>
                                                <option @if ($enquete->distance_soin == '10 à 15Km') selected @endif>10 à 15Km</option>
                                                <option @if ($enquete->distance_soin == '15 à 20Km') selected @endif>15 à 20Km</option>
                                                <option @if ($enquete->distance_soin == '20 à 25Km') selected @endif>20 à 25Km</option>
                                                <option @if ($enquete->distance_soin == 'PLUS') selected @endif>PLUS</option>
                                            </select>
                                            @error('distance_soin')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="distance_mine" class="col-sm-4 col-form-label text-lowercase">DISTANCE SEPARANT LE MENAGE ET LA MINE</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="distance_mine" id="distance_mine" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->distance_soin == '0 à 5Km') selected @endif>0 à 5Km</option>
                                                <option @if ($enquete->distance_soin == '5 à 10Km') selected @endif>5 à 10Km</option>
                                                <option @if ($enquete->distance_soin == '10 à 15Km') selected @endif>10 à 15Km</option>
                                                <option @if ($enquete->distance_soin == '15 à 20Km') selected @endif>15 à 20Km</option>
                                                <option @if ($enquete->distance_soin == '20 à 25Km') selected @endif>20 à 25Km</option>
                                                <option @if ($enquete->distance_soin == 'PLUS') selected @endif>PLUS</option>
                                            </select>
                                            @error('distance_mine')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="patron" class="col-sm-4 col-form-label text-lowercase"> POUR QUI TRAVAILLEZ-VOUS ?</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="patron" id="patron" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->patron == 'Négociant') selected @endif>Négociant</option>
                                                <option @if ($enquete->patron == 'Soit même') selected @endif>Soit même</option>
                                                <option @if ($enquete->patron == 'Membre de Famille') selected @endif>Membre de Famille</option>
                                                <option @if ($enquete->patron == 'Multinational') selected @endif>Multinational</option>
                                                <option @if ($enquete->patron == 'Autres') selected @endif>Autres</option>
                                            </select>
                                            @error('patron')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="abandonner" class="col-sm-4 col-form-label text-lowercase"> PENSÉ A ABANDONNER LE TRAVAIL DES MINES ?</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="abandonner" id="abandonner" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option value="NULL" @if ($enquete->abandonner == NULL) selected @endif>Non</option>
                                                <option @if ($enquete->abandonner == 'Travail pénible') selected @endif>Travail pénible</option>
                                                <option @if ($enquete->abandonner == 'Travail moins payant') selected @endif>Travail moins payant</option>
                                                <option @if ($enquete->abandonner == 'Travail non conforme à mon Age') selected @endif>Travail non conforme à mon Age</option>
                                                <option @if ($enquete->abandonner == 'Travail sans avenir') selected @endif>Travail sans avenir</option>
                                                <option @if ($enquete->abandonner == 'Autres') selected @endif>Autres</option>
                                            </select>
                                            @error('abandonner')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="autre_activite" class="col-sm-4 col-form-label text-lowercase">QUELLE AUTRE ACTIVITE A LA PLACE DU TRAVAIL DANS LES MINES</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="autre_activite" id="autre_activite" required>
                                                <option selected disabled value="">Selectionner la valeur</option>
                                                <option @if ($enquete->autre_activite == 'Agriculture') selected @endif>Agriculture</option>
                                                <option @if ($enquete->autre_activite == 'Pêche ou Elevage') selected @endif>Pêche ou Elevage</option>
                                                <option @if ($enquete->autre_activite == 'Commerce') selected @endif>Commerce</option>
                                                <option @if ($enquete->autre_activite == 'Ecole') selected @endif>Ecole</option>
                                                <option @if ($enquete->autre_activite == 'Formation professionnelle') selected @endif>Formation professionnelle</option>
                                                <option @if ($enquete->autre_activite == 'Autres') selected @endif>Autres</option>
                                            </select>
                                            @error('autre_activite')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-block btn-primary">Mettre a jour</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
