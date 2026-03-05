<aside class="main-sidebar sidebar-custom elevation-4">

    <a href="{{ url('/admin/dashboard') }}" class="brand-link border-0">
        <img src="{{ asset('imgs/logoGoBranca.png') }}"
             alt="Logo"
             class="brand-image"
        >
        <span class="brand-text font-weight-light text-white">
          Go! Ponto a Ponto
      </span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ auth()->user()->getAvatarUrlAttribute() }}"
                     class="img-circle elevation-2"
                     style="width:40px; height:40px; border-radius:50%; object-fit:cover;"
                alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.profile') }}" class="d-block text-white">
                    <x-user-name />
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}"
                       class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/profile') }}"
                       class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Perfil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/usersCRUD') }}"
                       class="nav-link {{ request()->is('admin/usersCRUD') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Usuários</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Sair</p>
                    </a>

                    <form id="sidebar-logout-form"
                          action="{{ route('logout') }}"
                          method="POST"
                          class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>

    </div>
</aside>

<style>
    .sidebar-custom {
        background: #13293D;
    }

    /* Brand */
    .sidebar-custom .brand-link {
        background: #13293D;
    }

    .sidebar-custom .brand-text {
        color: #E8F1F2;
        font-weight: 500;
    }

    /* User panel */
    .sidebar-custom .user-panel {
        border-bottom: 1px solid rgba(232, 241, 242, 0.15);
    }

    /* Links padrão */
    .sidebar-custom .nav-link {
        color: #E8F1F2;
        border-radius: 8px;
        margin: 4px 8px;
        transition: all 0.2s ease;
    }

    /* Hover */
    .sidebar-custom .nav-link:hover {
        background-color: #ffffff;
        color: #ffffff;
    }

    /* Item ativo */
    .sidebar-custom .nav-link.active {
        background-color: #006494;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
    }

    /* Ícone ativo */
    .sidebar-custom .nav-link.active .nav-icon {
        color: #1B98E0;
    }
</style>
