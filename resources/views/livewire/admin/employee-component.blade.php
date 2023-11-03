<div>
    <!-- Page header -->
    <div class="page-header d-print-none text-white">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        NHÂN VIÊN
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn btn-dark" wire:click.prevent="addEmployee">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Thêm mới
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-cards">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nhân viên</th>
                                        <th>Vị trí</th>
                                        <th class="w-8">Tài khoản</th>
                                        <th class="w-25">Địa chỉ</th>
                                        <th>Điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-muted">{{ $employee->fullName }}</td>
                                            <td class="text-muted">{{ $employee->role->name }}</td>
                                            <td class="text-muted">{{ $employee->account->username }}</td>
                                            <td class="text-muted">{{ $employee->address }}</td>
                                            <td class="text-muted">{{ $employee->phone }}</td>
                                            <td class="text-muted">
                                                <?= $employee->account->active ? '<span class="badge bg-green-lt">Hoạt động</span>' : '<span class="badge bg-red-lt">Không hoạt động</span>' ?>
                                            </td>
                                            <td style="font-size: 1rem;">
                                                <a href="" class="text-primary"
                                                    wire:click.prevent="editEmployee({{ $employee }})">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="" class="text-danger"
                                                    wire:click.prevent="confirmEmployeeRemoval({{ $employee->account->id }})">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end mt-2">
                        {{ $employees->links() }}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Tìm kiếm</h3>
                            <div class="mb-3">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm..."
                                        wire:model.debounce.200ms="searchInput">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    Modal   --}}
    <div class="modal modal-blur fade" id="form" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form autocomplete="off"
                    wire:submit.prevent="<?= $showEditModal ? 'updateEmployee' : 'createEmployee' ?>">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $showEditModal ? 'Chỉnh sửa' : 'Thêm' ?> nhân viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Họ và Tên</label>
                            <input wire:model.defer="state.fullName" type="text"
                                class="form-control @error('fullName') is-invalid @enderror" name="user_name"
                                placeholder="VD: Nguyễn Văn A">
                            @error('fullName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Số điện thoại</label>
                            <input wire:model.defer="state.phone" type="text"
                                class="form-control @error('phone') is-invalid @enderror" name="user_phone"
                                placeholder="VD: 0886.992.212">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Địa chỉ</label>
                            <input wire:model.defer="state.address" type="text"
                                class="form-control @error('address') is-invalid @enderror" name="user_address"
                                placeholder="VD: 321/123, Đ. 3 Tháng 2, P. Xuân Khánh, Q. Ninh Kiều, TP. Cần Thơ">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Vị trí làm việc</label>
                            <select class="form-select @error('role_id') is-invalid @enderror"
                                wire:model.defer="state.role_id">
                                <option hidden>Lựa chọn...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tài khoản</label>
                            <input wire:model.defer="state.username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="user_username"
                                placeholder="username">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if (!$showEditModal)
                        <div class="mb-3">
                            <label class="form-label required">Mật khẩu</label>
                            <div class="input-group input-group-flat">
                                <input wire:model.defer="state.password" type="password"
                                    class="form-control @error('password') is-invalid @enderror input-password"
                                    name="user_password" autocomplete="off" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Nhập lại mật khẩu</label>
                            <div class="input-group input-group-flat">
                                <input wire:model.defer="state.password_again" type="password"
                                    class="form-control @error('password_again') is-invalid @enderror input-password"
                                    name="user_password_again" autocomplete="off" />
                                @error('password_again')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.defer="state.active">
                                <span class="form-check-label">Hoạt động</span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                            Hủy
                        </a>
                        <button class="btn btn-primary ms-auto" type="submit">
                            <?= $showEditModal ? 'Sửa' : 'Thêm' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="delete-modal" tabindex="-1">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Xác nhận xóa?</h3>
                    <div class="text-secondary">Bạn có chắc muốn xóa vĩnh viễn nhóm hàng hóa này không?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Hủy
                                </a></div>
                            <div class="col"><a href="#" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal" wire:click.prevent="removeEmployee">
                                    Xóa
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
