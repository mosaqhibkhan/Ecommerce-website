<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Modern Sofa',
                'description' => 'Comfortable 3-seater sofa with premium cushions.',
                'price' => 999,
                'image' => 'https://m.media-amazon.com/images/I/71iVP8CZyBL._SL1440_.jpg',
            ],
            [
                'id' => 2,
                'name' => 'Dining Table',
                'description' => 'Elegant dining table set with 4 side chairs.',
                'price' => 1499,
                'image' => 'https://starmodernfurniture.com/media/catalog/product/cache/1/thumbnail/9df78eab33525d08d6e5fb8d27136e95/s/q/square_dining_table_with_side_chairs_in_dark_cherry_finish.jpg',
            ],
            [
                'id' => 3,
                'name' => 'Queen Bed',
                'description' => 'Stylish queen-size bed with strong wooden frame.',
                'price' => 799,
                'image' => 'https://i5.walmartimages.com/asr/d415873a-8bae-4d37-b5d7-18090d6b3527.52a8245bded6b40cbc7ae386d3e3cdeb.jpeg',
            ]
        ];

        return view('products', compact('products')); // Pass products to view
    }
}
