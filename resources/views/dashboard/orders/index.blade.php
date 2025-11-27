@extends('layouts.dashboard.app')

@section('title')
Orders

@endsection


@section('content')
<div class="app-content content mt-4">

{{--  --}}

    <h2 class="mb-4 text-center">All Orders</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            @if($orders->count() > 0)

                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Order ID</th>
                            <th>Total Items</th>
                            <th>Subtotal</th>
                            <th>Delivery</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>View Items</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>{{ $order->user->name }}</td>

                                <td>{{ $order->id }}</td>

                                <td>{{ $order->items->count() }}</td>

                                <td>{{ $order->subtotal }} </td>

                                <td>{{ $order->delivery_price }} </td>

                                <td>{{ $order->subtotal + $order->delivery_price }} </td>

                                <td>


                                  @if ($order->status == 1)
                                 <span class="badge bg-success">Active</span>
                                  @elseif ($order->status == 2)
                                  <span class="badge bg-danger">Cancelled</span>
                                    @else
                                     <span class="badge bg-secondary">Unknown</span>
                                    @endif


                                </td>

                                <td>
                                    <button class="btn btn-sm btn-success"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#orderItems{{ $order->id }}">
                                        View Items
                                    </button>
                                </td>
                            </tr>

                            {{-- Collapse Row --}}
                            <tr>
                                <td colspan="9" class="p-0 border-0">
                                    <div id="orderItems{{ $order->id }}" class="collapse">

                                        <table class="table table-sm table-striped mb-0">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($order->items as $item)
                                                    <tr>
                                                        <td>
                                                            {{ $item->product->name ?? 'Product Deleted' }}
                                                        </td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->price }} </td>
                                                        <td>{{ $item->total }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-center text-muted">No orders found.</p>
            @endif

        </div>
    </div>




{{--  --}}
</div>
@endsection
