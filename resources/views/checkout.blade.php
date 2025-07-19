<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        form { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; margin: 10px 0; padding: 10px; border-radius: 4px; border: 1px solid #ccc; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Checkout</h2>

    <p>Total: ₹{{ $total }}</p>

    <form method="POST" action="{{ route('cart.process') }}">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="address" placeholder="Delivery Address" required></textarea>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
