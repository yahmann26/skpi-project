<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('mahasiswa.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('mahasiswa.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName(['mahasiswa.kegiatan.index','mahasiswa.kegiatan.cetak']) ? '' : 'collapsed' }}"
                data-bs-target="#kegiatan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar"></i><span>Kegiatan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="kegiatan-nav" class="nav-content collapse {{ isRouteName(['mahasiswa.kegiatan.index', 'mahasiswa.kegiatan.create', 'mahasiswa.kegiatan.edit', 'mahasiswa.kegiatan.show', 'mahasiswa.kegiatan.cetak']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('mahasiswa.kegiatan.index') }}"
                        class="{{ isRouteName('mahasiswa.kegiatan.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Pengajuan Kegiatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.kegiatan.cetak') }}"
                        class="{{ isRouteName('mahasiswa.kegiatan.cetak') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Cetak Kegiatan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isRouteName('mahasiswa.skpi.index') ? 'active' : 'collapsed' }}"
                href="{{ route('mahasiswa.skpi.index') }}">
                <i class="bi bi-printer"></i>
                <span>SKPI</span>
            </a>
        </li>
        <!-- End Kegiatan Nav -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('mahasiswa.user.profile') ? 'active' : 'collapsed' }}"
                href="{{ route('mahasiswa.user.profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> Sign Out
            </a>
        </li>
        <!-- End Logout Page Nav -->

    </ul>
</aside>
<!-- End Sidebar -->
