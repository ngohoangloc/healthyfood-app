<div>
    <!-- Page header -->
    <div class="page-header d-print-none text-white">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        THIẾT LẬP BÀN
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn btn-dark" wire:click.prevent="addTable">
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
                                        <th class="w-8">#</th>
                                        <th class="w-33">Tên bàn</th>
                                        <th>Khu vực</th>
                                        <th>Số chổ</th>
                                        <th>Trạng thái</th>
                                        <th class="w-8"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tables as $table)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-muted">
                                                {{ $table->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $table->area->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $table->seats }}
                                            </td>
                                            <td class="text-muted">
                                                <?= $table->status == 0 ? '<span class="badge bg-green-lt">Bàn trống</span>' : ( $table->status == 1 ? '<span class="badge bg-primary-lt">Đang gọi món</span>' : '<span class="badge bg-danger-lt">Đang dùng bữa</span>' )?>
                                            </td>
                                            <td style="font-size: 1rem;">
                                                <a href="" class="text-primary"
                                                    wire:click.prevent="editTable({{ $table }})">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="" class="text-danger"
                                                    wire:click.prevent="confirmTableRemoval({{ $table->id }})">
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
                        {{ $tables->links() }}
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
                    wire:submit.prevent="<?= $showEditModal ? 'updateTable' : 'createTable' ?>">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $showEditModal ? 'Chỉnh sửa' : 'Thêm' ?> khu vực</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Tên bàn</label>
                            <input wire:model.defer="state.name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="table-name"
                                placeholder="Tên khu vực mới...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Số chổ ngồi</label>
                            <div class="row g-2">
                                <div class="col-5">
                                    <input wire:model.defer="state.seats" type="number"
                                        class="form-control @error('seats') is-invalid @enderror" name="table-seats">
                                </div>
                            </div>
                            @error('seats')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Khu vực</label>
                            <div class="row g-2">
                                <div class="col-5">
                                    <select name="area_id" class="form-select @error('area_id') is-invalid @enderror" wire:model.defer="state.area_id">
                                        <option selected hidden>Lựa chọn...</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
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
                    <div class="text-secondary">Bạn có chắc muốn xóa vĩnh viễn bàn này không?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Hủy
                                </a></div>
                            <div class="col"><a href="#" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal" wire:click.prevent="removeTable">
                                    Xóa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
