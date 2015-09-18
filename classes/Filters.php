<?php

namespace Woofem;

class Filters {

    /**
     * Filter Key -> Value pairs. Arrays or Objects.
     *
     * @param $pairs
     *   Key -> value pairs to filter. This will accept objects or arrays.
     * @param string $filter_level
     *   Filter to perform on pairs. See http://php.net/manual/en/filter.filters.php
     * @return \stdClass
     *   Filtered values in their key -> values pairs as an object.
     */
    public static function filterKeyValuePairs($pairs, $filter_level = FILTER_SANITIZE_STRIPPED)
    {
        $filtered = new \stdClass();
        foreach($pairs as $key => $value) {
            $filtered->{filter_var($key, $filter_level)} = filter_var($value, $filter_level);
        }
        return $filtered;
    }

    /**
     * Filter a string.
     * 
     * @param $string
     *   String to filter.
     * @param string $filter_level
     *   Filter to perform on pairs. See http://php.net/manual/en/filter.filters.php
     * @return string
     *   Filtered string.
     */
    public static function filterString($string, $filter_level = FILTER_SANITIZE_STRIPPED)
    {
        return filter_var($string, $filter_level);
    }
}