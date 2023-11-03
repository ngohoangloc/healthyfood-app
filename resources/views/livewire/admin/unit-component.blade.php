<div>
    <!-- Page header -->
    <div class="page-header d-print-none text-white">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        ĐƠN VỊ TÍNH
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn btn-dark" wire:click.prevent="addUnit">
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
                                        <th class="w-8">Ký hiệu</th>
                                        <th class="w-25">Tên đơn vị</th>
                                        <th>Mô tả</th>
                                        <th class="w-8"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($units as $unit)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-muted">
                                                {{ $unit->symbol }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $unit->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $unit->desc }}
                                            </td>
                                            <td style="font-size: 1rem;">
                                                <a href="" class="text-primary"
                                                    wire:click.prevent="editUnit({{ $unit }})">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="" class="text-danger"
                                                    wire:click.prevent="confirmUnitRemoval({{ $unit->id }})">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-start mt-2">
                        {{ $units->links() }}
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
                    wire:submit.prevent="<?= $showEditModal ? 'updateUnit' : 'createUnit' ?>">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $showEditModal ? 'Chỉnh sửa' : 'Thêm' ?> đơn vị tính</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Ký hiệu đơn vị</label>
                            <input wire:model.defer="state.symbol" type="text"
                                class="form-control @error('symbol') is-invalid @enderror" name="symbol"
                                placeholder="Ký hiệu...">
                            @error('symbol')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên đơn vị</label>
                            <input wire:model.defer="state.name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Tên đơn vị tính mới...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea rows="5" class="form-control @error('desc') is-invalid @enderror"
                                placeholder="Nhập mô tả chi tiết..." wire:model.defer="state.desc"></textarea>
                            @error('desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                    <div class="text-secondary">Bạn có chắc muốn xóa vĩnh viễn đơn vị tính này không?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Hủy
                                </a></div>
                            <div class="col"><a href="#" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal" wire:click.prevent="removeUnit">
                                    Xóa
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
