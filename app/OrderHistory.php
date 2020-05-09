<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use Filterable;

    protected $table = 'order_history';

    protected $fillable = [
        'client_name',
        'product_name',
        'total',
        'ordered_at',
    ];

    protected $filtersMap = [
        'client' => 'client_name',
        'product' => 'product_name',
        'total' => 'total',
        'date' => 'ordered_at',
    ];

    protected $useFiltersOnly = false;

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters)
    {
        $filters = $this->sanitazeFilters($filters);

        $operation_equal = '=';
        $items = [];
        foreach ($filters as $k => $val) {
            $key = $this->mapFilterToColumn($k);
            $items[$key] = [
                $key, $operation_equal, $val
            ];
        }

        return $query->where(array_values($items));
    }

    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $phrase
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByAll($query, $phrase)
    {
        $items = collect($this->getFillable());

        $paramsCollection = $items->map(function ($col) use($phrase) {
            return [$col, '=', $phrase, 'or'];
        });

        return $query->where($paramsCollection->all());
    }
}
