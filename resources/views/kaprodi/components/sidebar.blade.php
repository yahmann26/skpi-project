<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link  {{ isRouteName('kaprodi.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('kaprodi.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('kaprodi.prodi.index') ? '' : 'collapsed'}}" href="{{ route('kaprodi.prodi.index') }}">
                <i class="bi bi-printer"></i>
                <span>Prodi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isROuteName('kaprodi.kegiatan.index') ? '' : 'collapsed' }}" href="{{ route('kaprodi.kegiatan.index') }}">
                <i class="bi bi-printer"></i>
                <span>Kegiatan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-printer"></i>
                <span>SKPI</span>
            </a>
        </li>
        <!-- End Cetak Nav -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('kaprodi.user.profile') ? '' : 'collapsed' }}"
                href="{{ route('kaprodi.user.profile') }}"
                class="{{ isRouteName('kaprodi.user.profile') ? 'active' : '' }}">
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
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="bi bi-arrow-left-circle"></i>
                Sign Out
            </a>
        </li><!-- End Logout Page Nav -->

    </ul>

</aside>
<!-- End Sidebar-->
