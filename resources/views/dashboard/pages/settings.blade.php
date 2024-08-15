@extends('layouts/layoutMaster')

@section('title', ' Edit Kegiatan')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/profile-form.js'])
@endsection

@section('content')
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <form id="form-edit-user" action="{{ route('dashboard.settings.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="file" id="file" class="form-control" name="file" />
                                <label for="file">Logo</label>
                            </div>
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
