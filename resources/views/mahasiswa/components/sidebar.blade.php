

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link  {{ isRouteName('mahasiswa.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('mahasiswa.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>


        <li class="nav-item">
            <a class="nav-link {{ isRouteName('mahasiswa.kegiatan.index') ? '' : 'collapsed' }}"
                href="{{ route('mahasiswa.kegiatan.index') }}"
                class="{{ isRouteName('mahasiswa.kegiatan.index') ? 'active' : '' }}">
                <i class="bi bi-award"></i>
                <span>Kegiatan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isRouteName('mahasiswa.skpi.index') ? '' : 'collapsed' }}" href="{{ route('mahasiswa.skpi.index') }}">
                <i class="bi bi-printer"></i>
                <span>SKPI</span>
            </a>
        </li>
        <!-- End Kegiatan Nav -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('mahasiswa.user.profile') ? '' : 'collapsed' }}" href="{{ route('mahasiswa.user.profile') }}" class="{{ isRouteName('mahasiswa.user.profile') ? 'active' : '' }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="bi bi-arrow-left-circle"></i>
                Sign Out
            </a>
        </li><!-- End Logout Page Nav -->

    </ul>

</aside>
<!-- End Sidebar-->
