<?php


namespace App\Datasets;


class OrderMapper
{
    private $mapping = [];

    public function getMappedItems($csvRecord)
    {
        $dbRecord = [];
        foreach ($this->mapping as $key => $val) {
            $dbRecord[$val] = $csvRecord[$key];
        }

        return $dbRecord;
    }

    public function setMapping(array $map)
    {
        $this->mapping = [
            'client' => 'client_name',
            'product' => 'product_name',
            'total' => 'total',
            'date' => 'ordered_at',
        ];
    }
}
