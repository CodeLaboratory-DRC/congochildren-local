@extends('templates.app')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    PERE DE FAMILLE: <span class="text-capitalize"> {{ $family->nomPere }}</span> <br>
                    MERE DE FAMILLE: <span class="text-capitalize"> {{ $family->nomMere }}</span> <br>
                    <hr>
                    PROFIL INTELLECTUEL : <br>
                    <p>
                        Pere: <span class="text-capitalize"> {{ $family->profilPere }}</span> <br>
                        Mere: <span class="text-capitalize"> {{ $family->profilMere }}</span>
                    </p>
                </h4>
                <p class="card-description">
                    Détails de la famille
                </p>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive pt-3">
                            <p class="text-uppercase">ENFANTS</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Post-nom</th>
                                        <th>Prénom</th>
                                        <th>Age</th>
                                        <th>Genre</th>
                                        <th>Enqueteur</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\Enfant::getByFamilly($family->id) as $child)
                                        <tr>
                                            <td>{{ $child->initial }}</td>
                                            <td>{{ $child->nom }}</td>
                                            <td>{{ $child->postnom }}</td>
                                            <td>{{ $child->prenom }}</td>
                                            <td>{{ $child->age }}ans</td>
                                            <td>{{ ($child->sexe == 'm') ? 'Masculin' : 'Feminin' }}</td>
                                            <td>
                                            {{ App\Models\User::getName($child->users_id); }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Frais">
                                                    <a href='{{ url("children/$child->id/fiche")}}' class="btn btn-sm btn-primary">
                                                        <i class="ti-file">Accèder aux Détails</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection