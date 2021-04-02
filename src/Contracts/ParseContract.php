<?php

namespace Tanvir3d\Contracts;

interface ParseContract
{
    /**
     * Initialize array.
     *
     * @param array $data Array to init.
     * @return ParseContract
     */
    public static function make(array $data): ParseContract;

    /**
     * filtering data from 2dimension or single dimension array
     *
     * @param string $column      Column name for filtering value.
     * @param string $columnValue Value based on column to filter.
     * @param array  $recurArray  Array for recursive function.
     * @return ParseContract
     */
    public function where(string $column, string $columnValue, array $recurArray = []): ParseContract;

    /**
     * Filtering on on array.
     *
     * @param string $column      Column name for filtering value.
     * @param array  $columnValue Array based on column to filter.
     * @param array  $recurArray  Array for recursive function.
     * @return ParseContract
     */
    public function whereIn(string $column, array $columnValue, array $recurArray = []): ParseContract;

    /**
     * Sort values ascending or descending.
     *
     * @param string $column Sorting values column name.
     * @param string $order  Order to sort ascending or descending.
     * @return ParseContract
     */
    public function orderBy(string $column, string $order = "ASC"): ParseContract;

    /**
     * returns the objects instance
     *
     * @return ParseContract
     */
    public function get(): ParseContract;

    /**
     * returns data in array format
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * returns data in json format
     *
     * @return object
     */
    public function toJson();

    /**
     * returns the first value
     *
     * @return array
     */
    public function first(): array;

    /**
     * Pluck specific column to an array
     *
     * @param string $column     Column name to pluck.
     * @param array  $recurArray Array for recursive function.
     * @return array
     */
    public function pluck(string $column, array $recurArray = []): array;
}
