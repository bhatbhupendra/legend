<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::latest()->paginate(10);

        $summary = [
            'total_products' => Product::count(),
        ];

        return view('dashboard', compact('products', 'summary'));
    }

}