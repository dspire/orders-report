<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters)
    {
        $operation_equal = '=';
        $items = [];
        // use map fn
        foreach ($filters as $k => $val) {
            $items[] = [
                $k, $operation_equal, $val
            ];
        }

        $conditions = [
            ['client', '=', 'acme'],
            ['total', '=', '36'],
        ];
        return $query->where($conditions);
    }

    public function filterBySynonyms($filters)
    {
        return false;
    }

    /**
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param $phrase
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByAll($query, $phrase)
    {
        $keys = $this->getFillable();

        $filters = array_fill_keys($keys, $phrase);

        $conditions = [
            ['client', '=', 'acme'],
            ['total', '=', '36'],
        ];
        return $query->where($conditions);
    }
}

// todo: try scope call another scope
