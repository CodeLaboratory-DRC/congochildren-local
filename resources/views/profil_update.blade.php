@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification du profil </h4>

                    <form class="forms-sample" method="POST" action="{{ route('profil.update') }}">
                        @csrf
                        <input type="text" name="users_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nom </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="form-control" id="name" placeholder="Inserer le nom complet">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Adresse E-mail</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                class="form-control" id="email" placeholder="Inserer l'adresse e-mail">
                                                @error('email')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">Téléphone</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone" value="{{ $user->phone }}"
                                                class="form-control" id="phone"
                                                placeholder="Inserer le numéro de téléphone">
											@error('phone')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="adresse" class="col-sm-3 col-form-label">Adresse physique</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="adresse" value="{{ $user->adresse }}"
                                                class="form-control" id="adresse"
                                                placeholder="Inserer l'adresse physique">
											@error('adresse')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="activite" class="col-sm-3 col-form-label">Activités Principal</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="activite" value="{{ $user->activite }}"
                                                class="form-control" id="activite"
                                                placeholder="Inserer l'activité principal">
											@error('activite')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
									<div class="text-center">
										<button type="submit" class="btn btn-primary ">Mettre a jour</button>
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
