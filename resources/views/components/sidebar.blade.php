<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 220px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{asset('images/logo_black.png')}}" height="30px" alt="Logo - SisRG">
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link text-white btn btn-primary text-start">
                <i class="bi bi-bar-chart mx-2 fs-5 align-middle"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('funcionarios.index') }}" class="nav-link text-white btn btn-primary text-start">
                <i class="bi bi-people mx-2 fs-5 align-middle"></i>Funcionários
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cargos.index') }}" class="nav-link text-white btn btn-primary text-start">
                <i class="bi bi-person-vcard mx-2 fs-5 align-middle"></i>Cargos
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('departamentos.index') }}" class="nav-link text-white btn btn-primary text-start">
                <i class="bi bi-house-check mx-2 fs-5 align-middle"></i>Departamentos
            </a>
        </li>
        @can('tipo-user')
        <li class="nav-item">
            <a href="{{  route('users.index') }}" class="nav-link text-white btn btn-primary text-start">
                <i class="bi bi-people mx-2 fs-5 align-middle"></i>Usuários
            </a>
        </li>
        @endcan

        <li class="nav-item">
            <a href="{{ route('beneficios.index') }}" class="nav-link text-white btn btn-primary text-start">
                <i class="bi bi-star mx-2 fs-5 align-middle"></i>Benefícios
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ auth()->user()->name}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}">Alterar dados</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('login.logout') }}">Sair</a></li>
        </ul>
    </div>
</div>
