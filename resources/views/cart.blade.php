<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            padding: 20px;
            margin: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .cart-table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .cart-table th {
            background-color: #007bff;
            color: white;
        }
        .total-row td {
            font-weight: bold;
            font-size: 18px;
            background-color: #f5f5f5;
        }
        .qty-btn {
            padding: 5px 10px;
            font-size: 16px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
            margin: 0 5px;
        }
        .empty-message {
            text-align: center;
            font-size: 20px;
            margin-top: 50px;
            color: #777;
        }
        .back-link {
            text-align: center;
            margin-bottom: 20px;
        }
        .back-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .checkout-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .checkout-btn a button {
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Your Cart</h1>

    <div class="back-link">
        <a href="{{ route('products.index') }}">← Continue Shopping</a>
    </div>

    @if (session('cart') && count(session('cart')) > 0)
    <table class="cart-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price (₹)</th>
                <th>Quantity</th>
                <th>Subtotal (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $id => $item)
            <tr id="row-{{ $id }}">
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['price'] }}</td>
                <td>
                    <button class="qty-btn" data-id="{{ $id }}" data-action="decrement">−</button>
                    <span id="qty-{{ $id }}">{{ $item['quantity'] }}</span>
                    <button class="qty-btn" data-id="{{ $id }}" data-action="increment">+</button>
                </td>
                <td>₹<span id="item-total-{{ $id }}">{{ $item['price'] * $item['quantity'] }}</span></td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3">Total</td>
                <td>₹<span id="cart-total">{{ $total }}</span></td>
            </tr>
        </tbody>
    </table>

    <div class="checkout-btn">
        <a href="{{ route('cart.checkout') }}">
            <button>Proceed to Checkout</button>
        </a>
    </div>

    @else
        <p class="empty-message">Your cart is empty 😔</p>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.qty-btn').click(function () {
            let productId = $(this).data('id');
            let action = $(this).data('action');

            $.ajax({
                url: '{{ route("cart.update") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                    action: action
                },
                success: function (response) {
                    if (response.removed) {
                        $('#row-' + productId).remove();
                    } else {
                        $('#qty-' + productId).text(response.quantity);
                        $('#item-total-' + productId).text(response.item_total);
                    }

                    $('#cart-total').text(response.cart_total);

                    if ($('.cart-table tbody tr').length === 1) {
                        $('.cart-table').remove();
                        $('body').append('<p class="empty-message">Your cart is empty 😔</p>');
                        $('.checkout-btn').remove();
                    }
                },
                error: function () {
                    alert('Something went wrong.');
                }
            });
        });
    </script>

</body>
</html>
