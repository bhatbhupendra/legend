<?php

namespace App\Exports;

use App\Models\IgloohomeStockMovement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IgloohomeMovementsExport implements FromCollection, WithHeadings
{
    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection(): Collection
    {
        $query = IgloohomeStockMovement::query();

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                  ->orWhere('product_id', 'like', "%{$search}%")
                  ->orWhere('requested_by', 'like', "%{$search}%")
                  ->orWhere('user_id', 'like', "%{$search}%");
            });
        }

        return $query->select('order_id', 'product_id','type', 'qty', 'stock_before', 'stock_after', 'movement_date', 'requested_by', 'shipped_by', 'shipped_to', 'status', 'tracking_number', 'carrier', 'reference_document', 'note', 'user_id', 'created_at', 'updated_at')
                     ->orderBy('order_id')
                     ->get();
    }

    public function headings(): array
    {
        return ['Order ID', 'Product ID', 'Type', 'Quantity', 'Stock Before', 'Stock After', 'Movement Date', 'Requested By', 'Shipped By', 'Shipped To', 'Status', 'Tracking Number', 'Carrier', 'Reference Document', 'Note', 'User ID', 'Created At', 'Updated At'];
    }
}