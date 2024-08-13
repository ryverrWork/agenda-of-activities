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
    @vite(['resources/assets/js/user-edit-form.js'])
@endsection

@section('content')
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Pengguna</h5>
                </div>
                <div class="card-body">
                    <form id="form-edit-user" action="{{ route('dashboard.users.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12">
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Budi"
                                    value="{{ $user->name }}" />
                                <label for="name">Nama</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="user@example.com" value="{{ $user->email }}" />
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer mb-6"><i
                                            class="ri-eye-off-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="form-control"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <label for="confirm_password">Konfirmasi Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer mb-6"><i
                                            class="ri-eye-off-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-floating form-floating-outline mb-6">
                                <select class="form-select" id="role" name="role">
                                    <option disabled value="">Pilih role</option>
                                    <option @if ($user->role == 'admin') selected @endif value="admin">Admin</option>
                                    <option @if ($user->role == 'user') selected @endif value="user">User</option>
                                </select>
                                <label for="role">Role</label>
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
