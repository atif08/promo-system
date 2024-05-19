<?php

namespace App\DataTables\Products;

use App\DataTables\DataTableBase;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ProductsDataTable extends DataTableBase {

    protected $order_by = [[0, 'asc']];

    public function getBaseQuery(): ?Builder {

        $this->columns = [
            'id',
            'title',
            'created_at',
            'listing_price',
            'sku'
        ];

        return DB::table('products')
            ->select($this->columns);
    }

    public function getColumnDef(): array {
        return [
            'id'           => [
                'title'       => __('UID'),
                'data'        => 'id',
                'name'        => 'id',
                'column_type' => 'integer'
            ],
            'title'         => [
                'title'       => __('Title'),
                'data'        => 'title',
                'name'        => 'title',
                'raw'         => 'true',
                'column_type' => 'text'
            ],
            'sku'         => [
                'title'       => __('SKU'),
                'data'        => 'sku',
                'name'        => 'sku',
                'column_type' => 'text'
            ], 'listing_price'         => [
                'title'       => __('Price'),
                'data'        => 'listing_price',
                'name'        => 'listing_price',
                'column_type' => 'float'
            ],
            'created_at'   => [
                'title'       => __('Created At'),
                'data'        => 'created_at',
                'name'        => 'created_at',
                'column_type' => 'date'
            ],
            'action'       => [
                'title'      => __('Action'),
                'data'       => 'action',
                'name'       => 'action',
                'searchable' => false,
                'orderable'  => false,
                'raw'        => 'true',
                'content'    => function ($row) {
                    $actions = [
                        '<a class="dropdown-item" href="' . url('companies/details') . '?uid=' . $row->id . '"><i class="fas fa-glasses"></i> ' . __('Company Details') . '</a>',
                    ];

                    return
                        '<div class="btn-group">' .
                        '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">' . __('Actions') . ' <i class="mdi mdi-chevron-down"></i></button>' .
                        '<div class="dropdown-menu">' . implode('', $actions) . '</div>' .
                        '</div>';
                },
            ],
        ];
    }
}
