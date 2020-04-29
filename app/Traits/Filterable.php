<?php

namespace App\Traits;


trait Filterable
{
    private function sanitazeFilters($filters)
    {
        $allowed = $this->getFilterable();

        $activeElements = array_filter(
            $filters,
            function ($key) use ($allowed) {
                return in_array($key, $allowed);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $activeElements;
    }

    public function getFilterable()
    {
        if (empty($this->filtersMap)) {
            return $this->getFillable();
        }

        return array_merge(
            array_values($this->filtersMap),
            array_keys($this->filtersMap)
        );
    }

    public function mapFilterToColumn($name)
    {
        $mapping = $this->filtersMap;
        if (isset($mapping[$name])) {
            return $mapping[$name];
        }

        return $name;
    }
}
