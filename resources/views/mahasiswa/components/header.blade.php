 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

     <div class="d-flex align-items-center justify-content-between">
         <a href="{{ route('mahasiswa.dashboard') }}" class="logo d-flex align-items-center">
             <img src="{{ asset('images/unsiq.png') }}" alt="">
             <span class="d-none d-lg-block">{{ $namaAplikasi }}</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div>
 </header>
