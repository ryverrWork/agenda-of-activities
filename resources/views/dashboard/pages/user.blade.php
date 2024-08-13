@extends('layouts/layoutMaster')

@section('title', 'Pengguna')

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
    @vite(['resources/assets/js/tables-datatables-users.js'])
@endsection

@section('content')
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Terakhir Diupdate</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Modal to add new user -->
    <div class="offcanvas offcanvas-end" id="add-new-user">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Pengguna</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-2">
            <form class="add-new-user pt-0 row g-3" id="form-add-new-user" action="{{ route('dashboard.users.store') }}"
                method="POST">
                @csrf
                @method('POST')
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="name2" class="input-group-text"><i class="ri-calendar-event-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="name" class="form-control dt-name" name="name"
                                placeholder="Budi" aria-label="name" aria-describedby="name2" />
                            <label for="name">Nama</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="email2" class="input-group-text"><i class="ri-time-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="email" id="email" class="form-control dt-email" name="email"
                                aria-label="email" aria-describedby="email2" />
                            <label for="email">Email</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-custom-password-toggle">
                        <div class="input-group input-group-merge">
                            <span id="password2" class="input-group-text"><i class="ri-lock-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="password" id="password" class="form-control dt-password" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-label="password" aria-describedby="password2" />
                                <label for="password">Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-custom-password-toggle">
                        <div class="input-group input-group-merge">
                            <span id="confirm_password2" class="input-group-text"><i
                                    class="ri-lock-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="password" id="confirm_password" class="form-control dt-confirm-password"
                                    name="confirm_password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-label="confirm_password" aria-describedby="confirm_password2" />
                                <label for="confirm_password">Konfirmasi Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="role2" class="input-group-text"><i class="ri-user-settings-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <select class="form-select dt-role" id="role" name="role" aria-label="role"
                                aria-describedby="role2">
                                <option selected disabled value="">Pilih role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <label for="role">Role</label>
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
