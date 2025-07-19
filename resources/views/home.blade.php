<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My E-Commerce Site </title>
    <style>
   
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #2d2d2d;
            padding: 20px 0;
            text-align: center;
            color: white;
        }
        header h1 {
            color: rgba(247, 249, 250, 1); 
        }

        nav {
            background-color: #444;
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }

        nav a:hover {
            background-color: #007BFF;
        }

        main {
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 2.5rem;
        }

        p {
            color: #666;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <header>
        <h1>My E-Commerce Site</h1>
    </header>

    <nav>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('cart.index') }}">Cart</a>
    </nav>

    <main>
        <h1>Welcome to Our Store!</h1>
        <p>Find the best furniture at unbeatable prices.</p>
    </main>

</body>
</html>
