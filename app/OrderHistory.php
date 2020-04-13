<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    public function filter($filters)
    {
        return false;
    }

    public function filterBySynonyms($filters)
    {
        return false;
    }

    public function searchByAll($phrase)
    {
        return false;
    }
}
