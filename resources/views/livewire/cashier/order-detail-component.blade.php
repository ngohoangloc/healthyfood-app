<div>
    @if (!empty($orders) && count($orders) > 0)
        <div class="card-header" style="height: 10vh;">
            <div class="col-md-6 mt-3">
                <h3 class="text-azure">
                    {{ $selectedTable['name'] }}
                </h3>
            </div>
            <div class="col-md-6 text-end">
                <span class="text-danger">
                    <?= $orders[0]->date ?>
                </span>
            </div>
        </div>
        <div class="card-body p-0" style="height: 70vh;">
            <div class="table">
                <table class="table card-table" style="font-size: 95%;">
                    <thead>
                        <tr>
                            <th class="w-33">Món</th>
                            <th>SL</th>
                            <th>Giá</th>
                            <th>T.Tiền</th>
                            <th>N.Viên</th>
                            <th class="w-5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @foreach ($order->details as $orderDetail)
                                <tr @if ($order->status !== 0) @class(['text-danger' => true]) @endif>
                                    <td>{{ $orderDetail->item->name }}</td>
                                    <td
                                        @if ($order->status !== 0) @class(['text-danger' => true]) @else @class(['text-muted' => true]) @endif>
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td
                                        @if ($order->status !== 0) @class(['text-danger' => true]) @else @class(['text-muted' => true]) @endif>
                                        <?= number_format($orderDetail->item->prices->first()->price) ?>
                                    </td>
                                    <td
                                        @if ($order->status !== 0) @class(['text-danger' => true]) @else @class(['text-muted' => true]) @endif>
                                        <?= number_format($orderDetail->quantity * $orderDetail->item->prices->first()->price) ?>
                                    </td>
                                    <td>
                                        {{ $orderDetail->user->fullName }}
                                    </td>
                                    <td>
                                        <a href="" class="text-danger"
                                            wire:click.prevent="removeItemInOrder({{ $orderDetail->order_id }}, '{{ $orderDetail->item_id }}')">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer" style="height: 20vh;">
            <div class="row">
                <div class="col-12 text-end">
                    <h3>Tổng cộng: <?= number_format($order->table->totalAtTable()) . 'VND' ?></h3>
                </div>
            </div>

            <div class="row d-flex justify-content-between">
                <button wire:click="printDupe" class="btn btn-square btn-secondary mb-1" style="width: 45%;">
                    In Bếp
                </button>
                <button wire:click="printProvisionalInvoice" class="btn btn-square btn-primary mb-1"
                    style="width: 45%;">In P.Tạm tính</button>
                <button class="btn btn-square btn-success" style="width: 45%;">In Hóa đơn</button>
                <button class="btn btn-square btn-danger" style="width: 45%;">Lưu Hóa đơn</button>
            </div>
        </div>
        {{-- @if (!empty($printDupeOrder)) --}}
        <iframe id="iframe-dupe" style="display: none;" id="invoice-iframe" width="100%"
            height="500" frameborder="0"></iframe>
        {{-- @endif --}}

        <script>
            $(document).ready(function() {
                window.addEventListener('print-dupe', event => {
                    var iframe = document.getElementById('iframe-dupe');
                    iframe.src = '/cashier/generate-dupe/' + event.detail.orderId;
                    console.log(iframe.src);
                    iframe.onload = function() {
                        iframe.contentWindow.print();
                        iframe.remove();
                    };
                });
            });
        </script>
    @endif
</div>
