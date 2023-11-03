<div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards"
                style="
                display: flex;
                height: 100vh;
                ">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-tables" class="nav-link active"
                                        data-bs-toggle="tab">
                                        <img width="24"src="https://img.icons8.com/color/24/tablecloth.png" alt="tablecloth"/>
                                        <b class="px-2">PHÒNG/BÀN</b>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-menu" class="nav-link " id="tab-menu"
                                        data-bs-toggle="tab">
                                        <img width="24" height="24" src="https://img.icons8.com/3d-fluency/94/tableware.png" alt="tableware"/>
                                        <b class="px-2">THỰC ĐƠN</b>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-tables">
                                    <livewire:cashier.select-table-component />
                                </div>
                                <div class="tab-pane" id="tabs-menu">
                                    <livewire:cashier.select-dish-component />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 px-0">
                    <div class="card">
                        <livewire:cashier.order-detail-component />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
