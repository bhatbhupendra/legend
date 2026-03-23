<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{
    public function products(){

        $products = Product::latest()->paginate(10);

        return view('igloohome.products',compact('products'));

    }

    public function store(Request $request){
        $validated = $request->validate([

            'redirect_id'=>'required|string|max:255',

            'sku'=>'required|string|max:255|unique:igloohome_products,sku',

            'name_en'=>'required|string|max:255',

            'name_jp'=>'nullable|string|max:255',

            'category'=>'nullable|string|max:100',
            
            'description'=>'nullable|string|max:500',

        ]);


        DB::transaction(function() use ($validated){
            $product = Product::create([

                'redirect_id'=>$validated['redirect_id'],

                'sku'=>$validated['sku'],

                'name_en'=>$validated['name_en'],

                'name_jp'=>$validated['name_jp'] ?? null,

                'category'=>$validated['category'] ?? null,

                'description'=>$validated['description'] ?? null,

            ]);

        });


        return redirect()->route('dashboard')
            ->with('success','Product created');

    }
}