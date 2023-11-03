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
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn btn-dark" wire:click.prevent="addIngredient">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Thêm nguyên liệu
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
                                                <th class="w-8">#</th>
                                                <th class="w-8">Mã</th>
                                                <th>Thành phẩm</th>
                                                <th class="w-8">Đơn vị</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($processedFoods as $processedFood)
                                            <tr wire:click="selectProcessedFood({{$processedFood}})" class="@if($selectingProcessedFood && $selectingProcessedFood->id === $processedFood->id) table-info @endif">
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
                        @if($selectingProcessedFood)
                        <div class="mb-3">
                            <div class="card-header">
                                <h3 class="card-title">{{$selectingProcessedFood->name}}</h3>
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th class="w-8">#</th>
                                        <th class="w-33">Nguyên liệu</th>
                                        <th>Số lượng</th>
                                        <th>Đơn vị</th>
                                        <th class="w-8"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($selectingProcessedFood)
                                        @foreach ($selectingProcessedFood->ingredientDetails as $ingredientDetail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ingredientDetail->ingredient->name }}</td>
                                            <td>{{ $ingredientDetail->quantity }}</td>
                                            <td>{{ $ingredientDetail->ingredient->unit->symbol }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-success mx-2">
                                                    <i class="ti ti-device-floppy"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end mt-2">
                        {{-- {{ $areas->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

