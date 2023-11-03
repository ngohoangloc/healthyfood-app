<div>
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <select class="form-select" >
                    <option selected hidden value="0">Tất cả khu vực</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-3 d-flex justify-content-end">
            {{ $tables->links() }}
        </div>
    </div>
    <div class="row">
        @foreach ($tables as $table)
            <div class="col-lg-2 col-md-3 col-sm-6 py-2">
                <a class="card card-link text-bitbucket @if(isset($selectingTable->id) && ($selectingTable->id == $table->id)) border-2 border-primary @endif @if($table->status == 1) bg-primary-lt @elseif ($table->status == 2) bg-danger-lt @endif" href="#" wire:click="selectTable({{$table}})">
                    <div class="card-stamp text-end">
                        @if ($table->status == 0)
                            <img width="65%" src="https://img.icons8.com/wired/72/restaurant-table.png" alt="restaurant-table"/>
                        @elseif ($table->status == 1)
                            <img width="65%" src="https://img.icons8.com/dusk/72/restaurant-table.png" alt="restaurant-table"/>
                        @else
                            <img width="65%" src="https://img.icons8.com/dusk/72/waiter.png" alt="waiter"/>
                        @endif
                    </div>
                    <div class="card-body" style="height: 7.5rem;">
                        <div class="row">
                            <div class="col">
                                <h3>{{ $table->name }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-sm-start">
                                @if ($table->status != 0)
                                    <h4 class="text-danger mb-0"><?= number_format($table->totalAtTable()) ?></h4>
                                    <small class="mt-2"><i><?= $table->currentOrder()->date ?></i></small>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
