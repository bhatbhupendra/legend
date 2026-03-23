<?php

namespace App\Http\Controllers;

use App\Models\WellwayProduct;
use App\Models\WellwayStockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WellwayProductController extends Controller
{
    public function index(){
        $products = WellwayProduct::latest()->paginate(10);

        $summary = [
            'total_products' => WellwayProduct::count(),
            'total_stock'    => WellwayProduct::sum('stock'),
            'low_stock'      => WellwayProduct::where('stock', '<=', 5)->count(),
        ];

        return view('wellway.index', compact('products', 'summary'));
    }

    public function create(){
        return view('wellway.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'sku'           => 'required|string|max:255|unique:wellway_products,sku',
            'name_en'       => 'required|string|max:255',
            'name_jp'       => 'nullable|string|max:255',
            'color'         => 'nullable|string|max:100',
            'hinge'         => 'nullable|string|max:100',
            'buy_price'     => 'nullable|numeric',
            'opening_stock' => 'nullable|integer|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $openingStock = $validated['opening_stock'] ?? 0;

            $product = WellwayProduct::create([
                'sku'        => $validated['sku'],
                'name_en'    => $validated['name_en'],
                'name_jp'    => $validated['name_jp'] ?? null,
                'color'      => $validated['color'] ?? null,
                'hinge'      => $validated['hinge'] ?? null,
                'buy_price'  => $validated['buy_price'] ?? null,
                'stock'      => $openingStock,
                'is_active'  => true,
            ]);

            if ($openingStock > 0) {
                WellwayStockMovement::create([
                    'order_id'           => null,
                    'product_id'         => $product->id,
                    'type'               => 'in',
                    'qty'                => $openingStock,
                    'movement_date'      => now()->toDateString(),
                    'requested_by'       => null,
                    'shipped_by'         => null,
                    'shipped_to'         => null,
                    'shipped_on'         => null,
                    'status'             => 'initialized',
                    'tracking_number'    => null,
                    'carrier'            => null,
                    'reference_document' => null,
                    'stock_before'       => 0,
                    'stock_after'        => $openingStock,
                    'note'               => 'Opening stock',
                    'user_id'            => auth()->id(),
                ]);
            }
        });

        return redirect()->route('wellway.index')->with('success', 'Wellway product created successfully.');
    }

    public function edit(WellwayProduct $wellway){
        return view('wellway.edit', ['product' => $wellway]);
    }

    public function update(Request $request, WellwayProduct $wellway){
        $validated = $request->validate([
            'sku'        => 'required|string|max:255|unique:wellway_products,sku,' . $wellway->id,
            'name_en'    => 'required|string|max:255',
            'name_jp'    => 'nullable|string|max:255',
            'color'      => 'nullable|string|max:100',
            'hinge'      => 'nullable|string|max:100',
            'buy_price'  => 'nullable|numeric',
        ]);

        $wellway->update([
            'sku'        => $validated['sku'],
            'name_en'    => $validated['name_en'],
            'name_jp'    => $validated['name_jp'] ?? null,
            'color'      => $validated['color'] ?? null,
            'hinge'      => $validated['hinge'] ?? null,
            'buy_price'  => $validated['buy_price'] ?? null,
            'is_active'  => $request->has('is_active'),
        ]);

        return redirect()->route('wellway.index')->with('success', 'Wellway product updated successfully.');
    }

    public function destroy(WellwayProduct $wellway){
        $wellway->delete();

        return redirect()->route('wellway.index')->with('success', 'Wellway product deleted successfully.');
    }

    public function stockInForm(WellwayProduct $wellway){
        return view('wellway.stock-in', ['product' => $wellway]);
    }

    public function stockIn(Request $request, WellwayProduct $wellway){
        $validated = $request->validate([
            'order_id'           => 'nullable|string|max:255',
            'qty'                => 'required|integer|min:1',
            'movement_date'      => 'required|date',
            'requested_by'       => 'nullable|string|max:255',
            'shipped_by'         => 'nullable|string|max:255',
            'shipped_to'         => 'nullable|string|max:255',
            'shipped_on'         => 'nullable|date',
            'status'             => 'nullable|string|max:50',
            'tracking_number'    => 'nullable|string|max:255',
            'carrier'            => 'nullable|string|max:255',
            'reference_document' => 'nullable|string|max:255',
            'note'               => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $wellway) {
            $stockBefore = $wellway->stock;
            $stockAfter  = $stockBefore + $validated['qty'];

            $wellway->update([
                'stock' => $stockAfter,
            ]);

            WellwayStockMovement::create([
                'order_id'           => $validated['order_id'] ?? null,
                'product_id'         => $wellway->id,
                'type'               => 'in',
                'qty'                => $validated['qty'],
                'movement_date'      => $validated['movement_date'],
                'requested_by'       => $validated['requested_by'] ?? null,
                'shipped_by'         => $validated['shipped_by'] ?? null,
                'shipped_to'         => $validated['shipped_to'] ?? null,
                'shipped_on'         => $validated['shipped_on'] ?? null,
                'status'             => $validated['status'] ?? 'initialized',
                'tracking_number'    => $validated['tracking_number'] ?? null,
                'carrier'            => $validated['carrier'] ?? null,
                'reference_document' => $validated['reference_document'] ?? null,
                'stock_before'       => $stockBefore,
                'stock_after'        => $stockAfter,
                'note'               => $validated['note'] ?? 'New inventory received',
                'user_id'            => auth()->id(),
            ]);
        });

        return redirect()->route('wellway.index')->with('success', 'Stock added successfully.');
    }

    public function stockOutForm(WellwayProduct $wellway){
        return view('wellway.stock-out', ['product' => $wellway]);
    }

    public function stockOut(Request $request, WellwayProduct $wellway){
        $validated = $request->validate([
            'order_id'           => 'nullable|string|max:255',
            'qty'                => 'required|integer|min:1',
            'movement_date'      => 'required|date',
            'requested_by'       => 'nullable|string|max:255',
            'shipped_by'         => 'nullable|string|max:255',
            'shipped_to'         => 'nullable|string|max:255',
            'shipped_on'         => 'nullable|date',
            'status'             => 'nullable|string|max:50',
            'tracking_number'    => 'nullable|string|max:255',
            'carrier'            => 'nullable|string|max:255',
            'reference_document' => 'nullable|string|max:255',
            'note'               => 'nullable|string|max:255',
        ]);

        if ($validated['qty'] > $wellway->stock) {
            return back()->withErrors([
                'qty' => 'Not enough stock available.',
            ])->withInput();
        }

        DB::transaction(function () use ($validated, $wellway) {
            $stockBefore = $wellway->stock;
            $stockAfter  = $stockBefore - $validated['qty'];

            $wellway->update([
                'stock' => $stockAfter,
            ]);

            WellwayStockMovement::create([
                'order_id'           => $validated['order_id'] ?? null,
                'product_id'         => $wellway->id,
                'type'               => 'out',
                'qty'                => $validated['qty'],
                'movement_date'      => $validated['movement_date'],
                'requested_by'       => $validated['requested_by'] ?? null,
                'shipped_by'         => $validated['shipped_by'] ?? null,
                'shipped_to'         => $validated['shipped_to'] ?? null,
                'shipped_on'         => $validated['shipped_on'] ?? null,
                'status'             => $validated['status'] ?? 'initialized',
                'tracking_number'    => $validated['tracking_number'] ?? null,
                'carrier'            => $validated['carrier'] ?? null,
                'reference_document' => $validated['reference_document'] ?? null,
                'stock_before'       => $stockBefore,
                'stock_after'        => $stockAfter,
                'note'               => $validated['note'] ?? 'Product sold',
                'user_id'            => auth()->id(),
            ]);
        });

        return redirect()->route('wellway.index')->with('success', 'Stock removed successfully.');
    }

    public function movements(WellwayProduct $wellway){
        $movements = $wellway->stockMovements()
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('wellway.movements', [
            'product'   => $wellway,
            'movements' => $movements,
        ]);
    }

    public function allMovements(){
        $movements = WellwayStockMovement::with(['product', 'user'])
            ->latest()
            ->paginate(20);

        return view('wellway.all-movements', compact('movements'));
    }
    
    public function updateMovementStatus(Request $request, WellwayStockMovement $movement){
        $validated = $request->validate([
            'status' => 'required|in:initialized,processing,packed,shipped,delivered,completed,cancelled,returned',
        ]);

        $movement->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Movement status updated successfully.');
    }

    public function editMovement(WellwayStockMovement $movement){
        return view('wellway.edit-movement', compact('movement'));
    }
    public function updateMovement(Request $request, WellwayStockMovement $movement){
        $validated = $request->validate([
            'order_id' => 'nullable|string|max:255',
            'movement_date' => 'nullable|date',
            'requested_by' => 'nullable|string|max:255',
            'shipped_by' => 'nullable|string|max:255',
            'shipped_to' => 'nullable|string|max:255',
            'shipped_on' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'tracking_number' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
            'reference_document' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]);

        $movement->update($validated);

        return redirect()
            ->route('wellway.allMovements')
            ->with('success', 'Movement updated successfully.');
    }
}