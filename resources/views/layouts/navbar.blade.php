<nav class="navbar admin-navbar navbar-expand bg-white">
  <div class="container-fluid px-3 px-lg-4">
    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle sidebar">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
      <input class="form-control search-input" type="search" placeholder="Search users, orders, reports" aria-label="Search">
    </form>

    <div class="navbar-actions ms-auto">

      {{-- Thème --}}
      <button class="icon-button theme-toggle" type="button"
        data-theme-toggle aria-label="Changer le thème" title="Changer le thème">
        <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
      </button>

      {{-- Notifications --}}
      <div class="dropdown">
        <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
          <span class="notification-dot"></span>
          <i class="bi bi-bell" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end notification-menu">
          <div class="dropdown-header fw-bold text-body">Notifications</div>
          <a class="dropdown-item" href="#">
            <span class="notification-title">Nouveau congé en attente</span>
            <span class="notification-time">À traiter</span>
          </a>
        </div>
      </div>

      {{-- Profil --}}
      <div class="dropdown">
        <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="avatar-img avatar-sm" src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="{{ auth()->user()->name }}">
          <span class="profile-name d-none d-sm-inline">{{ auth()->user()->name }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <span class="dropdown-item text-muted">
              <i class="bi bi-shield me-1"></i>
              @if(auth()->user()->isAdmin())
                Administrateur
              @else
                Gestionnaire
              @endif
            </span>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Account settings</a></li>
          <li><hr class="dropdown-divider"></li>

          {{-- ✅ Bouton Sign out fonctionnel --}}
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger">
                <i class="bi bi-box-arrow-right me-1"></i> Sign out
              </button>
            </form>
          </li>
        </ul>
      </div>

    </div>
  </div>
</nav>
