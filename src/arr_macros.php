<?php

use Illuminate\Support\Arr;

if (! Arr::hasMacro('fromDot')) {
    Arr::macro('fromDot', function ($array) {
        return Arr::undot($array);
    });
}
