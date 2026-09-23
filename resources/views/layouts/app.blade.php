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
          <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
          <span class="brand-copy">
            <span class="brand-title">{{ config('app.name', 'adminHMD') }}</span>
            <span class="brand-subtitle">Admin Template</span>
          </span>
        </a>
      </div>

      <nav class="sidebar-nav">
        <a class="nav-link" href="{{ route('usuarios.index') }}">
          <span class="nav-icon"><img src="{{ asset('assets/images/png/add-group.png') }}" alt="Adicionar grupo"></span>
          <!-- <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span> -->
          <span class="nav-text">Usuário</span>
        </a>
        <a class="nav-link" href="{{ route('profissionais.index') }}">
          <span class="nav-icon"><img src="{{ asset('assets/images/png/folder (1).png') }}" alt="Pasta"></span>
          <!-- <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span> -->
          <span class="nav-text">Profissionais</span>
        </a>
        <a class="nav-link" href="{{ route('exercicios.index') }}">
          <span class="nav-icon"><img src="{{ asset('assets/images/png/fitness (2).png') }}" alt="Exercícios"></span>
          <!-- <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span> -->
          <span class="nav-text">Exercícios</span> 
        </a>
        <a class="nav-link" href="{{ route('fichas-esportivas.index') }}">
          <span class="nav-icon"><img src="{{ asset('assets/images/png/report (2).png') }}" alt="Relatórios"></span>
          <!-- <span class="nav-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span> -->
          <span class="nav-text">Fichas esportivas  </span>
        </a>
        <a class="nav-link" href="{{ route('planos.index') }}"> 
          <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
          <span class="nav-text">Planos</span>
        </a>
        <a class="nav-link" href="{{ route('parceiros.index') }}">
          <span class="nav-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
          <span class="nav-text">Parceiros</span>
        </a>
        <a class="nav-link" href="{{ route('matriculas.index') }}">
          <span class="nav-icon"><i class="bi bi-ui-checks-grid" aria-hidden="true"></i></span>
          <span class="nav-text">Matrículas</span> 
        </a>
        <a class="nav-link" href="{{ route('treinos.index') }}">
          <span class="nav-icon"><i class="bi bi-grid-3x3-gap" aria-hidden="true"></i></span>
          <span class="nav-text">Treinos</span>
        </a>
</a Class="nav-link" href="{{ route('aulas.index') }}">
          <span class="nav-icon"><i class="bi bi-grid-3x3-gap" aria-hidden="true"></i></span>
          <span class="nav-text">Aulas</span>
        </a>

      </nav>

      <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar" src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="Admin">
        <strong>Admin</strong>
        <small>Active Workspace</small>
      </div>

      <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
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

          <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
            <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
          </form>

          <div class="navbar-actions ms-auto">
            <button class="icon-button theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
              <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
            </button>
            <div class="dropdown">
              <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                <span class="notification-dot"></span>
                <i class="bi bi-bell" aria-hidden="true"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end notification-menu">
                <div class="dropdown-header fw-bold text-body">Notifications</div>
              </div>
            </div>

            <div class="dropdown">
              <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="avatar-img avatar-sm" src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="Admin">
                <span class="profile-name d-none d-sm-inline">Admin</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Account settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
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
