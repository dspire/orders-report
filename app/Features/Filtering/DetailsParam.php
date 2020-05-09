<?php


namespace App\Features\Filtering;

use Illuminate\Support\Str;

class DetailsParam
{
    private $items;
    private $permittedValues;

    public function __construct(string $param)
    {
        $this->items = Str::of($param)->explode(',');
    }

    public function setAcceptable(array $values)
    {
        $this->permittedValues = $values;
    }

    public function toArray(): array
    {
        return $this->items->intersect($this->permittedValues)->all();
    }
}
