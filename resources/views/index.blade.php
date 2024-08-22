@extends('layouts/blankLayout')

@section('title', 'Kegiatan')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/pages-index.js'])
@endsection

@section('content')
    <style>
        .authentication-wrapper {
            display: block;
        }

        @media (max-width: 992px) {
            .authentication-wrapper {
                background-color: #bfe3ff;
            }
        }

        .table-wrapper {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: center;
        }

        .logo-img {
            max-width: 100%;
            max-height: 400px;
            /* Set the desired max height */
            width: auto;
            height: auto;
        }

        .card {
            border-radius: 0;
        }

        .authentication-image {
            inset-block-end: 0 !important;
        }
    </style>

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            <div class="d-flex justify-content-center">
                @if ($settings)
                    <img src="{{ Storage::url($settings->logo_url) }}" alt="Centered Image" class="img-fluid logo-img mb-3">
                @endif
            </div>
            <img alt="mask" src="{{ asset('assets/img/background.jpg') }}"
                class="authentication-image d-none d-lg-block" />
            <div class="table-wrapper">
                <div class="card">
                    <div class="card-datatable pt-0">
                        <table class="datatables-basic table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Kegiatan</th>
                                    <th>Lokasi</th>
                                    <th>Jumlah Peserta</th>
                                    <th>PIC</th>
                                    <th>No HP</th>
                                    <th>Keterangan</th>
                                    <th>Undangan</th>
                                    <th>Ditinjau Oleh</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
