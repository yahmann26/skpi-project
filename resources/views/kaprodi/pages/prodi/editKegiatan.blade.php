@extends('kaprodi.layout.app')

@section('title', 'Ubah Kegiatan Default Program Studi')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kaprodi.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">Program Studi</li>
                <li class="breadcrumb-item active">Kegiatan Default</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card overflow-auto" id="app">
                    <div class="card-body">
                        <form
                            action="{{ route('kaprodi.prodi.update-kegiatan', ['id' => $detailData->id, 'from' => request()->query('from')]) }}"
                            method="post">

                            <div class="card-title d-flex justify-content-between">
                                <a href="{{ route('kaprodi.prodi.index') }}" class="btn btn-sm btn-outline-primary"><i
                                        class="bi bi-arrow-left"></i> Kembali</a>
                            </div>

                            <div class="row mt-10">
                                <div class="col-md-12" v-if="!!kegiatanDefaultData">
                                    @csrf
                                    @method('put')

                                    <!-- Kegiatan Default Section -->
                                    <div class="mb-2">
                                        <div>
                                            <span>Informasi Tentang Kegiatan Default</span>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Name</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="(item, index) in kegiatanDefaultData" :key="index">
                                            <tr>
                                                <!-- Menampilkan nomor urut berdasarkan index+1 -->
                                                <th>@{{ index + 1 }}</th>
                                                <th>
                                                    <input type="text" :name="'kegiatan_default[' + index + '][nama]'"
                                                        class="form-control" v-model="item.nama">
                                                </th>
                                                <th>
                                                    <input type="text" :name="'kegiatan_default[' + index + '][nama_en]'"
                                                        class="form-control" v-model="item.nama_en">
                                                </th>
                                                <th>
                                                    <button class="btn btn-sm btn-danger" title="Hapus" type="button"
                                                        @click="deleteKegiatanDefault(index)">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-sm btn-dark"
                                            @click="addKegiatanDefault">Tambah
                                            Kegiatan Default</button>
                                    </div>
                                </div>

                                <div class="col-md-12" v-if="loading">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 200px">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <textarea name="kegiatan_default" :value="kegiatanDefaultDataStringify" style="display: none;"></textarea>

                            <div class="mb-3" v-if="!!kegiatanDefaultData">
                                <button type="submit" class="btn btn-primary" :disabled="!isFormValid">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>

    <script type="text/javascript">
        const api = axios.create({
            baseURL: "{{ url('api') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        const kegiatanDefaultData = @json($detailData->kegiatan_default);

        const app = Vue.createApp({
            data() {
                return {
                    kegiatanDefaultData: JSON.parse(kegiatanDefaultData),
                    loading: true,
                }
            },
            mounted() {
                this.loading = false;
            },
            computed: {
                kegiatanDefaultDataStringify() {
                    return !!this.kegiatanDefaultData ? JSON.stringify(this.kegiatanDefaultData) : ''
                },
                isFormValid() {
                    return !!this.kegiatanDefaultData && this.kegiatanDefaultData.length > 0;
                }
            },
            methods: {
                addKegiatanDefault() {
                    this.kegiatanDefaultData.push({
                        nama: 'Kegiatan Baru',
                        nama_en: 'New Activities',
                    });
                },
                deleteKegiatanDefault(index) {
                    this.kegiatanDefaultData.splice(index, 1);
                }
            }
        });

        app.mount('#app');
    </script>
@endpush
