<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Carbon\Carbon;
use App\Datasets\OrderConvertor;

class OrderHistorySeeder extends Seeder
{
    private $table = '';
    private $path = '';
    private $isCsvLarge = false;
    private $mapping = [];

    public function __construct()
    {
        $this->table = 'order_history';
        $this->path = base_path() . '/database/seeds/csvs/orders.csv';

        $this->setCustomSettings();
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

        $this->runCustomSeed();
    }

    public function runCustomSeed()
    {
        $csv = Reader::createFromPath($this->path)
            ->setHeaderOffset(0);

        $items = [];
        foreach ($csv as $row) {
            $items[] = array_change_key_case($row, CASE_LOWER);
        }

        foreach ($items as $item) {
            $cols = $this->getMappedData($item);
            $cols = array_merge($cols, [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            //$cols['ordered_at'] = (new OrderConvertor())->convertDateField($cols['ordered_at']);

            DB::table($this->table)->insert($cols);
        }
    }

    private function setCustomSettings()
    {
        $this->mapping = [
            'client' => 'client_name',
            'product' => 'product_name',
            'total' => 'total',
            'date' => 'ordered_at',
        ];
    }

    public function getMappedData($csvItem)
    {
        $dbRecord = [];
        foreach ($this->mapping as $key => $val) {
            $dbRecord[$val] = $csvItem[$key];
        }

        return $dbRecord;
    }
}
