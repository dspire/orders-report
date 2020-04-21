<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderHistory extends Model
{
    protected $table = 'order_history';

    protected $fillable = [
        'client_name',
        'product_name',
        'total',
        'ordered_at',
    ];

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters)
    {
        $operation_equal = '=';
        $items = [];
        foreach ($filters as $k => $val) {
            $key = $this->getColumnSynonym($k);
            $items[] = [
                $key, $operation_equal, $val
            ];
        }

        return $query->where($items);
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

    private function getColumnSynonym($name)
    {
        $mapping = [
            'client' => 'client_name',
            'product' => 'product_name',
            'total' => 'total',
            'date' => 'ordered_at',
        ];

        if (isset($mapping[$name])) {
            return $mapping[$name];
        }

        return $name;
    }

    private function normalizeClient($title)
    {
        $str = Str::lower($title);

        return Str::ucfirst($str);
    }
}
