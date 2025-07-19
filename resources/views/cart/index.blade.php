<!DOCTYPE html>
<html>
<head>
    <title>Our Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            padding: 10px 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            margin: 30px 0;
        }
        .products-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            padding: 20px;
        }
        .product {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 250px;
            padding: 15px;
            transition: transform 0.3s;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            width: 100%;
            border-radius: 8px;
            height: 200px;
            object-fit: cover;
        }
        .product h2 {
            font-size: 20px;
            margin: 10px 0 5px;
        }
        .product p {
            color: #555;
            font-size: 14px;
        }
        .price {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .qty-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        .qty-btn {
            background-color: #ccc;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .qty-input {
            width: 40px;
            text-align: center;
            margin: 0 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/">Home</a>
        <a href="/products">Products</a>
        <a href="/cart">Cart</a>
    </nav>

    <h1>Our Products</h1>

    <div class="products-container">
        @foreach ($products as $product)
        <div class="product">
            <img src="{{ $product->image }}" alt="{{ $product->name }}">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p class="price">₹{{ $product->price }}</p>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                
                <div class="qty-wrapper">
                    <button type="button" class="qty-btn" onclick="decrementQty({{ $product->id }})">−</button>
                    <input type="text" name="quantity" id="qty-{{ $product->id }}" value="1" class="qty-input" readonly>
                    <button type="button" class="qty-btn" onclick="incrementQty({{ $product->id }})">+</button>
                </div>

                <button type="submit" class="btn">Add to Cart</button>
            </form>
        </div>
        @endforeach
    </div>

    <script>
        function incrementQty(id) {
            let qtyInput = document.getElementById('qty-' + id);
            let current = parseInt(qtyInput.value);
            qtyInput.value = current + 1;
        }

        function decrementQty(id) {
            let qtyInput = document.getElementById('qty-' + id);
            let current = parseInt(qtyInput.value);
            if (current > 1) {
                qtyInput.value = current - 1;
            }
        }
    </script>

</body>
</html>
