<?php

namespace App\Exports;

use App\Models\IgloohomeProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IgloohomeProductsExport implements FromCollection, WithHeadings
{
    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection(): Collection
    {
        $query = IgloohomeProduct::query();

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('sku', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('name_jp', 'like', "%{$search}%")
                  ->orWhere('color', 'like', "%{$search}%");
            });
        }

        if (!empty($this->filters['stock_status'])) {
            if ($this->filters['stock_status'] === 'low') {
                $query->where('stock', '<=', 5);
            } elseif ($this->filters['stock_status'] === 'ok') {
                $query->where('stock', '>', 5);
            }
        }

        return $query->select('sku', 'name_en', 'name_jp', 'color', 'stock')
                     ->orderBy('sku')
                     ->get();
    }

    public function headings(): array
    {
        return ['SKU', 'English Name', 'Japanese Name', 'Color', 'Stock'];
    }
}