<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e8f5e9; padding: 40px; text-align: center; }
        .card { background: white; max-width: 500px; margin: auto; padding: 20px; border-radius: 10px; }
        h2 { color: #28a745; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Thank you, {{ $order['name'] }}!</h2>
        <p>Your order has been placed successfully.</p>
        <p><strong>Total Paid:</strong> ₹{{ $order['total'] }}</p>
        <p>We'll deliver to:</p>
        <p>{{ $order['address'] }}</p>
        <a href="{{ route('home') }}">Return to Home</a>
    </div>
</body>
</html>
