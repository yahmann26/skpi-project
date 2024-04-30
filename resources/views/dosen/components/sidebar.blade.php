<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ url('mahasiswa/dashboard') }}>
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ url('mahasiswa/kegiatan')}}>
                <i class="bi bi-activity"></i>
                <span>Kegiatan</span>
            </a>
        </li>
        <!-- End Kegiatan Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-printer-fill"></i>
                <span>SKPI</span>
            </a>
        </li>
        <!-- End Cetak Nav -->

        <li class="nav-heading">Pengaturan</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-person-fill"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('logout-mahasiswa')}}">
                <i class="bi bi-arrow-left-circle-fill"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Logout Page Nav -->

    </ul>

</aside>
<!-- End Sidebar-->
