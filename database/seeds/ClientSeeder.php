<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    private $path = '';

    private $mapping = [
        'client' => 'name'
    ];

    public function __construct()
    {
        $this->path = base_path() . '/database/seeds/csvs/clients.csv';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $csv = Reader::createFromPath($this->path)
            ->setHeaderOffset(0);

        $items = [];
        foreach ($csv as $row) {
            $items[] = array_change_key_case($row, CASE_LOWER);
        }

        // mapping
        foreach ($items as $item) {
            $cols = $this->getMappedData($item);
            $cols = array_merge($cols, [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('clients')->insert($cols);
        }
    }

    public function getMappedData($item)
    {
        // param $this->mapping
        return [
            'name' => $item['client']
        ];
    }
}
