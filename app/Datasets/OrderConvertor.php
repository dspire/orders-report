<?php


namespace App\Datasets;

// todo: add unit tests
class OrderConvertor
{
    public function convertDateField($value)
    {
        $dd = \DateTime::createFromFormat('m/j/Y', $value);

        return $dd->format('Y-m-d');
    }
}
