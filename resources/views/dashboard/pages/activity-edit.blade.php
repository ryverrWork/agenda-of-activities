@extends('layouts/layoutMaster')

@section('title', ' Edit Kegiatan')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/activity-edit-form.js'])
@endsection

@section('content')
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Kegiatan</h5>
                </div>
                <div class="card-body">
                    <form id="form-edit-activity" action="{{ route('dashboard.activities.update', $activity->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="date" class="form-control date-picker" placeholder="DD/MM/YYYY"
                                name="date" value="{{ $activity->date }}" />
                            <label for="date">Tanggal</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" class="form-control" id="day" name="day" placeholder="Senin"
                                value="{{ $activity->day }}" />
                            <label for="day">Hari</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="time" class="form-control" id="time" name="time"
                                value="{{ $activity->time }}" />
                            <label for="time">Jam</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="activity" name="activity" class="form-control" placeholder="Seminar"
                                value="{{ $activity->name }}" />
                            <label for="activity">Kegiatan</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="location" name="location" class="form-control"
                                placeholder="Gedung Seminar" value="{{ $activity->location }}" />
                            <label for="location">Lokasi</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="pic" name="pic" class="form-control" placeholder="Budi"
                                value="{{ $activity->person_in_charge }}" />
                            <label for="pic">PIC</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="phone_number" name="phone_number" class="form-control"
                                placeholder="08172777777" value="{{ $activity->phone_number }}" />
                            <label for="phone_number">No HP</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="file" id="file" class="form-control" name="file" />
                            <label for="file">File Undangan</label>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
