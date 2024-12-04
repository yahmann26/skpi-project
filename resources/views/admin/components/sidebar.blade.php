<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('admin.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName(['admin.jenjang.index', 'admin.prodi.index', 'admin.pt.index', 'admin.jenisPendaftaran.index', 'admin.thnAkademik.index']) ? '' : 'collapsed' }}"
                data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="master-nav" class="nav-content collapse {{ isRouteName(['admin.jenjang.index', 'admin.jenjang.create', 'admin.jenjang.edit', 'admin.prodi.index', 'admin.prodi.create', 'admin.prodi.edit', 'admin.prodi.edit-cpl', 'admin.pt.index', 'admin.pt.create', 'admin.pt.edit','admin.jenisPendaftaran.index', 'admin.jenisPendaftaran.edit', 'admin.thnAkademik.index', 'admin.thnAkademik.edit' ]) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.jenjang.index') }}"
                        class="{{ isRouteName('admin.jenjang.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Jenjang Pendidikan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.prodi.index') }}"
                        class="{{ isRouteName('admin.prodi.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Program Studi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pt.index') }}" class="{{ isRouteName('admin.pt.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Pendidikan Tinggi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jenisPendaftaran.index') }}" class="{{ isRouteName('admin.jenisPendaftaran.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Jenis Pendaftaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.thnAkademik.index') }}" class="{{ isRouteName('admin.thnAkademik.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Tahun Akademik</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName(['admin.mahasiswa.index', 'admin.kaprodi.index']) ? '' : 'collapsed' }}"
                data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse {{ isRouteName(['admin.mahasiswa.index', 'admin.mahasiswa.create', 'admin.mahasiswa.edit', 'admin.kaprodi.index', 'admin.kaprodi.create', 'admin.kaprodi.edit']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.kaprodi.index') }}"
                        class="{{ isRouteName('admin.kaprodi.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kaprodi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.mahasiswa.index') }}"
                        class="{{ isRouteName('admin.mahasiswa.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Mahasiswa</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End User Nav -->

        <li class="nav-item">
            <a class="nav-link {{ isRouteName(['admin.kegiatan.index', 'admin.kategoriKegiatan.index', 'admin.kegiatan.cetak']) ? '' : 'collapsed' }}"
                data-bs-target="#kegiatan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar"></i><span>Kegiatan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="kegiatan-nav" class="nav-content collapse {{ isRouteName(['admin.kategoriKegiatan.index', 'admin.kategoriKegiatan.create', 'admin.kategoriKegiatan.edit', 'admin.kegiatan.index', 'admin.kegiatan.create', 'admin.kegiatan.edit', 'admin.kegiatan.show', 'admin.kegiatan.cetak']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.kategoriKegiatan.index') }}"
                        class="{{ isRouteName('admin.kategoriKegiatan.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kategori Kegiatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="{{ isRouteName('admin.kegiatan.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Pengajuan Kegiatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kegiatan.cetak') }}"
                        class="{{ isRouteName('admin.kegiatan.cetak') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Cetak Kegiatan</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('admin.skpi.index') ? '' : 'collapsed' }}"
                href="{{ route('admin.skpi.index') }}">
                <i class="bi bi-printer"></i>
                <span>SKPI</span>
            </a>
        </li>
        <!-- End Cetak Nav -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('admin.pengaturan.index') ? '' : 'collapsed' }}"
                href="{{ route('admin.pengaturan.index') }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('admin.user.profile') ? '' : 'collapsed' }}"
                href="{{ route('admin.user.profile') }}">
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
        </li>
        <!-- End Logout Page Nav -->

    </ul>
</aside>
<!-- End Sidebar -->
