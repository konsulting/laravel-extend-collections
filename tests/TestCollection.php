<?php

namespace Konsulting\Laravel;

class CollectionMacroTest extends \PHPUnit_Framework_TestCase
{
    /** @test **/
    public function deep_trim()
    {
        $collection = collect(['a' => ['a' => 'bab   '], 'b' => 'c   ']);

        $result = $collection->deep('map', function ($item) {
            return is_string($item) ? trim($item) : $item;
        });

        $this->assertEquals(['a' => ['a' => 'bab'], 'b' => 'c'], $result->all());
    }

    /** @test **/
    public function deep_dropEmpty()
    {
        $collection = collect(['a' => ['a' => '']]);

        $result = $collection->deep('dropEmpty');

        $this->assertTrue($result->isEmpty());
    }

    /** @test **/
    public function dot()
    {
        $collection = collect(['a' => ['a' => ''], 'b' => ['c' => ['d' => 1, 'e' => 2]]]);

        $result = $collection->dot();

        $this->assertEquals(['a.a' => '', 'b.c.d' => 1, 'b.c.e' => 2], $result->all());
    }

    /** @test */
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
