@extends('admin.layout.app')

@section('title', 'Ubah CPL Program Studi - ')

@section('main')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item">Prodi</li>
                <li class="breadcrumb-item active">Capaian Pembelajaran Lulusan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card overflow-auto" id="app">
                    <div class="card-body">
                        <form
                            action="{{ route('admin.prodi.update-cpl', ['id' => $detailData->id, 'from' => request()->query('from')]) }}"
                            method="post">

                            <div class="card-title d-flex justify-content-between">
                                <a href="{{ route('admin.prodi.index') }}" class="btn btn-sm btn-outline-primary"><i
                                        class="bi bi-arrow-left"></i> Kembali</a>
                                <!-- <span class="text-danger small">Bertanda *) wajib diisi</span> -->
                            </div>

                            <div class="row mt-10">
                                <div class="col-md-12" v-if="!!kualifikasiCplData">
                                    @csrf
                                    @method('put')
                                    <div class="mb-2">
                                        <div>
                                            <span>Informasi Tentang Kualifikasi dan Hasil yang Dicapai</span>
                                        </div>
                                    </div>
                                    <table class="table table-bordered" v-if="!cplEditMode">
                                        <tbody v-for="(item, index) in kualifikasiCplData">
                                            <template v-if="item && item.subs">
                                                <template v-for="(subItem, subIndex) in item.subs">
                                                    <tr>
                                                        <th style="background-color: #ddd"></th>
                                                        <th class="" style="background-color: #ddd">
                                                            @{{ subItem.judul }}
                                                        </th>
                                                        <th class="" style="background-color: #ddd">
                                                            @{{ subItem.judul_en }}
                                                        </th>
                                                    </tr>
                                                    <template v-if="subItem && subItem.list">
                                                        <template
                                                            v-for="(subItemListItem, subItemListItemIndex) in subItem.list">
                                                            <tr>
                                                                <td>@{{ subItemListItemIndex + 1 }}</td>
                                                                <td class="">@{{ subItemListItem.teks }}</td>
                                                                <td class="">@{{ subItemListItem.teks_en }}</td>
                                                            </tr>
                                                        </template>
                                                    </template>
                                                    <template v-else-if="subItem && subItem.subs">
                                                        <template
                                                            v-for="(subItemListItem, subItemListItemIndex) in subItem.subs">
                                                            <tr>
                                                                <th></th>
                                                                <th class="small">@{{ subItemListItem.judul }}</th>
                                                                <th class="small">@{{ subItemListItem.judul_en }}</th>
                                                            </tr>

                                                            <template v-if="subItemListItem && subItemListItem.list">
                                                                <template
                                                                    v-for="(subItemListItemListItem, subItemListItemListItemIndex) in subItemListItem.list">
                                                                    <tr>
                                                                        <td>@{{ subItemListItemListItemIndex + 1 }}</td>
                                                                        <td class="">
                                                                            @{{ subItemListItemListItem.teks }}
                                                                        </td>
                                                                        <td class="">
                                                                            @{{ subItemListItemListItem.teks_en }}
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </template>
                                                        </template>
                                                    </template>
                                                </template>
                                            </template>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered" v-else>
                                        <tbody v-for="(item, index) in kualifikasiCplData">
                                            <template v-if="item && item.subs">
                                                <template v-for="(subItem, subIndex) in item.subs">
                                                    <tr>
                                                        <th style="background-color: #ddd"></th>
                                                        <th class="" style="background-color: #ddd">
                                                            <input type="text"
                                                                :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][judul]`"
                                                                class="form-control" v-model="subItem.judul">
                                                        </th>
                                                        <th class="" style="background-color: #ddd">
                                                            <input type="text"
                                                                :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][judul_en]`"
                                                                class="form-control" v-model="subItem.judul_en">
                                                        </th>
                                                        <th>
                                                            <button class="btn btn-sm btn-danger" title="Hapus"
                                                                type="button" @click="deleteJudul(index, subIndex)">
                                                                <i class="bi bi-x"></i></button>
                                                        </th>
                                                    </tr>
                                                    <template v-if="subItem && subItem.list">
                                                        <template
                                                            v-for="(subItemListItem, subItemListItemIndex) in subItem.list">
                                                            <tr>
                                                                <td>@{{ subItemListItemIndex + 1 }}</td>
                                                                <td class="">
                                                                    <input type="text"
                                                                        :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][list][${subItemListItemIndex}][teks]`"
                                                                        class="form-control" v-model="subItemListItem.teks">
                                                                </td>
                                                                <td class="">
                                                                    <input type="text"
                                                                        :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][list][${subItemListItemIndex}][teks_en]`"
                                                                        class="form-control"
                                                                        v-model="subItemListItem.teks_en">
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-danger" type="button"
                                                                        @click="deleteSubItem(index, subIndex, subItemListItemIndex)">
                                                                        <i class="bi bi-x"></i></button>
                                                                </td>
                                                            </tr>
                                                        </template>
                                                    </template>
                                                    <tr>
                                                        <td style="background-color: #fff" colspan="4">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-secondary ms-2"
                                                                    style="font-size: 10px"
                                                                    @click="addItemSubItem(index, subIndex)">Tambah
                                                                    Item</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <template v-if="subItem && subItem.subs">
                                                        <template
                                                            v-for="(subItemListItem, subItemListItemIndex) in subItem.subs">
                                                            <tr>
                                                                <th></th>
                                                                <th class="small">
                                                                    <input type="text"
                                                                        :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][subs][${subItemListItemIndex}][judul]`"
                                                                        class="form-control"
                                                                        v-model="subItemListItem.judul">
                                                                </th>
                                                                <th class="small">
                                                                    <input type="text"
                                                                        :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][subs][${subItemListItemIndex}][judul_en]`"
                                                                        class="form-control"
                                                                        v-model="subItemListItem.judul_en">
                                                                </th>
                                                                <td>
                                                                    <button class="btn btn-sm btn-danger" type="button"
                                                                        @click="deleteSubJudul(index, subIndex, subItemListItemIndex)">
                                                                        <i class="bi bi-x"></i></button>
                                                                </td>
                                                            </tr>

                                                            <template v-if="subItemListItem && subItemListItem.list">
                                                                <template
                                                                    v-for="(subItemListItemListItem, subItemListItemListItemIndex) in subItemListItem.list">
                                                                    <tr>
                                                                        <td>@{{ subItemListItemListItemIndex + 1 }}</td>
                                                                        <td class="">
                                                                            <input type="text"
                                                                                :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][subs][${subItemListItemIndex}][list][${subItemListItemListItemIndex}][teks]`"
                                                                                class="form-control"
                                                                                v-model="subItemListItemListItem.teks">
                                                                        </td>
                                                                        <td class="">
                                                                            <input type="text"
                                                                                :name="`pengaturan_hasil_capaian_data[${index}][subs][${subIndex}][subs][${subItemListItemIndex}][list][${subItemListItemListItemIndex}][teks_en]`"
                                                                                class="form-control"
                                                                                v-model="subItemListItemListItem.teks_en">
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-sm btn-danger"
                                                                                type="button"
                                                                                @click="deleteSubItemListItem(index, subIndex, subItemListItemIndex, subItemListItemListItemIndex)">
                                                                                <i class="bi bi-x"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </template>

                                                            <tr>
                                                                <td style="background-color: #fff" colspan="4">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-center">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-secondary ms-2"
                                                                            style="font-size: 10px"
                                                                            @click="addItemSubItemListItem(index, subIndex, subItemListItemIndex)">Tambah
                                                                            Item</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </template>
                                                    </template>
                                                    <tr>
                                                        <td style="background-color: #fff" colspan="4">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                    style="font-size: 10px"
                                                                    @click="addItemSubJudul(index, subIndex)">Tambah
                                                                    Subjudul</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <tr>
                                                    <td style="background-color: #fff" colspan="4">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-sm btn-dark small"
                                                                @click="addItemJudul(index)">Tambah Judul</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-md-12" v-if="loading">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 200px">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <textarea name="cpl" :value="kualifikasiCplDataStringify" style="display: none;"></textarea>

                            <div class="mb-3" v-if="!!kualifikasiCplData">
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

        const cplEditMode = true;
        const cplData = @json($detailData->kualifikasi_cpl);

        const app = Vue.createApp({
            data() {
                return {
                    kualifikasiCplData: JSON.parse(cplData),
                    cplEditMode: true,
                    loading: true,
                }
            },
            mounted() {
                console.log('kualifikasiCplData', this.kualifikasiCplData)
                this.loading = false;
            },
            computed: {
                kualifikasiCplDataStringify() {
                    return !!this.kualifikasiCplData ? JSON.stringify(this.kualifikasiCplData) : ''
                },
                isFormValid() {
                    return !!this.kualifikasiCplData
                }
            },
            methods: {
                addItemJudul(index, subIndex) {
                    this.kualifikasiCplData[index].subs.push({
                        judul: '',
                        judul_en: '',
                        subs: [],
                        list: [],
                    });
                },
                addItemSubJudul(index, subIndex) {
                    if (!this.kualifikasiCplData[index].subs[subIndex].subs) {
                        this.kualifikasiCplData[index].subs[subIndex].subs = [];
                    }
                    this.kualifikasiCplData[index].subs[subIndex].subs.push({
                        judul: 'Subjudul baru',
                        judul_en: 'New subjudul',
                        list: [],
                    });
                },
                addItemSubItem(index, subIndex) {
                    if (!this.kualifikasiCplData[index].subs[subIndex].list) {
                        this.kualifikasiCplData[index].subs[subIndex].list = [];
                    }
                    this.kualifikasiCplData[index].subs[subIndex].list.push({
                        teks: 'Item baru',
                        teks_en: 'New item',
                    });
                },
                addItemSubItemListItem(index, subIndex, subItemListItemIndex) {
                    if (!this.kualifikasiCplData[index].subs[subIndex].subs[subItemListItemIndex].list) {
                        this.kualifikasiCplData[index].subs[subIndex].subs[subItemListItemIndex].list = [];
                    }
                    this.kualifikasiCplData[index].subs[subIndex].subs[subItemListItemIndex].list.push({
                        teks: 'Item baru',
                        teks_en: 'New item',
                    });
                },

                deleteJudul(index, subIndex) {
                    this.kualifikasiCplData[index].subs.splice(subIndex, 1);
                },
                deleteSubJudul(index, subIndex, subItemListItemIndex) {
                    this.kualifikasiCplData[index].subs[subIndex].subs.splice(subItemListItemIndex, 1);
                },
                deleteSubItem(index, subIndex, subItemListItemIndex) {
                    this.kualifikasiCplData[index].subs[subIndex].list.splice(subItemListItemIndex, 1);
                },
                deleteSubItemListItem(index, subIndex, subItemListItemIndex, subItemListItemListItemIndex) {
                    this.kualifikasiCplData[index].subs[subIndex].subs[subItemListItemIndex].list.splice(
                        subItemListItemListItemIndex, 1);
                },
            }
        });

        app.mount('#app');
    </script>
@endpush
