<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            'Acme',
            'Apple',
            'Microsoft',
        ];

        foreach ($clients as $name) {
            DB::table('clients')->insert([
                'name' => $name
            ]);
        }
    }
}
