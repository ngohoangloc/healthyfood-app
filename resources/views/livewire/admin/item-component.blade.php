<div>
    <!-- Page header -->
    <div class="page-header d-print-none text-white">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        HÀNG HÓA
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn btn-dark" wire:click.prevent="addItem">
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
                <div class="col-lg-10">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table" >
                                <thead>
                                    <tr>
                                        <th class="w-5">#</th>
                                        <th>Mã hàng hóa</th>
                                        <th>Tên hàng hóa</th>
                                        <th>Đơn vị tính</th>
                                        <th>Nhóm hàng</th>
                                        <th>Loại hàng</th>
                                        <th>
                                            Giá vốn
                                            <span class="form-help" data-bs-toggle="popover" data-bs-placement="top"
                                                data-bs-html="true"
                                                data-bs-content="<p>Chi phí trung bình để tạo ra hàng hóa. Giá vốn của hàng hóa được cập nhật sau mỗi lần hàng hóa được nhập kho.</p>">?</span>
                                        </th>
                                        <th>
                                            Giá bán
                                            <span class="form-help" data-bs-toggle="popover" data-bs-placement="top"
                                                data-bs-html="true"
                                                data-bs-content="<p>Giá bán được thiết lập cho từng hàng hóa. Nguyên vật liệu không có giá bán</p>">?</span>
                                        </th>
                                        <th>Mô tả</th>
                                        <th class="w-8"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-muted">
                                                {{ $item->id }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $item->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $item->unit->symbol }}
                                            </td>
                                            <td class="text-muted">
                                                <?= isset($item->category->name) ? $item->category->name : '-' ?>
                                            </td>
                                            <td class="text-muted">
                                                <?= $item->type == 1 ? 'Hàng hóa' : ( $item->type == 2 ? 'Thành phẩm' : 'Nguyên vật liệu' ) ?>
                                            </td>
                                            <td class="text-muted text-end">
                                                <?= $item->costs->first() != null ? number_format($item->costs->first()->cost) . ' đ' : '0 đ' ?>
                                            </td>
                                            <td class="text-muted text-end">
                                                <?= $item->prices->first() != null ? number_format($item->prices->first()->price) . ' đ' : '-' ?>
                                            </td>
                                            <td class="text-muted">
                                                {{ $item->desc }}
                                            </td>
                                            <td style="font-size: 1rem;">
                                                <a href="" class="text-primary"
                                                    wire:click.prevent="editItem({{ $item }})">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="" class="text-danger"
                                                    wire:click.prevent="confirmItemRemoval('{{ $item->id }}')">
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
                        {{ $items->links() }}
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Tìm kiếm</h3>
                            <div class="mb-3">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm..."
                                        wire:model.debounce.200ms="search">
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
                            <div class="mb-3">
                                <div class="form-label">Loại hàng</div>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="byTypes"
                                            value="1">
                                        <span class="form-check-label">Hàng hóa</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="byTypes"
                                            value="2">
                                        <span class="form-check-label">Thành phẩm</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="byTypes"
                                            value="3">
                                        <span class="form-check-label">Nguyên vật liệu</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--    Modal   --}}
        <div class="modal modal-blur fade" id="form" tabindex="-1" role="dialog" aria-hidden="true"
            wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form autocomplete="off"
                        wire:submit.prevent="<?= $showEditModal ? 'updateItem' : 'createItem' ?>">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= $showEditModal ? 'Chỉnh sửa' : 'Thêm' ?> hàng hóa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label required">Tên hàng hóa</label>
                                <input wire:model.defer="state.name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="item_name"
                                    placeholder="Tên hàng hóa...">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="row">
                                        <div class="mb-3">
                                            <div class="form-label required">Loại hàng</div>
                                            <div>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="radios-inline" wire:model="state.type"
                                                        value="1"
                                                        title="Hàng hóa">
                                                    <span
                                                        class="form-check-label">Hàng hóa</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="radios-inline" wire:model="state.type"
                                                        value="2"
                                                        title="Thành phẩm">
                                                    <span
                                                        class="form-check-label">Thành phẩm</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="radios-inline" wire:model="state.type"
                                                        value="3"
                                                        title="Nguyên vật liệu">
                                                    <span
                                                        class="form-check-label">Nguyên vật liệu</span>
                                                </label>
                                            </div>
                                            @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Nhóm hàng</label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                wire:model.defer="state.category_id"
                                                <?= isset($state['type']) && $state['type'] == 3 ? 'disabled readonly' : '' ?>>
                                                <option hidden>Lựa chọn...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label required">Đơn vị tính</label>
                                            <select class="form-select @error('unit_id') is-invalid @enderror"
                                                wire:model.defer="state.unit_id">
                                                <option hidden>Lựa chọn...</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Giá bán</label>
                                            <div class="input-group mb-2">
                                                <input type="text"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    wire:model.defer="state.price"
                                                    <?= isset($state['type']) && $state['type'] == 3 ? 'disabled readonly' : '' ?>>
                                                <span class="input-group-text">
                                                    VND
                                                </span>
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label required">Tồn kho tối thiểu</label>
                                                <input type="text"
                                                    class="form-control @error('minInventoryLevel') is-invalid @enderror"
                                                    wire:model="state.minInventoryLevel" <?= isset($state['type']) && $state['type'] == 2 ? 'disabled readonly' : '' ?>>
                                                @error('minInventoryLevel')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label required">Tồn kho tối đa</label>
                                                <input type="text"
                                                    class="form-control @error('maxInventoryLevel') is-invalid @enderror"
                                                    wire:model="state.maxInventoryLevel" <?= isset($state['type']) && $state['type'] == 2 ? 'disabled readonly' : '' ?>>
                                                @error('maxInventoryLevel')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Hình ảnh</label>
                                            <div class="col avatar avatar-upload rounded" id="addItemImage">
                                                @if (isset($state['imgPath']) && $state['imgPath'] != null)
                                                    @if ($showEditModal && $updateItem->imgPath == $state['imgPath'])
                                                        <img style="width:64px;height:64px;object-fit: cover;"
                                                            src="{{ asset($state['imgPath']) }}"
                                                            alt="" />
                                                    @else
                                                        <img style="width:64px;height:64px;object-fit: cover;"
                                                            src="{{ $state['imgPath']->temporaryUrl() }}"
                                                            alt="" />
                                                    @endif
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 5l0 14" />
                                                        <path d="M5 12l14 0" />
                                                    </svg>
                                                    <span class="avatar-upload-text">Ảnh</span>
                                                @endif
                                            </div>
                                            <input wire:model="state.imgPath" type="file"
                                                class="form-control @error('imgPath') is-invalid @enderror"
                                                name="item_imgPath" id="imageInput" style="display: none;"
                                                accept="image/*">
                                            <div class="btn btn-sm btn-outline-danger" wire:click="clearImage">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-photo-x" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M15 8h.01"></path>
                                                    <path
                                                        d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7">
                                                    </path>
                                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3"></path>
                                                    <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0"></path>
                                                    <path d="M22 22l-5 -5"></path>
                                                    <path d="M17 22l5 -5"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả chi tiết</label>
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
                            <button class="btn btn-primary ms-auto" type="submit" wire:loading.attr="disabled">
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
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v2m0 4v.01" />
                            <path
                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                        <h3>Xác nhận xóa?</h3>
                        <div class="text-secondary">Bạn có chắc muốn xóa vĩnh viễn hàng hóa này không?</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Hủy
                                    </a></div>
                                <div class="col">
                                    <a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal"
                                        wire:click.prevent="removeItem">
                                        Xóa
                                        <div wire:loading wire:target="removeItem" wire:key="removeItem">
                                            <svg width="8" height="8" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <style>
                                                    .spinner_P7sC {
                                                        transform-origin: center;
                                                        animation: spinner_svv2 .75s infinite linear
                                                    }

                                                    @keyframes spinner_svv2 {
                                                        100% {
                                                            transform: rotate(360deg)
                                                        }
                                                    }
                                                </style>
                                                <path
                                                    d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"
                                                    class="spinner_P7sC" />
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
