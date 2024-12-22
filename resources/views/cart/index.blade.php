<x-app-layout>

    <x-slot name="header">
        <h2>
            {{ __('Cart') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <h1>Your Shopping Cart</h1>

        <!-- Check if the cart is empty -->
        @if($cartItems->isEmpty())
            <div class="alert alert-info">Your cart is empty. Start shopping now!</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->product->price, 2) }}</td>
                            <td>Rp{{ number_format($item->total_price, 2) }}</td>
                            <td>
                                <!-- Update quantity -->
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control d-inline w-25" style="display: inline-block;">
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                </form>

                                <!-- Remove item -->
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Cart summary -->
            <div class="mt-3">
                <h4>Cart Summary</h4>
                <p>Total Items: {{ $cartCount }}</p>
                <p>Total Price: Rp{{ number_format($cartItems->sum('total_price'), 2) }}</p>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Checkout</button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
