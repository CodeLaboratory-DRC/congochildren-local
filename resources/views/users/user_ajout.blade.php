@extends('templates.app')
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Ajouter un utilisateur
                </h4>
                
                <form class="forms-sample" method="POST" action="{{ route('user.post') }}">
                    @csrf
                          <div>
                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label for="exampleInputName1" class="col-sm-3 col-form-label">Nom </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="exampleInputName1" placeholder="Inserer le nom complet" required>
                                        @error('nom')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label  for="exampleInputName1" class="col-sm-3 col-form-label">E-mail</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputName1" placeholder="Inserer l'adresse mail" required>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                      <label for="exampleInputName1" class="col-sm-3 col-form-label">Téléphone</label>
                                      <div class="col-sm-9">
                                            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" id="exampleInputName1" placeholder="Inserer le numéro de téléphone" required>
                                            @error('phone')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label for="exampleInputName1" class="col-sm-3 col-form-label">Adresse physique</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="adresse" value="{{ old('adresse') }}" class="form-control" id="exampleInputName1" placeholder="Inserer l'adress physique" required>
                                        @error('adresse')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label for="exampleInputName1" class="col-sm-3 col-form-label">Activités primaires</label>
                                  <div class="col-sm-9">
                                        <input type="text" name="activite" value="{{ old('activite') }}" class="form-control" id="exampleInputName1" placeholder="Inserer les activités primaires" required>
                                        @error('activite')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label" for="exampleInputName1">Niveau d'accès</label>
                                  <div class="col-sm-9">
                                    <select class="form-control" name="access" required>
                                        <option selected disabled value="">Selectionner le niveau d'acces</option>
                                        @if (auth()->user()->access == 'adminCentral')
                                            <option value="adminCentral">Administrateur central</option>
                                        @endif
                                        <option value="adminLocal">Administrateur local</option>
                                        <option value="agentTerrain">Agent de terrain</option>
                                    </select>
                                    @error('access ')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="exampleInputName1">Province</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="province" required>
                                                <option selected disabled value=""selected disabled value="">Selectionner la province</option>
                                                <option value="haut-katanga">haut-katanga</option>
                                                <option value="lualaba">lualaba</option>
                                            </select>
                                            @error('province')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="exampleInputName1">Mot de passe par defaut</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="password" class="form-control" id="exampleInputName1" value="Kongo-{{ date('Y') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary ">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

