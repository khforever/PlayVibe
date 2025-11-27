@extends('layouts.dashboard.app')

@section('title')
Cart

@endsection


@section('content')
<div class="app-content content mt-4">

{{-- <div class="container mt-4"> --}}

    <h2 class="m-4 text-center ">All Carts</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            @if($carts->count() > 0)

                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Cart ID</th>
                            <th>Total Items</th>
                            <th>Total Price</th>
                            <th>Created At</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($carts as $index => $cart)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>{{ $cart->user->name }}</td>

                                <td>{{ $cart->id }}</td>

                                <td>{{ $cart->items->count() }}</td>

                                <td>
                                    {{ $cart->items->sum('total_price') }} KD
                                </td>

                                <td>{{ $cart->created_at->format('Y-m-d') }}</td>

                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse"
                                            data-bs-target="#cartItems{{ $cart->id }}">
                                        View Items
                                    </button>
                                </td>
                            </tr>

                            {{-- Items Collapse Section --}}
                            <tr>
                                <td colspan="7" class="p-0 border-0">
                                    <div id="cartItems{{ $cart->id }}" class="collapse">

                                        <table class="table table-sm table-striped mb-0">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th>Variant ID</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($cart->items as $item)
                                                    <tr>
                                                        <td>{{ $item->product_variant_id }}</td>
                                                        <td>{{ $item->variant->product->name }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->price }} </td>
                                                        <td>{{ $item->total_price }}</td>
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
                <p class="text-center text-muted">No carts found.</p>
            @endif

        </div>
    </div>

{{-- </div> --}}



</div>
@endsection
