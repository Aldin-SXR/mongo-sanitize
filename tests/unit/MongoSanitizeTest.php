<?php

use PHPUnit\Framework\TestCase;

class MongoSanitizeTest extends TestCase {

    public function testDoesNothingToStringsBooleansAndIntegers () {
        $array = [
            'hello' => 'world',
            1 => 2,
            true => false
        ];

        $cleaned = mongo_sanitize($array);
        $this->assertEquals($array, $cleaned);
    }

    public function testSanitizesMongoOperators() {
        $array = [
            'hello' => 'world',
            '$or' => [ [ 'hello' => 'world' ], [ 'foo' => 'bar' ] ]
        ];

        $cleaned = mongo_sanitize($array);
        $this->assertEquals([
            'hello' => 'world'
        ], $cleaned);
    }

    public function testSanitizesEmbeddedMongoOperators() {
        $array = [
            'hello' => 'world',
            'foo' => [ '$eq' => 'bar' ],
            'test' => [ 'var' => 42, 'const' => [ '$ne' => 42 ] ]
        ];

        $cleaned = mongo_sanitize($array);
        $this->assertEquals([
            'hello' => 'world',
            'foo' => [ ],
            'test' => [ 'var' => 42, 'const' => [ ] ]
        ], $cleaned);
    }
}