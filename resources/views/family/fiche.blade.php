@extends('templates.app')
@section('content')

<!-- partial -->
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="card">
            <div class="card-body">
              <div class="faq-section">
                <div class="col-lg-8 ps-0">
                  <h4 class="text-right my-7">
                      Numéro de la fiche : <b class="text-uppercase"> 0115{{ $family->id }}</b> <br> <br>
                      la contree de la mine ou du site minier concerne :<b class="text-capitalize"> {{ $family->nomSite }}</b> <br> <br>
                      Identification faite par : <b class="text-capitalize"> {{ App\Models\User::getName($family->user_id) }}</b> <br> <br>

                  </h4>
                </div>
              <div class="faq-section">
                <div class="container-fluid bg-primary py-2">
                  <p class="mb-0 text-white rounded"> <b>FAMILLE</b>
                  </p>
                </div>
                <div id="accordion-1" class="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        Nom du pere:
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class=" text-dark"> <br>
                            <span class="text-uppercase">{{ $family->nom_pere}}</span>
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Nom du mere:
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class=" text-dark"> <br>
                            <span class="text-uppercase">{{ $family->nom_mere}}</span>
                           <br>
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Niveau d'instruction du pere :
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class=" text-dark"> <br>
                            <span class="text-uppercase">{{ $family->instruction_pere}}</span>
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Niveau d'instruction de la mere :
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class=" text-dark"> <br>
                            <span class="text-uppercase">{{ $family->instruction_mere}}</span>
                           <br>
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        État matrimonial :
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class="text-uppercase text-dark"> <br>
                             {{ $family->matrimonial}}
                        </a>
                      </h5> <hr>
                      
                      <h5 class="mb-0">
                        Nombre total des enfants
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class=" text-dark"> <br>
                             {{ $family->nb_enfant}} enfant(s)
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Nombre des garcons : 
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class=" text-dark"> <br>
                          {{ $family->nb_homme}} garcons                
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Nombre des filles :
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class=" text-dark"> <br>
                          {{ $family->nb_femme}} filles
                           <br>
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Activité principale : 
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class="text-uppercase text-dark"> <br>
                            {{ $family->activite_princ}}
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Activité secondaire :
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class="text-uppercase text-dark"> <br>
                             {{ $family->activite_sec}}
                        </a>
                      </h5> <hr>
                      <h5 class="mb-0">
                        Revénu journalier :
                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" class="text-uppercase text-dark"> <br>
                             {{ $family->revenu_jour}}
                        </a>
                      </h5> <hr>
                    </div>
                  </div>
                </div>
              </div>
              <div class="faq-section">   
                <div class="container-fluid bg-primary py-2">
                  <p class="mb-0 text-white rounded text-uppercase"> <b>enfant(s) enregistré(s)</b>
                  </p>
                </div>   
                <div id="accordion-1" class="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Age</th>
                                    <th>Genre</th>
                                    <th>Instruction</th>
                                    <th>Action</th>
          
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($child as $children)
                                    <tr>
                                        <td>
                                            @if($children->age > 17)
                                                0115{{ $children->id }}
                                            @else
                                                0114{{ $children->id }}
                                            @endif
                                        </td>
                                        <td>{{ $children->nom }}</td>
                                        <td>{{ $children->age }} ans</td>
                                        <td>{{ ($children->genre == 'm') ? 'Masculin' : 'Feminin' }}</td>
                                        <td>
                                            @if($children->etude)
                                                {{ $children->niveauEtude }}
                                            @else
                                                Non instruit
                                            @endif
                                        </td>
                                        <td>
                                        <div class="btn-group" role="group" aria-label="details enfant">
                                            @if($children->age > 17)
                                                <a href='{{ url("young/$children->id/fiche")}}' class="btn btn-sm btn-primary">
                                                    <i class="ti-file text-white">Accèder aux Détails</i>
                                                </a>
                                            @else
                                                <a href='{{ url("children/$children->id/fiche")}}' class="btn btn-sm btn-primary">
                                                    <i class="ti-file text-white">Accèder aux Détails</i>
                                                </a>
                                            @endif
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