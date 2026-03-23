<?php

namespace App\Http\Controllers;

use App\Exports\IgloohomeProductsExport;
use App\Exports\IgloohomeMovementsExport;
use App\Models\IgloohomeProduct;
use App\Models\IgloohomeStockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class IgloohomeProductController extends Controller
{

    public function index(){

        $products = IgloohomeProduct::latest()->paginate(10);

        $summary = [

            'total_products' => IgloohomeProduct::count(),

            'total_stock' => IgloohomeProduct::sum('stock'),

            'low_stock' => IgloohomeProduct::where('stock','<=',5)->count(),

            'total_value' => IgloohomeProduct::sum(DB::raw('stock * buy_price')),

        ];

        return view('igloohome.index',compact('summary','products'));

    }

    public function products(){

        $products = IgloohomeProduct::latest()->paginate(10);

        return view('igloohome.products',compact('products'));

    }


    public function create(){
        return view('igloohome.create');
    }


    public function store(Request $request){
        $validated = $request->validate([

            'sku'=>'required|string|max:255|unique:igloohome_products,sku',

            'name_en'=>'required|string|max:255',

            'name_jp'=>'nullable|string|max:255',

            'color'=>'nullable|string|max:100',

            'opening_stock'=>'nullable|integer|min:0',

        ]);


        DB::transaction(function() use ($validated){

            $openingStock = $validated['opening_stock'] ?? 0;

            $product = IgloohomeProduct::create([

                'sku'=>$validated['sku'],

                'name_en'=>$validated['name_en'],

                'name_jp'=>$validated['name_jp'] ?? null,

                'color'=>$validated['color'] ?? null,

                'stock'=>$openingStock,

                'is_active'=>true,

            ]);


            if($openingStock > 0){

                IgloohomeStockMovement::create([

                    'product_id'=>$product->id,

                    'type'=>'in',

                    'qty'=>$openingStock,

                    'movement_date'=>now(),

                    'stock_before'=>0,

                    'stock_after'=>$openingStock,

                    'note'=>'Opening stock',

                    'user_id'=>auth()->id(),

                ]);

            }

        });


        return redirect()->route('igloohome.index')
            ->with('success','Product created');

    }


    public function edit(IgloohomeProduct $igloohome){
        return view('igloohome.edit', ['product' => $igloohome]);
    }

    public function update(Request $request, IgloohomeProduct $igloohome){
        $validated = $request->validate([
            'sku'        => 'required|string|max:255|unique:igloohome_products,sku,' . $igloohome->id,
            'name_en'    => 'required|string|max:255',
            'name_jp'    => 'nullable|string|max:255',
            'color'      => 'nullable|string|max:100',
            'buy_price'  => 'nullable|numeric',
        ]);

        $igloohome->update([
            'sku'        => $validated['sku'],
            'name_en'    => $validated['name_en'],
            'name_jp'    => $validated['name_jp'] ?? null,
            'color'      => $validated['color'] ?? null,
            'buy_price'  => $validated['buy_price'] ?? null,
            'is_active'  => $request->has('is_active'),
        ]);

        return redirect()->route('igloohome.index')->with('success', 'Igloohome product updated successfully.');
    }

    public function destroy(IgloohomeProduct $igloohome){
        $igloohome->delete();
        return redirect()->route('igloohome.index')->with('success', 'Igloohome product deleted successfully.');
    }

    public function stockInForm(IgloohomeProduct $igloohome){
        return view('igloohome.stock-in', ['product' => $igloohome]);
    }

    public function stockIn(Request $request, IgloohomeProduct $igloohome   ){

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


        DB::transaction(function() use ($validated,$igloohome){

            $before = $igloohome->stock;

            $after = $before + $validated['qty'];

            $igloohome->update(['stock'=>$after]);

            IgloohomeStockMovement::create([
                'order_id'           => $validated['order_id'] ?? null,
                'product_id'         => $igloohome->id,
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
                'stock_before'       => $before,
                'stock_after'        => $after,
                'note'               => $validated['note'] ?? 'New inventory received',
                'user_id'            => auth()->id(),
            ]);

        });

        return back()->with('success','Stock added successfully.');

    }

    public function stockOutForm(IgloohomeProduct $igloohome){
        return view('igloohome.stock-out', ['product' => $igloohome]);
    }


    public function stockOut(Request $request, IgloohomeProduct $igloohome){
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

        if ($validated['qty'] > $igloohome->stock) {
            return back()->withErrors(['qty' => 'Not enough stock available.'])->withInput();
        }

        DB::transaction(function () use ($validated, $igloohome) {
            $before = $igloohome->stock;
            $after  = $before - $validated['qty'];

            $igloohome->update([
                'stock' => $after,
            ]);

            IgloohomeStockMovement::create([
                'order_id'           => $validated['order_id'] ?? null,
                'product_id'         => $igloohome->id,
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
                'stock_before'       => $before,
                'stock_after'        => $after,
                'note'               => $validated['note'] ?? 'Product sold',
                'user_id'            => auth()->id(),
            ]);
        });

        return redirect()->route('igloohome.index')->with('success', 'Stock removed successfully.');
    }


    public function movements(IgloohomeProduct $igloohome){

        $movements = $igloohome->stockMovements()
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('igloohome.movements', [
            'product'   => $igloohome,
            'movements' => $movements,
        ]);

    }

    public function allMovements(){
        $movements = IgloohomeStockMovement::with(['product', 'user'])
            ->latest()
            ->paginate(20);

        return view('igloohome.all-movements', compact('movements'));
    }

    public function updateMovementStatus(Request $request, IgloohomeStockMovement $movement){
        $validated = $request->validate([
            'status' => 'required|in:initialized,processing,packed,shipped,delivered,completed,cancelled,returned',
        ]);

        $movement->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Movement status updated successfully.');
    }

    public function editMovement(IgloohomeStockMovement $movement){
        return view('igloohome.edit-movement', compact('movement'));
    }

    public function updateMovement(Request $request, IgloohomeStockMovement $movement){
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
            ->route('igloohome.allMovements')
            ->with('success', 'Movement updated successfully.');
    }

    public function exportIgloohomeProductsExcel(Request $request)
    {
        return Excel::download(
            new IgloohomeProductsExport($request->only(['search', 'stock_status'])),
            'igloohome-products.xlsx'
        );
    }
    public function exportIgloohomeMovementsExcel(Request $request)
    {
        return Excel::download(
            new IgloohomeMovementsExport($request->only(['search'])),
            'igloohome-movements.xlsx'
        );
    }

    //report

    public function monthlyPdf(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $date = Carbon::createFromFormat('Y-m', $month)->startOfMonth();

        $start = $date->copy()->startOfMonth();
        $end = $date->copy()->endOfMonth();

        $previousStart = $date->copy()->subMonth()->startOfMonth();
        $previousEnd = $date->copy()->subMonth()->endOfMonth();

        $report = [
            'monthLabel' => $start->format('F Y'),
            'start' => $start,
            'end' => $end,

            'inventory' => $this->inventorySnapshot(),
            'movementSummary' => $this->movementSummary($start, $end),
            'previousMovementSummary' => $this->movementSummary($previousStart, $previousEnd),

            'topIncomingProducts' => $this->topProductsByType($start, $end, 'in'),
            'topOutgoingProducts' => $this->topProductsByType($start, $end, 'out'),

            'lowStockProducts' => $this->lowStockProducts(),
            'inactiveProducts' => $this->inactiveProducts(),
            'productsWithoutMovement' => $this->productsWithoutMovement($start, $end),

            'statusSummary' => $this->statusSummary($start, $end),
            'carrierSummary' => $this->carrierSummary($start, $end),
            'requestedBySummary' => $this->requestedBySummary($start, $end),
            'userSummary' => $this->userSummary($start, $end),

            'monthlyComparison' => $this->monthlyComparison($date, 6),
        ];

        $pdf = Pdf::loadView('igloohome.reports.monthly-pdf', compact('report'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('igloohome-report-' . $start->format('Y-m') . '.pdf');
    }

    protected function inventorySnapshot(): array
    {
        $totalProducts = IgloohomeProduct::count();
        $activeProducts = IgloohomeProduct::where('is_active', 1)->count();
        $inactiveProducts = IgloohomeProduct::where('is_active', 0)->count();
        $lowStockCount = IgloohomeProduct::where('stock', '<=', 5)->count();

        $totalUnits = IgloohomeProduct::sum('stock');
        $inventoryValue = IgloohomeProduct::selectRaw('SUM(stock * buy_price) as total')->value('total') ?? 0;

        return [
            'totalProducts' => $totalProducts,
            'activeProducts' => $activeProducts,
            'inactiveProducts' => $inactiveProducts,
            'lowStockCount' => $lowStockCount,
            'totalUnits' => $totalUnits,
            'inventoryValue' => $inventoryValue,
        ];
    }

    protected function movementSummary($start, $end): array
    {
        $base = IgloohomeStockMovement::whereBetween('movement_date', [$start, $end]);

        $totalMovements = (clone $base)->count();
        $totalIn = (clone $base)->where('type', 'in')->sum('qty');
        $totalOut = (clone $base)->where('type', 'out')->sum('qty');
        $net = $totalIn - $totalOut;

        return [
            'totalMovements' => $totalMovements,
            'totalIn' => $totalIn,
            'totalOut' => $totalOut,
            'net' => $net,
        ];
    }

    protected function topProductsByType($start, $end, string $type)
    {
        return IgloohomeStockMovement::with('product')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->where('type', $type)
            ->whereBetween('movement_date', [$start, $end])
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->limit(10)
            ->get();
    }

    protected function lowStockProducts()
    {
        return IgloohomeProduct::where('stock', '<=', 5)
            ->orderBy('stock')
            ->orderBy('sku')
            ->get();
    }

    protected function inactiveProducts()
    {
        return IgloohomeProduct::where('is_active', 0)
            ->orderBy('sku')
            ->get();
    }

    protected function productsWithoutMovement($start, $end)
    {
        return IgloohomeProduct::whereDoesntHave('stockMovements', function ($q) use ($start, $end) {
                $q->whereBetween('movement_date', [$start, $end]);
            })
            ->orderBy('sku')
            ->get();
    }

    protected function statusSummary($start, $end)
    {
        return IgloohomeStockMovement::select('status', DB::raw('COUNT(*) as total'))
            ->whereBetween('movement_date', [$start, $end])
            ->groupBy('status')
            ->orderByDesc('total')
            ->get();
    }

    protected function carrierSummary($start, $end)
    {
        return IgloohomeStockMovement::select('carrier', DB::raw('COUNT(*) as total'))
            ->whereBetween('movement_date', [$start, $end])
            ->whereNotNull('carrier')
            ->where('carrier', '!=', '')
            ->groupBy('carrier')
            ->orderByDesc('total')
            ->get();
    }

    protected function requestedBySummary($start, $end)
    {
        return IgloohomeStockMovement::select('requested_by', DB::raw('COUNT(*) as total'))
            ->whereBetween('movement_date', [$start, $end])
            ->whereNotNull('requested_by')
            ->where('requested_by', '!=', '')
            ->groupBy('requested_by')
            ->orderByDesc('total')
            ->get();
    }

    protected function userSummary($start, $end)
    {
        return IgloohomeStockMovement::with('user')
            ->select('user_id', DB::raw('COUNT(*) as total'))
            ->whereBetween('movement_date', [$start, $end])
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->get();
    }

    protected function monthlyComparison(Carbon $month, int $months = 6): array
    {
        $rows = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $m = $month->copy()->subMonths($i);
            $start = $m->copy()->startOfMonth();
            $end = $m->copy()->endOfMonth();

            $in = IgloohomeStockMovement::where('type', 'in')
                ->whereBetween('movement_date', [$start, $end])
                ->sum('qty');

            $out = IgloohomeStockMovement::where('type', 'out')
                ->whereBetween('movement_date', [$start, $end])
                ->sum('qty');

            $rows[] = [
                'label' => $m->format('M Y'),
                'in' => $in,
                'out' => $out,
                'net' => $in - $out,
            ];
        }

        return $rows;
    }

}