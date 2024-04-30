<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href={{ url('admin/dashboard', []) }}>
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('admin/pt')}}">
                <i class="bi bi-award-fill"></i>
                <span>Perguruan Tinggi</span>
            </a>
        </li>
        <!-- End PT Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people-fill"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('admin/dosen')}}">
                        <i class="bi bi-circle"></i><span>User Dosen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/mahasiswa')}}">
                        <i class="bi bi-circle"></i><span>User Mahasiswa</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End User Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-activity"></i><span>Kegiatan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('admin/kategori')}}">
                        <i class="bi bi-circle"></i><span>Kategori Kegiatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/kegiatan')}}">
                        <i class="bi bi-circle"></i><span>Data Kegiatan</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Kegiatan Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('admin/prodi')}}">
                <i class="bi bi-bookmarks-fill"></i>
                <span>Prodi</span>
            </a>
        </li>
        <!-- End Prodi Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('admin/cp')}}">
                <i class="bi bi-journal-album"></i>
                <span>Capaian Pembelajaran</span>
            </a>
        </li>
        <!-- End Capaian Pembelajaran Nav -->

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
            <a class="nav-link collapsed" href="{{ url('logout-admin')}}">
                <i class="bi bi-arrow-left-circle-fill"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Logout Page Nav -->

    </ul>

</aside>
<!-- End Sidebar-->
