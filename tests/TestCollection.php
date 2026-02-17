<?php

namespace Konsulting\Laravel;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TestCollection extends TestCase
{
    #[Test]
    public function deep_trim()
    {
        $collection = collect(['a' => ['a' => 'bab   '], 'b' => 'c   ']);

        $result = $collection->deep('map', fn ($item) => is_string($item) ? trim($item) : $item);

        $this->assertEquals(['a' => ['a' => 'bab'], 'b' => 'c'], $result->all());
    }

    #[Test]
    public function deep_drop_empty()
    {
        $collection = collect(['a' => ['a' => '']]);

        $result = $collection->deep('dropEmpty');

        $this->assertTrue($result->isEmpty());
    }

    #[Test]
    public function dot()
    {
        $collection = collect(['a' => ['a' => ''], 'b' => ['c' => ['d' => 1, 'e' => 2]]]);

        $result = $collection->dot();

        $this->assertEquals(['a.a' => '', 'b.c.d' => 1, 'b.c.e' => 2], $result->all());
    }

    #[Test]
    public function from_dot()
    {
        $collection = collect(['a.a' => '', 'b.c.d' => 1, 'b.c.e' => 2]);

        $result = $collection->fromDot();

        $this->assertEquals(
            ['a' => ['a' => ''], 'b' => ['c' => ['d' => 1, 'e' => 2]]],
            $result->all()
        );
    }
}
