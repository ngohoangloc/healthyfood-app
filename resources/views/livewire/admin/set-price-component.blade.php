<div>
    <div wire:loading wire:target="updatePrice">
        <div class="la-ball-clip-rotate" style="display:flex; justify-content: center; align-items: center; background-color: black; position: fixed; top: 0px; left: 0px; z-index: 9999; width: 100%; height: 100%; opacity: 0.75;">
            <div></div>
        </div>
    </div>
    <!-- Page header -->
    <div class="page-header d-print-none text-white">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        BẢNG GIÁ
                    </h2>
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
                            <table class="table table-vcenter card-table table-hover">
                                <thead>
                                    <tr>
                                        <th class="w-5">#</th>
                                        <th class="w-33">Tên hàng hóa</th>
                                        <th>Đơn vị tính</th>
                                        <th>Nhóm hàng</th>
                                        <th>Loại hàng</th>
                                        <th>Giá vốn</th>
                                        <th class="w-8">Giá bán</th>
                                        <th class="w-8"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
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
                                                <?= $item->type == 1 ? 'Hàng hóa' : ($item->type == 2 ? 'Thành phẩm' : 'Nguyên vật liệu') ?>
                                            </td>
                                            <td class="text-muted">
                                                0 đ
                                            </td>
                                            <td class="text-muted text-end">
                                                @if (isset($state[$item->id]))
                                                    <input type="number" class="form-control" name="price"
                                                    wire:model.debounce.0ms="state.{{$item->id}}.price">
                                                @else
                                                    <?= $item->prices->first() != null ? number_format($item->prices->first()->price) . ' đ' : '-' ?>
                                                @endif
                                            </td>
                                            <td class="text-muted text-center">
                                                @if (isset($state[$item->id]))
                                                    @if ($state[$item->id]['price'] != $item->prices->first()->price)
                                                        <button class="btn btn-sm btn-outline-success mx-2" wire:click="updatePrice">
                                                            <i class="ti ti-device-floppy"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline-success mx-2" disabled>
                                                            <i class="ti ti-device-floppy"></i>
                                                        </button>
                                                    @endif
                                                    <button class="btn btn-sm btn-outline-danger" wire:click="closeEdit">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary" wire:click="editPrice({{ $item }})">
                                                        <i class="ti ti-edit"></i>
                                                    </button>
                                                @endif
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
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Nhóm hàng hàng</div>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="byTypes"
                                            value="1">
                                        <span class="form-check-label">Hàng hóa</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
