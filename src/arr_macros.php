<?php

use Illuminate\Support\Arr;

if (! Arr::hasMacro('fromDot')) {
    Arr::macro('fromDot', function ($array, $separator = '.', $part = null) {
        $result = [];

        // filter dotted array before expanding
        if ($part) {
            $array = isset($array[$part]) ? $array[$part] : $array;
        }

        if (! is_array($array)) {
            return $array;
        }

        if ($part) {
            $partPath = $part . $separator;
            $zeroPath = '0' . $separator;

            $array = array_filter($array, function ($item, $key) use ($partPath) {
                return substr($key, 0, strlen($partPath)) == $partPath;
            }, ARRAY_FILTER_USE_BOTH);

            $array = array_reduce(array_keys($array), function ($carry, $key) use ($array, $partPath, $zeroPath) {
                $carry[str_replace($partPath, $zeroPath, $key)] = $array[$key];

                return $carry;
            });
        }

        if (! is_array($array)) {
            return $array;
        }

        foreach ($array as $complexKey => $val) {
            $ref = &$result;
            $regex = '/' . preg_quote($separator, '/') . '/';
            $keys = preg_split($regex, $complexKey, -1, PREG_SPLIT_NO_EMPTY);

            $finalKey = array_pop($keys);

            foreach ($keys as $key) {
                if (! isset($ref[$key])) {
                    $ref[$key] = [];
                }
                $ref = &$ref[$key];
            }

            $ref[$finalKey] = $val;
        }

        return $result;
    });
}
