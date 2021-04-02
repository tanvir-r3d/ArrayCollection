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
    protected $count = 0;
    protected $filteredData = [];
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
     * @param string $column      Column name for filtering value.
     * @param string $columnValue Value based on column to filter.
     * @param array  $recurArray  Array for recursive function.
     * @return ParseContract
     */
    public function where(string $column, string $columnValue, array $recurArray = []): ParseContract
    {
        $initArray = [];
        if ($recurArray && $this->count > 0) {
            $initArray = $recurArray;
        }
        if ($this->count == 0) {
            $initArray = $this->data;
        }
        $this->count++;
        foreach ($initArray as $key => $value) {
            if ($key == $column && $value == $columnValue) {
                $this->filteredData[] = $initArray;
            }
            if (is_array($value)) {
                $this->where($column, $columnValue, $value);
            }
        }

        $this->data = $this->filteredData;
        $this->count = 0;
        $this->filteredData = [];
        return $this;
    }

    /**
     * Filtering on on array.
     *
     * @param string $column      Column name for filtering value.
     * @param array  $columnValue Array based on column to filter.
     * @param array  $recurArray  Array for recursive function.
     * @return ParseContract
     */
    public function whereIn(string $column, array $columnValue, array $recurArray = []): ParseContract
    {

        $initArray = [];
        if ($recurArray && $this->count > 0) {
            $initArray = $recurArray;
        }
        if ($this->count == 0) {
            $initArray = $this->data;
        }
        $this->count++;
        foreach ($initArray as $key => $value) {
            if ($key == $column && in_array($value, $columnValue, true)) {
                $this->filteredData[] = $initArray;
            }
            if (is_array($value)) {
                $this->whereIn($column, $columnValue, $value);
            }
        }

        $this->data = $this->filteredData;
        $this->count = 0;
        $this->filteredData = [];
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
            if (isset($a[$column]) && isset($b[$column])) {
                if ($order == "ASC") {
                    return $a[$column] > $b[$column];
                } elseif ($order == "DESC" || $order == "DSC") {
                    return $a[$column] < $b[$column];
                }
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

    /**
     * Pluck specific column to an array
     *
     * @param string $column     Column name to pluck.
     * @param array  $recurArray Array for recursive function.
     * @return array
     */
    public function pluck(string $column, array $recurArray = []): array
    {
        $initArray = [];
        if ($recurArray && $this->count > 0) {
            $initArray = $recurArray;
        }
        if ($this->count == 0) {
            $initArray = $this->data;
        }
        $this->count++;
        foreach ($initArray as $key => $value) {
            if ($column === $key) {
                $this->filteredData[] = $value;
            }
            if (is_array($value)) {
                $this->pluck($column, $value);
            }
        }

        $this->data = $this->filteredData;
        return (array)$this->data;
    }
}
