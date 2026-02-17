<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (! Collection::hasMacro('dropEmpty')) {
    Collection::macro('dropEmpty', fn () => $this->filter(fn ($value) => ! (empty($value) || $value instanceof Collection && $value->isEmpty())));
}

if (! Collection::hasMacro('deep')) {
    Collection::macro('deep', function () {
        $arguments = func_get_args();

        $base = $this->map(function ($item) use ($arguments) {
            if (is_array($item)) {
                return call_user_func_array([Collection::make($item), 'deep'], $arguments)->all();
            }

            if ($item instanceof Collection) {
                return call_user_func_array([$item, 'deep'], $arguments);
            }

            return $item;
        });

        $call = array_shift($arguments);

        return call_user_func_array([$base, $call], $arguments);
    });
}

if (! Collection::hasMacro('dotGet')) {
    Collection::macro('dotGet', fn ($key) => Arr::get($this, $key));
}

if (! Collection::hasMacro('dotSet')) {
    Collection::macro('dotSet', function ($key, $value) {
        $data = $this->all();
        Arr::set($data, $key, $value);

        return $this->items = $data;
    });
}

if (! Collection::hasMacro('dotHas')) {
    Collection::macro('dotHas', fn ($key) => new static(Arr::has($this, $key)));
}

if (! Collection::hasMacro('fromDot')) {
    Collection::macro('fromDot', function ($part = null) {
        return new static(Arr::fromDot($this->all(), '.', $part));
    });
}
