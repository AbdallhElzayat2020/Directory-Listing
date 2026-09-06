@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Order-Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Order Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Invoice {{ $order->id }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print" id="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $order->order_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong> <span class="text-danger">{{$order->user->name}}</span>
                                        <br>
                                        <strong>Email:</strong> <span class="text-danger">{{$order->user->email}}</span>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Method:</strong> <span class="text-danger"> {{$order->payment_method}} </span>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{date('F d, Y', strtotime($order->created_at)) }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Pay In</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>{{$order->package->name}}</td>
                                        <td class="text-center">{{$order->base_amount . $order->base_currency}}</td>
                                        <td class="text-center">{{$order->paid_amount . $order->paid_currency}}</td>
                                        <td class="text-right">{{$order->base_amount . $order->paid_currency}}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="row mt-4">

                                {{-- Update Order Payment Status --}}
                                <div class="col-lg-8  d-print-none">
                                    <div class="section-title">Change Payment Status</div>
                                    <p class="section-lead">Update the payment status of this order.</p>
                                    <div class="col-md-3">
                                        <form action="{{ route('admin.orders.update',$order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <select name="payment_status" id="payment_status" class="form-control">
                                                <option @selected(old('payment_status', $order->payment_status) == 'pending') value="pending">Pending</option>
                                                <option @selected(old('payment_status', $order->payment_status) == 'completed') value="completed">Completed</option>
                                                <option @selected(old('payment_status', $order->payment_status) == 'failed') value="failed">Failed</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-right">
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{$order->paid_amount . $order->paid_currency}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <button class="btn btn-warning btn-icon icon-left" onclick="printPageArea('invoice-print')"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

    <script>

        function printPageArea(areaId) {
            var printContent = document.getElementById(areaId).innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;

        }
    </script>

@endpush
