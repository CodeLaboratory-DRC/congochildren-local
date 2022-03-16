<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ route('home') }}">
                    <img src="{{ asset('images/kongo_children_logo.jpeg') }}" class="mr-2" alt="logo" />
                </a>
                <span class="mx-1"> </span>
                <a class="navbar-brand brand-logo mr-5" href="{{ route('home') }}">
                    <img src="{{ asset('images/cd.svg') }}" class="mr-2" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
                    <img src="{{ asset('images/kongo_children_logo.jpeg') }}" alt="logo" />
                </a>
                {{-- <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
                    <img src="{{ asset('images/cd.svg') }}" alt="logo" />
                </a> --}}
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <form action="{{ route('search') }}" method="GET">
                                <input name="query" type="text" class="form-control" id="navbar-search-input"
                                    placeholder="Rechercher maintenant" aria-label="search" aria-describedby="search">
                            </form>
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="{{ asset('images/faces/undraw_profile.svg') }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a href="#" class="dropdown-item">
                                <i class="ti-user text-primary"></i>
                                <h4 class="text-capitalize">{{ auth()->user()->name }}</h4>
                            </a>
                            <a href="{{ route('profil') }}" class="dropdown-item">
                                <i class="ti-settings text-primary"></i>
                                Mon Profil
                            </a>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                                <i class="ti-power-off text-primary"></i>
                                Me deconnecter
                            </a>
                            <form id="logout_form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="horizontal-menu-toggle">
                    <span class="ti-menu"></span>
                </button>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="icon-bar-graph menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link">
                        <i class="icon-head menu-icon"></i>
                        <span class="menu-title">Enfants</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <div class="submenu-item">
                            <ul class="submenu-item">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('children.list') }}">
                                        Liste des enfants
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('young.list') }}">
                                        Liste des jeunes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('menage.list') }}">
                                        Liste des menages
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link">
                        <i class="icon-head menu-icon"></i>
                        <span class="menu-title">Coopératives agricoles</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <div class="submenu-item">
                            <ul class="submenu-item">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('agricole.list') }}">
                                        Liste des coopératives agricoles
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link">
                        <i class="icon-head menu-icon"></i>
                        <span class="menu-title">Coopératives minières</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <div class="submenu-item">
                            <ul class="submenu-item">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mine.list') }}">
                                        Liste des coopératives minières
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link">
                        <i class="icon-head menu-icon"></i>
                        <span class="menu-title"> Structures</span>
                        <i class="menu-arrow"></i>  
                    </a>
                    <div class="submenu">
                        <div class="submenu-item">
                            <ul class="submenu-item">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('fournisseur.list', 'fournisseur') }}">
                                        Fournisseurs des materiaux de construction 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('fournisseur.list', 'agrobusiness') }}">
                                        Structures privées oeuvrant en agrobusiness 
                                    </a>
                                </li>
                            </ul>
                        </div>  
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('localite.list') }}">
                        <i class="icon-cog menu-icon"></i>
                        <span class="menu-title">Localités</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recherche') }}">
                        <i class="icon-search menu-icon"></i>
                        <span class="menu-title">Recherche avec filtre</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link">
                        <i class="icon-head menu-icon"></i>
                        <span class="menu-title">Utilisateurs</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="{{ route('user') }}">Ajouter un
                                    utilisateur</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('agent.list') }}">Liste des
                                    utilisateurs</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
