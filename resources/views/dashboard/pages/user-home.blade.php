@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/user-datatables-activities.js'])
@endsection

@section('content')
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Kegiatan</th>
                        <th>Lokasi</th>
                        <th>PIC</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Ditinjau Oleh</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Agenda Kegiatan</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-2">
            <form class="add-new-record pt-0 row g-3" id="form-add-new-record"
                action="{{ route('dashboard.activities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="date2" class="input-group-text"><i class='ri-calendar-2-line ri-18px'></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control dt-date" id="date" name="date"
                                aria-describedby="date2" placeholder="DD/MM/YYYY" aria-label="date" />
                            <label for="date">Tanggal</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="day2" class="input-group-text"><i class="ri-calendar-event-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="day" class="form-control dt-day" name="day"
                                placeholder="Senin" aria-label="day" aria-describedby="day2" />
                            <label for="day">Hari</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="time2" class="input-group-text"><i class="ri-time-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="time" id="time" class="form-control dt-time" name="time"
                                aria-label="time" aria-describedby="time2" />
                            <label for="time">Jam</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="activity2" class="input-group-text"><i class="ri-honour-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="activity" class="form-control dt-activity" name="activity"
                                placeholder="Seminar" aria-label="activity" aria-describedby="activity2" />
                            <label for="activity">Kegiatan</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="location2" class="input-group-text"><i class="ri-map-pin-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="location" class="form-control dt-location" name="location"
                                placeholder="Gedung Seminar" aria-label="location" aria-describedby="location2" />
                            <label for="location">Lokasi</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="pic2" class="input-group-text"><i class="ri-user-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="pic" class="form-control dt-pic" name="pic"
                                placeholder="Budi" aria-label="pic" aria-describedby="pic2" />
                            <label for="pic">PIC</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="phone_number2" class="input-group-text"><i class="ri-phone-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="phone_number" class="form-control dt-phone-number"
                                name="phone_number" placeholder="08172777777" aria-label="phone_number"
                                aria-describedby="phone_number2" />
                            <label for="phone_number">No HP</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="file" id="file" class="form-control dt-file" name="file"
                                aria-label="file" aria-describedby="file2" />
                            <label for="file">File Undangan</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </div>
            </form>

        </div>
    </div>
    <!--/ DataTable with Buttons -->
@endsection
