<?php

namespace App\DataTables;

use App\Helpers\CarbonHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\QueryDataTable;

class DataTableBase {

    /** @var User */
    protected $user;
    /** @var User */
    protected $current_account;
    /** @var Request */
    protected $request;
    /** @var string */
    protected $currency;
    /** @var CarbonHelper */
    protected $date_object;
    protected $date_range = null;
    protected $columns = [];
    protected $table_id = '';
    protected $order_by = [[1, 'asc']];
    protected $row_id = null;
    protected $ajax_url = null;

    public function __construct(User $user, User $current_account = null, Request $request = null) {
        $this->user = $user;
        $this->current_account = $current_account ?: $user;
        $this->currency = $this->current_account->getCurrency();

        $this->request = $request;
        $this->setTableId(get_class_name($this));

        $this->ajax_url = $request->fullUrl();

        $this->setOrderBy();

        $this->setDateRange();
    }

    public function getBaseQuery() {
        return null;
    }

    public function getColumnDef(): array {
        return [];
    }

    public function getColumns(): array {
        return $this->columns;
    }

    public function getTableId(): string {
        return $this->table_id;
    }

    public function setTableId($table_id) {
        $this->table_id = $table_id;
    }

    protected function setOrderBy() {
        if ($this->request->get('order')) {
            $this->order_by = $this->request->get('order');
        }
    }

    public function getOrderBy() {
        return $this->order_by;
    }

    protected function setDateRange() {
        $this->date_object = new CarbonHelper($this->user, $this->request, 30);
        $this->date_range = $this->date_object->getFullDayRange();
        return $this;
    }

    protected function getDateRange() {
        return $this->date_range;
    }

    public function table($attributes = []): string {
        $classes = 'table table-hover datatable w-100';
        if (isset($attributes['class'])) {
            $classes .= ' ' . $attributes['class'];
        }
        $table = "<table class='{$classes}' id='{$this->getTableId()}'>";

        $table .= "<thead><tr>";

        foreach ($this->getColumnDef() as $key => $value) {
            $table .= "<th scope='col' class='" . $key . "'>" . $value['title'] . "</th>";
        }

        $table .= "</tr></thead><tbody></tbody></table>";
        return $table;
    }

    public function getDTParameters($parameters = []) {
        return (array_merge([
            "ajax"       => $this->ajax_url,
            "pageLength" => 1000,
            "aoColumns"  => array_values($this->getColumnDef()),
            "aaSorting"  => $this->getOrderBy(),
            "sDom"       => "<'row dt-top-wrapper mb-2'>" .
                "<'#" . $this->getTableId() . ".row dt-wrapper '<'col-sm-12'tr>>" .
                "<'row pagination-wrapper mt-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>",
        ], $parameters));
    }

    public function scripts() {
        $dt_parameters = $this->getDTParameters();
        return sprintf('<script type="text/javascript">loadDataTable("%s", %s)</script>' . PHP_EOL, $this->getTableId(), json_encode($dt_parameters));
    }

    public function getData($return = false) {
        $base_query = $this->getBaseQuery();

        // END THIS IS NEEDED IN CASE OF BLOCKS

        /** @var QueryDataTable $data_table */
        $data_table = Datatables::of($base_query);

        $column_def = $this->getColumnDef();

        $raw_columns = collect($column_def)->where('raw', true)->pluck('data')->toArray();

        foreach ($column_def as $column) {

            if (isset($column['content']) && is_callable($column['content'])) {
                $data_table->editColumn($column['data'], $column['content']);
                continue;
            }

            switch ($column['column_type'] ?? 'text') {
                case 'amount':
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        $currency = $row->currency ?? $this->current_account->marketplace?->currency ?? 'USD';
                        return format_amount($row->{$column['data']}, $currency);
                    });
                    break;

                case 'integer':
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        return format_integer($row->{$column['data']});
                    });
                    break;

                case 'percent':
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        return format_percent($row->{$column['data']});
                    });
                    break;

                case 'percent2':
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        return format_percent($row->{$column['data']}, 100);
                    });
                    break;

                case 'float':
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        return format_number($row->{$column['data']});
                    });
                    break;

                case 'boolean':
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        return $row->{$column['data']} ?
                            '<span class="badge badge-pill bg-soft-success font-size-12">' . ($column['options'][1] ?? 'True') . '</span>' :
                            '<span class="badge badge-pill bg-soft-danger font-size-12">' . ($column['options'][0] ?? 'False') . '</span>';
                    });
                    break;

                case 'date';
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        $format = $column['format'] ?? 'D. M d, Y h:i:s A';
                        return $row->{$column['data']} ? Carbon::parse($row->{$column['data']})->format($format) : '';
                    });
                    break;

                case 'text':
                default:
                    $data_table->editColumn($column['data'], function ($row) use ($column) {
                        return mb_substr($row->{$column['data']}, 0,  50) . '...'; ;
                    });
                    break;
            }
        }

        if (!empty($raw_columns)) {
            $data_table->rawColumns($raw_columns);
        }

        $data_table->filter(function ($query) {

            if ($this->request->has('custom_filters')) {

                $column_def = $this->getColumnDef();

                foreach ($this->request->get('custom_filters') as $column_name => $column_value) {

                    $column = $column_def[$column_name];
                    $from = $column_value['from'];
                    $to = $column_value['to'];
                    $_condition = $column_value['condition'];
                    $bindings = [];

                    if (($column['column_type'] ?? '') == 'percent') {
                        $from = $from ? ($from / 100) : '';
                        $to = $to ? ($to / 100) : '';
                    }

                    switch ($_condition) {
                        case ">"  :
                        case "<"  :
                        case "=" :
                        case ">=" :
                        case "<=" :
                            $condition = "(({$column['name']}) {$_condition} ?)";
                            $bindings[] = $from;

                            break;

                        case "between" :
                            if ($column['column_type'] == 'date') {
                                $from = $from ? Carbon::parse($from)->startOfDay()->toDateTime() : '';
                                $to = $to ? Carbon::parse($to)->endOfDay()->toDateTime() : '';
                            }

                            if ((!is_null($from) && $from !== '') && (!is_null($to) && $to !== '')) {
                                $condition = "({$column['name']} BETWEEN ? AND ?)";
                                $bindings[] = $from;
                                $bindings[] = $to;
                                break;
                            }

                            if (!is_null($from) && $from !== '') {
                                $condition = "({$column['name']} >= ?)";
                                $bindings[] = $from;
                                break;
                            }

                            if (!is_null($to) && $to !== '') {
                                $condition = "({$column['name']} <= ?)";
                                $bindings[] = $to;
                                break;
                            }

                        case "contains":
                            $condition = "({$column['name']} LIKE ?)";
                            $bindings[] = ['%' . $from . '%'];

                            break;

                        case "not_contains" :
                            $condition = "({$column['name']} NOT LIKE ?)";
                            $bindings[] = ['%' . $from . '%'];

                            break;
                    }

                    if (isset($condition)) {
                        $query->havingRaw(DB::raw($condition), $bindings);
                    }
                }

            }

        }, true);

        if ($this->row_id) {
            $data_table->setRowId($this->row_id);
        }

        if ($return) {
            return $data_table;
        }

        return $data_table->make(true);
    }

}
