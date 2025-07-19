<!DOCTYPE html>
<html>
<head>
    <title>My E-Commerce Site</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="container">
        <h1>My E-Commerce Website</h1>
        <nav>
            <a href="{{ url('/') }}">Home</a> |
            <a href="{{ url('/products') }}">Products</a> |
            <a href="{{ url('/cart') }}">Cart</a>
        </nav>
        <hr>

        @yield('content')
    </div>

</body>
</html>
