<?php

namespace App\Features\Filtering;

use App\Helpers\StringHelper;
use Illuminate\Support\Str;

class SortParam
{
    private $row = '';

    public function __construct(string $sortRow)
    {
        $this->row = $sortRow;
    }

    public function isValid(): bool
    {
        $pattern = '#[a-z,\-\+\s]+#';
        return StringHelper::checkSignsBy($pattern, $this->row);

    }

    public function parse(): array
    {
        if (empty($this->row)) return [];
        if ($this->isValid() === false) {
            throw new \InvalidArgumentException('Invalid argument `sort param` passed');
        }

        $map = [
            '+' => 'asc',
            '-' => 'desc'
        ];

        $row = $this->row;
        $collection = Str::of($row)->explode(',');
        $mapped = $collection->map(function ($phrase) use ($map) {
            if (Str::startsWith($phrase, ['-', '+'])) {
                $direction = str_replace(
                    array_keys($map),
                    array_values($map),
                    Str::substr($phrase, 0, 1)
                );

                $result = Str::substr($phrase, 1) . ' ' . $direction;
            } else {
                $result = $phrase . ' asc';
            }

            return $result;
        });

        return $mapped->all();
    }

    public function toSqlString(): string
    {
        return implode(',', $this->parse());
    }
}
