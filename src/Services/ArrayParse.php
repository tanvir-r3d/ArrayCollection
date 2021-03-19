<?php

namespace Tanvir3d\Services;

use Tanvir3d\Contracts\ParseContract;

class ArrayParse implements ParseContract
{
    /**
     * array for operation
     *
     * @var array
     */
    protected $data;

    /**
     * Init value
     *
     * @param array $data Array for operation.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Initialize array.
     *
     * @param array $data Array to init.
     * @return ParseContract
     */
    public static function make(array $data): ParseContract
    {
        return new static($data);
    }

    /**
     * filtering data from 2dimension or single dimension array
     *
     * @param string $column Column name for filtering value.
     * @param string $value  Value based on column to filter.
     * @return ParseContract
     */
    public function where(string $column, string $value): ParseContract
    {
        $filterData = [];
        array_walk($this->data, function ($v, $k) use ($column, $value, &$filterData) {
            if ($k == $column && $v == $value) {
                $filterData[] = $this->data;
            } elseif (is_array($v) && array_key_exists($column, $v)) {
                array_walk($v, function ($_v, $_k) use ($v, $column, $value, &$filterData) {
                    if ($_v == $value && $_k == $column) {
                        $filterData[] = $v;
                    }
                });
            }
        });

        $this->data = $filterData;
        return $this;
    }

    /**
     * Filtering on on array.
     *
     * @param string $column Column name for filtering value.
     * @param array  $value  Array based on column to filter.
     * @return ParseContract
     */
    public function whereIn(string $column, array $value): ParseContract
    {
        $filterData = [];
        array_walk($this->data, function ($v, $k) use ($column, $value, &$filterData) {
            if ($k == $column && in_array($v, $value, true)) {
                $filterData[] = $this->data;
            } elseif (is_array($v) && array_key_exists($column, $v)) {
                array_walk($v, function ($_v, $_k) use ($v, $column, $value, &$filterData) {
                    if (in_array($_v, $value, true) && $_k == $column) {
                        $filterData[] = $v;
                    }
                });
            }
        });
        $this->data = $filterData;
        return $this;
    }

    /**
     * Sort values ascending or descending.
     *
     * @param string $column Sorting values column name.
     * @param string $order  Order to sort ascending or descending.
     * @return ParseContract
     */
    public function orderBy(string $column, string $order = "ASC"): ParseContract
    {
        $order = strtoupper($order);

        usort($this->data, function ($a, $b) use ($column, $order) {
            if ($order == "ASC") {
                return $a[$column] <=> $b[$column];
            } elseif ($order == "DESC" || $order == "DSC") {
                return $b[$column] <=> $a[$column];
            }
        });
        return $this;
    }

    /**
     * returns the objects instance
     *
     * @return ParseContract
     */
    public function get(): ParseContract
    {
        return $this;
    }

    /**
     * returns data in array format
     *
     * @return array
     */
    public function toArray(): array
    {
        return (array)$this->data;
    }

    /**
     * returns data in json format
     *
     * @return object
     */
    public function toJson()
    {
        return json_encode($this->data);
    }

    /**
     * returns the first value
     *
     * @return array
     */
    public function first(): array
    {
        return (array)$this->data[0];
    }
}
