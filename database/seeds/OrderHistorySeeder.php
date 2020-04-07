<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class OrderHistorySeeder extends CsvSeeder
{
    private $isCsvLarge = false;

    public function __construct()
    {
        $this->table = 'order_history';
        $this->filename = base_path().'/database/seeds/csvs/orders.csv';

        $this->setSettings();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->isCsvLarge) {
            DB::disableQueryLog();
        }

        DB::table($this->table)->truncate();

        parent::run();
    }

    /**
     * Set custom settings and data mapping
     */
    private function setSettings()
    {
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'client_name',
            1 => 'product_name',
            2 => 'total',
            3 => 'ordered_at',
        ];
    }
}
