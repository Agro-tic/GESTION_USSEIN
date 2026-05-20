<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="index.html" aria-label="adminHMD dashboard">
          <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
          <span class="brand-copy">
            <span class="brand-title">UniGestion</span>
            <span class="brand-subtitle">Congés & Absences</span>
          </span>
        </a>
      </div>

      <nav class="sidebar-nav">

        {{-- Dashboard --}}
        <a class="nav-link active" href="/dashboard" aria-current="page">
          <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
          <span class="nav-text">Tableau de Bord</span>
        </a>

        {{-- Agents --}}
        <button class="nav-link nav-accordion" data-target="sub-agents" aria-expanded="false">
          <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
          <span class="nav-text">Agents</span>
          <span class="nav-chevron"><i class="bi bi-chevron-down" aria-hidden="true"></i></span>
        </button>
        <ul class="nav-submenu" id="sub-agents" role="list">
          <li><a href="{{route('agent.index')}}">Liste</a></li>
          <li><a href="{{route('agent.create')}}">Nouveau</a></li>
        </ul>

        {{-- Congés --}}
        <button class="nav-link nav-accordion" data-target="sub-conges" aria-expanded="false">
          <span class="nav-icon"><i class="bi bi-calendar-x" aria-hidden="true"></i></span>
          <span class="nav-text">Congés</span>
          <span class="nav-chevron"><i class="bi bi-chevron-down" aria-hidden="true"></i></span>
        </button>
        <ul class="nav-submenu" id="sub-conges" role="list">
          <li><a href="">Liste</a></li>
          <li><a href="">Nouveau</a></li>
        </ul>

        {{-- Absences --}}
        <button class="nav-link nav-accordion" data-target="sub-absences" aria-expanded="false">
          <span class="nav-icon"><i class="bi bi-person-dash" aria-hidden="true"></i></span>
          <span class="nav-text">Absences</span>
          <span class="nav-chevron"><i class="bi bi-chevron-down" aria-hidden="true"></i></span>
        </button>
        <ul class="nav-submenu" id="sub-absences" role="list">
          <li><a href="">Liste</a></li>
          <li><a href="">Nouveau</a></li>
        </ul>

        {{-- Jours Fériés --}}
        <a class="nav-link" href="charts.html">
          <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
          <span class="nav-text">Jours Fériés</span>
        </a>

        {{-- Rapports PDF --}}
        <a class="nav-link" href="profile.html">
          <span class="nav-icon"><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i></span>
          <span class="nav-text">Rapports PDF</span>
        </a>

      </nav>

      {{-- Infos utilisateur connecté --}}
      <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar" src="../assets/images/avatar/avatar.jpg" alt="Admin Hasan">
        <strong>Admin Hasan</strong>
        <small>Active Workspace</small>
      </div>

      <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
      </div>
    </aside>
