@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('search') }}" method="GET">
                                <div class="form-group d-flex">
                                    <input type="text" name="query" class="form-control" placeholder="Votre terme de recherche ici">
                                    <select name="type" class="form-control ms-3" id="exampleSelectGender">
                                        <option value="children">Enfants</option>
                                        <option value="agricole">Coopératives agricole</option>
                                        <option value="miniere">Coopératives minières</option>
                                        <option value="site">Site miniere</option>
                                        <option value="parent">Parents</option>
                                        <option value="agent">Utilisateur</option>
                                      </select>
                                    <button type="submit" class="btn btn-primary ms-3">Rechercher</button>
                                </div>
                            </form>
                        </div>
                            
                        @if(null !== Request::get('query'))
                            <div class="col-12 mb-5">
                                <h2>Resultat de recherche pour<u class="ms-2">"{{ Request::get('query') }}"</u></h2>
                                {{-- <p class="text-muted">About 12,100 results (0.52 seconds)</p> --}}
                            </div>
                            <div class="col-12 results">
                                @isset ($results)
                                    @forelse ($results as $result)
                                        <div class="pt-4 border-bottom">
                                            <a class="d-block h4" href="#">{{ $result->nom }}{{ $result->postnom }}{{ $result->prenom }}</a>
                                            Dans <a class="page-url text-primary" href="#">Enfant</a>
                                            <p class="page-description mt-1 w-75 text-muted">
                                                Site de: {{ $result->site }} <br>
                                                Localite: {{ $result->localite }} <br>
                                                Province: {{ $result->province }}
                                            </p>
                                        </div>
                                    @empty
                                        <h4>Votre terme de recherche ne correspond à aucune de nos données dans la catégorie: <b>Enfant</b></h4>
                                    @endforelse
                                    
                                    @if (!empty($result))
                                        {{ $results->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                                    @endif
                                @else
                                    <h4>Votre terme de recherche ne correspond à aucune de nos données dans la catégorie: <b>Enfant</b></h4>
                                @endisset
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
