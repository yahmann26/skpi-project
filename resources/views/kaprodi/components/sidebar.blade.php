<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('kaprodi.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('kaprodi.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('kaprodi.prodi.index') ? 'active' : 'collapsed' }}"
                href="{{ route('kaprodi.prodi.index') }}">
                <i class="bi bi-book"></i>
                <span>Program Studi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('kaprodi.kegiatan.index') ? 'active' : 'collapsed' }}"
                href="{{ route('kaprodi.kegiatan.index') }}">
                <i class="bi bi-calendar-event"></i>
                <span>Kegiatan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('kaprodi.skpi.index') ? 'active' : 'collapsed' }}"
                href="{{ route('kaprodi.skpi.index') }}">
                <i class="bi bi-printer"></i>
                <span>SKPI</span>
            </a>
        </li>
        <!-- End Cetak Nav -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('kaprodi.user.profile') ? 'active' : 'collapsed' }}"
                href="{{ route('kaprodi.user.profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>
        <!-- End Profile Page Nav -->

        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> Sign Out
            </a>
        </li><!-- End Logout Page Nav -->

    </ul>
</aside>
<!-- End Sidebar -->
