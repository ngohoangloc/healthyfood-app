<div>
    <div class="container-xl">
        <div wire:loading >
            <div class="la-ball-clip-rotate" style="display:flex; justify-content: center; align-items: center; background-color: black; position: fixed; top: 0px; left: 0px; z-index: 9999; width: 100%; height: 100%; opacity: 0.75;">
                <div></div>
            </div>
        </div>
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-bitbucket">
                    @if ($selectedTable != null)
                        {{ $selectedTable['name'] }}
                    @endif
                </h2>
                <div class="text-muted mt-1">1-12 of 241 photos</div>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <div class="me-3">
                        <div class="input-icon">
                            <input type="text" value="" class="form-control" placeholder="Nhập mã hoặc tên món..."
                                wire:model="searchInput.searchDish">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
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
        <div class="row row-cards pt-5">
            @foreach ($items as $item)
                <div class="col-sm-6 col-lg-2 col-md-2">
                    <div class="card card-sm" style="height:120px;">
                        <a href="#" class="card card-link" wire:click="addItemToOrder({{$item}})">
                            <div class="card-stamp text-end">
                                <img height="100%" style="object-fit:contain;" src="{{ asset($item->imgPath) }}"
                                    class="card-img-top">
                            </div>
                            <div class="card-body text-vimeo py-0">
                                <div class="text-center">
                                    <h3>{{ $item->name }}</h3>
                                    <span>
                                        {{ $item->prices->first()->price }} {{ $item->unit->name }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
