@extends('admin.layout.app')

@section('title', 'Pengaturan ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">Pengaturan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">
            <div class="col-md-12">
                <div class="card overflow-auto">
                    <div class="card-body" style="min-height: 300px">

                        {{-- tab --}}
                        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="dasar-tab" data-bs-toggle="tab" data-bs-target="#dasar"
                                    type="button" role="tab" aria-controls="dasar" aria-selected="true">Dasar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="universitas-tab" data-bs-toggle="tab"
                                    data-bs-target="#universitas" type="button" role="tab" aria-controls="universitas"
                                    aria-selected="false">Universitas</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tandatangan-tab" data-bs-toggle="tab"
                                    data-bs-target="#tandatangan" type="button" role="tab" aria-controls="tandatangan"
                                    aria-selected="false">Tanda Tangan</button>
                            </li>
                        </ul>

                        {{-- tab content --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dasar" role="tabpanel"
                                aria-labelledby="dasar-tab">

                                <div class="row">
                                    <div class="col-md-6">

                                        <form action="{{ route('admin.pengaturan.update', ['category' => 'dasar']) }}"
                                            method="post" class="mt-3" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nama_aplikasi" class="form-label">Nama Aplikasi <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nama_aplikasi" id="nama_aplikasi"
                                                    class="form-control @error('nama_aplikasi') is-invalid @enderror"
                                                    value="{{ old('nama_aplikasi', $pengaturan['nama_aplikasi']) }}" />
                                                @error('nama_aplikasi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <label for="logo_aplikasi_url" class="form-label">Logo Aplikasi</label>
                                            <div class="row">
                                                @if (!empty($pengaturan['logo_aplikasi']))
                                                    <div class="col-md-4">
                                                        <img src="{{ $pengaturan['logo_aplikasi_url'] }}"
                                                            class="img-fluid img-thumbnail" alt="Logo Aplikasi">
                                                    </div>
                                                @endif
                                                <div class="col-md-8">
                                                    <div
                                                        class="input-group mb-3 @error('logo_aplikasi_url') is-invalid @enderror @error('logo_aplikasi') is-invalid @enderror">
                                                        <input type="text" name="logo_aplikasi_url"
                                                            class="form-control url" aria-describedby="logo_aplikasi-addon"
                                                            class="form-control"
                                                            value="{{ old('logo_aplikasi', $pengaturan['logo_aplikasi_url']) }}"
                                                            autofocus placeholder="https://">
                                                        <input type="file" accept="image/*" name="logo_aplikasi"
                                                            class="d-none" />
                                                        <button class="input-group-text" type="button"
                                                            onclick="openFile(this)" title="Browse Server">
                                                            <i class="bi bi-folder2-open me-1"></i> Pilih Berkas
                                                        </button>
                                                    </div>
                                                    <div class="form-text">Ukuran gambar maksimal 1 MB</div>
                                                    <div class="form-text">Format gambar harus .jpg, .jpeg, atau .png</div>
                                                    @error('logo_aplikasi_url')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @error('logo_aplikasi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <hr style="margin-top: 100px" />

                                            <button type="submit" class="btn btn-primary btn-sm py-2">
                                                <i class="bi bi-save me-1"></i>
                                                Simpan Perubahan
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="universitas" role="tabpanel"
                                aria-labelledby="universitas-tab">
                                <div class="row">
                                    <div class="col-md-6">

                                        <form
                                            action="{{ route('admin.pengaturan.update', ['category' => 'universitas']) }}"
                                            method="post" class="mt-3" enctype="multipart/form-data">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="nama_universitas" class="form-label">Nama Universitas <span
                                                        class="text-danger">*</span></label>
                                                <div
                                                    class="input-group mb-3 @error('nama_universitas') is-invalid @enderror">
                                                    <span class="input-group-text">&nbsp;ID</span>
                                                    <input type="text" name="nama_universitas" class="form-control"
                                                        aria-describedby="nama_universitas-addon" class="form-control"
                                                        value="{{ old('nama_universitas', $pengaturan['nama_universitas']) }}"
                                                        autofocus placeholder="Nama Universitas">
                                                </div>
                                                @error('nama_universitas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <div
                                                    class="input-group mb-3 @error('nama_universitas_en') is-invalid @enderror">
                                                    <span class="input-group-text">EN</span>
                                                    <input type="text" name="nama_universitas_en" class="form-control"
                                                        aria-describedby="nama_universitas_en-addon" class="form-control"
                                                        value="{{ old('nama_universitas_en', $pengaturan['nama_universitas_en']) }}"
                                                        autofocus placeholder="Nama program studi (english)">
                                                </div>
                                                @error('nama_universitas_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_universitas_singkat" class="form-label">Nama universitas
                                                    (singkat) <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_universitas_singkat"
                                                    id="nama_universitas_singkat"
                                                    class="form-control @error('nama_universitas_singkat') is-invalid @enderror"
                                                    value="{{ old('nama_universitas_singkat', $pengaturan['nama_universitas_singkat']) }}" />
                                                @error('nama_universitas_singkat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <label for="logo_universitas_url" class="form-label">Logo universitas</label>
                                            <div class="row">
                                                @if (!empty($pengaturan['logo_universitas']))
                                                    <div class="col-md-4">
                                                        <img src="{{ $pengaturan['logo_universitas_url'] }}"
                                                            class="img-fluid img-thumbnail" alt="Logo universitas">
                                                    </div>
                                                @endif
                                                <div class="col-md-8">
                                                    <div
                                                        class="input-group mb-3 @error('logo_universitas_url') is-invalid @enderror @error('logo_universitas') is-invalid @enderror">
                                                        <input type="text" name="logo_universitas_url"
                                                            class="form-control url"
                                                            aria-describedby="logo_universitas-addon" class="form-control"
                                                            value="{{ old('logo_universitas', $pengaturan['logo_universitas_url']) }}"
                                                            autofocus placeholder="https://">
                                                        <input type="file" accept="image/*" name="logo_universitas"
                                                            class="d-none" />
                                                        <button class="input-group-text" type="button"
                                                            onclick="openFile(this)" title="Browse Server">
                                                            <i class="bi bi-folder2-open me-1"></i> Pilih Berkas
                                                        </button>
                                                    </div>
                                                    <div class="form-text">Ukuran gambar maksimal 1 MB</div>
                                                    <div class="form-text">Format gambar harus .jpg, .jpeg, atau .png</div>
                                                    @error('logo_universitas_url')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @error('logo_universitas')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat_universitas" class="form-label">Alamat <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="alamat_universitas" id="alamat_universitas"
                                                    class="form-control @error('alamat_universitas') is-invalid @enderror">{{ old('alamat_universitas', $pengaturan['alamat_universitas']) }}</textarea>
                                                @error('alamat_universitas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email_universitas" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="email_universitas" id="email_universitas"
                                                    class="form-control @error('email_universitas') is-invalid @enderror"
                                                    value="{{ old('email_universitas', $pengaturan['email_universitas']) }}" />
                                                @error('email_universitas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="telepon_universitas" class="form-label">No. Telp <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="telepon_universitas" id="telepon_universitas"
                                                    class="form-control @error('telepon_universitas') is-invalid @enderror"
                                                    value="{{ old('telepon_universitas', $pengaturan['telepon_universitas']) }}" />
                                                @error('telepon_universitas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="sk_pendirian_universitas" class="form-label">SK Pendirian
                                                    <span class="text-danger">*</span></label>
                                                <div
                                                    class="input-group mb-3 @error('sk_pendirian_universitas') is-invalid @enderror">
                                                    <span class="input-group-text">&nbsp;ID</span>
                                                    <input type="text" name="sk_pendirian_universitas"
                                                        class="form-control"
                                                        aria-describedby="sk_pendirian_universitas-addon"
                                                        class="form-control"
                                                        value="{{ old('sk_pendirian_universitas', $pengaturan['sk_pendirian_universitas']) }}"
                                                        autofocus placeholder="Nama program studi">
                                                </div>
                                                @error('sk_pendirian_universitas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <div
                                                    class="input-group mb-3 @error('sk_pendirian_universitas_en') is-invalid @enderror">
                                                    <span class="input-group-text">EN</span>
                                                    <input type="text" name="sk_pendirian_universitas_en"
                                                        class="form-control"
                                                        aria-describedby="sk_pendirian_universitas_en-addon"
                                                        class="form-control"
                                                        value="{{ old('sk_pendirian_universitas_en', $pengaturan['sk_pendirian_universitas_en']) }}"
                                                        autofocus placeholder="Nama program studi (english)">
                                                </div>
                                                @error('sk_pendirian_universitas_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="jenis_pendidikan" class="form-label">Jenis Pendidikan <span
                                                        class="text-danger">*</span></label>
                                                <div
                                                    class="input-group mb-3 @error('jenis_pendidikan') is-invalid @enderror">
                                                    <span class="input-group-text">&nbsp;ID</span>
                                                    <input type="text" name="jenis_pendidikan" class="form-control"
                                                        aria-describedby="jenis_pendidikan-addon" class="form-control"
                                                        value="{{ old('jenis_pendidikan', $pengaturan['jenis_pendidikan']) }}"
                                                        autofocus placeholder="Nama program studi">
                                                </div>
                                                @error('jenis_pendidikan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <div
                                                    class="input-group mb-3 @error('jenis_pendidikan_en') is-invalid @enderror">
                                                    <span class="input-group-text">EN</span>
                                                    <input type="text" name="jenis_pendidikan_en" class="form-control"
                                                        aria-describedby="jenis_pendidikan_en-addon" class="form-control"
                                                        value="{{ old('jenis_pendidikan_en', $pengaturan['jenis_pendidikan_en']) }}"
                                                        autofocus placeholder="Nama program studi (english)">
                                                </div>
                                                @error('jenis_pendidikan_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <hr style="margin-top: 100px" />

                                            <button type="submit" class="btn btn-primary btn-sm py-2">
                                                <i class="bi bi-save me-1"></i>
                                                Simpan Perubahan
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tandatangan" role="tabpanel"
                                aria-labelledby="tandatangan-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form
                                            action="{{ route('admin.pengaturan.update', ['category' => 'tandatangan']) }}"
                                            method="post" class="mt-3" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nama_penandatangan" class="form-label">Nama Penandatangan
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_penandatangan" id="nama_penandatangan"
                                                    class="form-control @error('nama_penandatangan') is-invalid @enderror"
                                                    value="{{ old('nama_penandatangan', $pengaturan['nama_penandatangan']) }}" />
                                                @error('nama_penandatangan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nip_penandatangan" class="form-label">NIP Penandatangan <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nip_penandatangan" id="nip_penandatangan"
                                                    class="form-control @error('nip_penandatangan') is-invalid @enderror"
                                                    value="{{ old('nip_penandatangan', $pengaturan['nip_penandatangan']) }}" />
                                                @error('nip_penandatangan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="jabatan_penandatangan" class="form-label">Jabatan
                                                    Penandatangan
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="jabatan_penandatangan"
                                                    id="jabatan_penandatangan"
                                                    class="form-control @error('jabatan_penandatangan') is-invalid @enderror"
                                                    value="{{ old('jabatan_penandatangan', $pengaturan['jabatan_penandatangan']) }}" />
                                                @error('nip_penandatangan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="gambar_tandatangan_cap" class="form-label">Gambar Tandatangan
                                                    Bercap</label>
                                                <div class="row">
                                                    @if (!empty($pengaturan['gambar_tandatangan_cap']))
                                                        <div class="col-md-4">
                                                            <img src="{{ $pengaturan['gambar_tandatangan_cap_url'] }}"
                                                                class="img-fluid img-thumbnail" alt="Gambar">
                                                        </div>
                                                    @endif
                                                    <div class="col-md-8">
                                                        <div
                                                            class="input-group mb-3 @error('gambar_tandatangan_cap') is-invalid @enderror @error('gambar_tandatangan_cap') is-invalid @enderror">
                                                            <input type="text" name="gambar_tandatangan_cap"
                                                                class="form-control url"
                                                                aria-describedby="gambar_tandatangan_cap-addon"
                                                                class="form-control"
                                                                value="{{ old('gambar_tandatangan_cap', $pengaturan['gambar_tandatangan_cap_url']) }}"
                                                                autofocus placeholder="https://">
                                                            <input type="file" accept="image/*"
                                                                name="gambar_tandatangan_cap" class="d-none" />
                                                            <button class="input-group-text" type="button"
                                                                onclick="openFile(this)" title="Browse Server">
                                                                <i class="bi bi-folder2-open me-1"></i> Pilih Berkas
                                                            </button>
                                                        </div>
                                                        <div class="form-text">Ukuran gambar maksimal 1 MB</div>
                                                        <div class="form-text">Format gambar harus .jpg, .jpeg, atau .png
                                                        </div>
                                                        @error('gambar_tandatangan_cap_url')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        @error('gambar_tandatangan_cap')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <hr style="margin-top: 100px" />

                                            <button type="submit" class="btn btn-primary btn-sm py-2">
                                                <i class="bi bi-save me-1"></i>
                                                Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>

    </section>


@endsection

@push('script')
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function openFile(el) {
            $(el).parent().find('input[type="file"]').click();
            $(el).parent().find('input[type="file"]').change(function() {
                var filename = $(this).val().split('\\').pop();
                $(el).parent().find('input.url').val(filename);
            });
        }

        const urlParams = new URLSearchParams(window.location.search);
        const tabKey = urlParams.get('tab') || 'dasar'
        console.log('tabKey', tabKey)

        var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'))

        if (tabKey) {
            triggerTabList.forEach(function(triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)
                if (triggerEl.id == tabKey + '-tab') {
                    tabTrigger.show()
                }
            })
        }

        triggerTabList.forEach(function(triggerEl) {
            triggerEl.addEventListener('click', function(event) {
                const newTabKey = event.target.id.replace('-tab', '');
                const newUrl = new URL(window.location);
                newUrl.searchParams.set('tab', newTabKey);
                history.pushState(null, '', newUrl);
            });
        });
    </script>
@endpush
