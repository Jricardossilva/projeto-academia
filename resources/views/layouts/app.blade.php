<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name', 'adminHMD'))</title>

  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="#" aria-label="{{ config('app.name', 'adminHMD') }}">
          <span class="brand-icon"><img src="{{ asset('assets/images/png/logo123.png') }}" alt="{{ config('app.name', 'adminHMD') }}" width="30" height="30"></span>
          <span class="brand-copy">
            <span class="brand-title">{{ config('app.name', 'adminHMD') }}</span>
            @php 
              $tipo = auth()->user()?->tipo; 
              $nomeUsuario = auth()->user()?->nome;
            @endphp
            <span class="brand-subtitle">{{ $tipo }}</span>
          </span>
        </a>
      </div>

      <nav class="sidebar-nav">

        @if ($tipo === 'aluno')
          <a class="nav-link" href="{{ route('usuarios.show', auth()->id()) }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/usuarios.png') }}" alt="Adicionar grupo" width="16" height="16">
            </span>
            <span class="nav-text">Minha área</span>
          </a>
        @endif

        @if (in_array($tipo, ['admin', 'professor', 'convidado']))
          <a class="nav-link" href="{{ route('usuarios.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/usuarios.png') }}" alt="Adicionar grupo" width="16" height="16">
            </span>
            <span class="nav-text">Usuário</span>
          </a>
          <a class="nav-link" href="{{ route('professores.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/professores.png') }}" alt="Professores" width="16" height="16">
            </span>
            <span class="nav-text">Professores</span>
          </a>
          <a class="nav-link" href="{{ route('exercicios.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/exercicios.png') }}" alt="Exercícios" width="16" height="16">
            </span>
            <span class="nav-text">Exercícios</span>
          </a>
          <a class="nav-link" href="{{ route('fichas-esportivas.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/fichasesportivas.png') }}" alt="Relatórios" width="16" height="16">
            </span>
            <span class="nav-text">Fichas esportivas  </span>
          </a>
          <a class="nav-link" href="{{ route('avaliacoes.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/avaliacoes.png') }}" alt="Avaliações" width="16" height="16">
            </span>
            <span class="nav-text">Avaliações</span>
          </a>
          <a class="nav-link" href="{{ route('treinos.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/treinos.png') }}" alt="Treinos" width="16" height="16">
            </span>
            <span class="nav-text">Treinos</span>
          </a>
          <a class="nav-link" href="{{ route('aulas.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/aulas.png') }}" alt="Aulas" width="16" height="16">
            </span>
            <span class="nav-text">Aulas</span>
          </a>
        @endif

        @if (in_array($tipo, ['admin', 'convidado']))
          <a class="nav-link" href="{{ route('profissionais.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/profissionais.png') }}" alt="Pasta" width="16" height="16">
            </span>
            <span class="nav-text">Profissionais</span>
          </a>
          <a class="nav-link" href="{{ route('planos.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/planos.png') }}" alt="Planos" width="16" height="16">
            </span>
            <span class="nav-text">Planos</span>
          </a>
          <a class="nav-link" href="{{ route('parceiros.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/parceiros.png') }}" alt="Parceiros" width="16" height="16">
            </span>
            <span class="nav-text">Parceiros</span>
          </a>
          <a class="nav-link" href="{{ route('matriculas.index') }}">
            <span class="nav-icon">
              <img src="{{ asset('assets/images/png/matriculas.png') }}" alt="Matrículas" width="16" height="16">
            </span>
            <span class="nav-text">Matrículas</span>
          </a>
        @endif
      </nav>

      <script>
        window.adminHMDUser = {
          name: @json(auth()->user()?->nome ?? ''),
          workspace: @json(auth()->user()?->nome ?? ''),
          avatar: null
        };
        </script>
        <div class="sidebar-user">
       
          <span class= "avatar-initial avatar-md sidebar-user-avatar" aria-hidden="true">{{ substr($nomeUsuario, 0, 1) }}</span>
          <div>
          <small>{{ $nomeUsuario }}</small>
          </div>
        </div>


      <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">Em execução</span>
      </div>
    </aside>

    <div class="admin-main">
      <nav class="navbar admin-navbar navbar-expand bg-white">
        <div class="container-fluid px-3 px-lg-4">
          <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle sidebar">
            <span></span>
            <span></span>
            <span></span>
          </button>

        
            
          

          <div class="navbar-actions ms-auto">
            <button class="icon-button theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
              <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
            </button>
            

            <div class="dropdown">
              <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                <span class="avatar-img avatar-sm" aria-hidden="true">{{ substr($nomeUsuario, 0, 1) }}</span>
                
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form method="POST" action="{{ route('login.destroy') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Sair</button>
                    </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          @yield('content')
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>{{ config('app.name', 'adminHMD') }}</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
