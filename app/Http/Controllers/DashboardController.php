<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\IgloohomeProduct;
use App\Models\WellwayProduct;
use App\Models\DashboardNote;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::latest()->paginate(10);

        $notes = DashboardNote::with('user')
            ->latest()
            ->take(10)
            ->get();

        $summary = [
            'total_products' => Product::count(),
            'total_igloohome_products' => IgloohomeProduct::count(),
            'total_wellway_products' => WellwayProduct::count(),
            'total_igloohome_value' => IgloohomeProduct::sum(DB::raw('stock * buy_price')),
            'total_wellway_value' => WellwayProduct::sum(DB::raw('stock * buy_price')),
        ];

        return view('dashboard', compact('products', 'summary', 'notes'));
    }

    public function storeNote(Request $request)
    {
        $request->validate([
            'note'  => ['required', 'string', 'max:1000'],
            'color' => ['nullable', 'in:yellow,blue,green'],
        ]);

        DashboardNote::create([
            'note'    => $request->note,
            'color'   => $request->color ?? 'yellow',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Note saved successfully.');
    }

    public function destroyNote(DashboardNote $note)
    {
        $note->delete();

        return redirect()->route('dashboard')->with('success', 'Note deleted successfully.');
    }

}