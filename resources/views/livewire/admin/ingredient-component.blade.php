<div>
    <!-- Page header -->
    <div class="page-header d-print-none text-white">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h1 class="page-title">
                        KHAI BÁO ĐỊNH LƯỢNG
                    </h1>
                </div>
                @if ($selectingProcessedFood)
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="#" class="btn btn-dark" wire:click.prevent="showFormIngredient">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Nguyên liệu
                                </a>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-cards">
                <div class="col-lg-6">
                    <div class="card" style="min-height: 60vh;">
                        <div class="card-body">
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
                            <div class="mb-3">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped table-hover">
                                        <thead class="sticky-top thead-light">
                                            <tr>
                                                <th class="w-6">#</th>
                                                <th class="w-8">Mã</th>
                                                <th>Thành phẩm</th>
                                                <th class="w-8">Đơn vị</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($processedFoods as $processedFood)
                                                <tr wire:click="selectProcessedFood({{ $processedFood }})"
                                                    class="@if ($selectingProcessedFood && $selectingProcessedFood->id === $processedFood->id) table-info @endif">
                                                    <td scope="row" class="text-muted">{{ $loop->iteration }}</td>
                                                    <td class="text-muted">{{ $processedFood->id }}</td>
                                                    <td>
                                                        {{ $processedFood->name }}
                                                    </td>
                                                    <td class="text-muted">
                                                        {{ $processedFood->unit->symbol }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end mt-2">
                        {{ $processedFoods->links() }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" style="min-height: 60vh;">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th class="w-6">#</th>
                                        <th class="w-33">Nguyên liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị</th>
                                        <th class="w-8"></th>
                                        <th class="w-6"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($selectingProcessedFood)
                                        @foreach ($selectingProcessedFood->ingredientDetails as $ingredientDetail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ingredientDetail->ingredient->name }}</td>
                                                <td>
                                                @if (isset($state[$ingredientDetail->id]))
                                                    <input type="number" class="form-control" name="quantity"
                                                    wire:model.debounce.0ms="state.{{$ingredientDetail->id}}.quantity">
                                                @else
                                                    {{ $ingredientDetail->quantity }}
                                                @endif
                                                </td>
                                                <td>{{ $ingredientDetail->ingredient->unit->symbol }}</td>
                                                <td class="text-end">
                                                    @if (isset($state[$ingredientDetail->id]))
                                                        @if ($state[$ingredientDetail->id]['quantity'] != $ingredientDetail->quantity)
                                                            <button class="btn btn-outline-success"
                                                                style="height: 25%; width: 25%;"
                                                                wire:click="updateIngredient">
                                                                <i class="ti ti-device-floppy"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-outline-success"
                                                                style="height: 25%; width: 25%;" disabled>
                                                                <i class="ti ti-device-floppy"></i>
                                                            </button>
                                                        @endif
                                                        <button class="btn btn-outline-danger"
                                                            style="height: 25%; width: 25%;" wire:click="closeEdit">
                                                            <i class="ti ti-x"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-outline-primary"
                                                            style="height: 25%; width: 25%;"
                                                            wire:click="editIngredient({{ $ingredientDetail }})">
                                                            <i class="ti ti-edit"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-danger"
                                                        style="height: 25%; width: 25%;"
                                                        wire:click.prevent="confirmIngredientRemoval({{ $ingredientDetail->id }})">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    Modal   --}}
    @if ($selectingProcessedFood)
        <div class="modal modal-blur fade" id="form" tabindex="-1" role="dialog" aria-hidden="true"
            wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form autocomplete="off" wire:submit.prevent="addIngredient">
                        <div class="modal-header">
                            <h5 class="modal-title">Chi tiết định lượng Nguyên vật liệu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Thành phẩm</label>
                                <input type="text"
                                    class="form-control @error('ingredient_id') is-invalid @enderror"
                                    placeholder="{{ $selectingProcessedFood->name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Nguyên vật liệu</label>
                                <select class="form-select @error('ingredient_id') is-invalid @enderror"
                                    wire:model.defer="state.ingredient_id">
                                    <option hidden>Lựa chọn...</option>
                                    @foreach ($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                                @error('ingredient_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Số lượng</label>
                                <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                    wire:model="state.quantity">
                                @error('quantity')
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
                                Thêm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($selectingProcessedFood->ingredientDetails->count() !== 0)
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
                        <div class="text-secondary">Bạn có chắc muốn xóa định lượng này không?</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Hủy
                                    </a></div>
                                <div class="col"><a href="#" class="btn btn-danger w-100"
                                        data-bs-dismiss="modal" wire:click.prevent="removeIngredient">
                                        Xóa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
</div>
