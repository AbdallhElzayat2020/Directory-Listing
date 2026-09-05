@if($order->payment_status == 'completed')
    <span class="badge bg-success text-black">Paid</span>
@elseif($order->payment_status == 'pending')
    <span class="badge bg-warning text-black">Pending</span>
@else
    <span class="badge bg-danger text-white">Failed</span>
@endif

