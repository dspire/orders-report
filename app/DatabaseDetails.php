<?php

namespace App;

use Illuminate\Support\Str;

class DatabaseDetails
{
    private $drivers = [
        'mysql', 'postgres'
    ];

    public function convertStringIntoDate($driver)
    {
        $driver = Str::lower($driver);
        $dbs = [
            'mysql' => 'STR_TO_DATE',
            'postgres' => 'TO_DATE',
        ];
        return $dbs[$driver];
    }
}
