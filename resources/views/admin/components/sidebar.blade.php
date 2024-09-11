<?php

use App\Helper\Skpi;

if (!function_exists('isRouteName')) {
    function isRouteName($routeNames)
    {
        if (is_array($routeNames)) {
            foreach ($routeNames as $routeName) {
                if (Route::currentRouteName() == $routeName) {
                    return true;
                }
            }
        } else {
            if (Route::currentRouteName() == $routeNames) {
                return true;
            }
        }
    }
}

$logoAplikasiUrl = Skpi::getAssetUrl(Skpi::getSettingByName('logo_universitas'));
$namaAplikasi = Skpi::getSettingByName('nama_aplikasi');
$namaInstitusiSingkat = Skpi::getSettingByName('nama_universitas_singkat');

?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link  {{ isRouteName('admin.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName(['admin.jenjang.index', 'admin.prodi.index']) ? '' : 'collapsed' }}"
                data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="master-nav"
                class="nav-content collapse "
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.jenjang.index') }}"
                        class="{{ isRouteName('admin.jenjang.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Jenjang Pendidikan</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="{{ isRouteName('admin.prodi.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Program Studi</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ url('admin/pt')}}">
                        <i class="bi bi-circle"></i>
                        <span>Perguruan Tinggi</span>
                    </a>
                </li> --}}
            </ul>
        </li>


        <!-- End PT Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
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
            <a class="nav-link collapsed" href="">
                <i class="bi bi-printer"></i>
                <span>SKPI</span>
            </a>
        </li>
        <!-- End Cetak Nav -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ isRouteName('admin.pengaturan.index') ? '' : 'collapsed' }}"
                href="{{ route('admin.pengaturan.index') }}"
                class="{{ isRouteName('admin.pengaturan.index') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-arrow-left-circle"></i>
                Sign Out
            </a>
        </li><!-- End Logout Page Nav -->

    </ul>

</aside>
<!-- End Sidebar-->
