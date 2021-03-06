<?php

namespace Test\Common\Foundation\RequestSpec;

use MPScholten\RequestParser\CommaSeparatedBooleanParser;
use MPScholten\RequestParser\CommaSeparatedDateTimeParser;
use MPScholten\RequestParser\CommaSeparatedFloatParser;
use MPScholten\RequestParser\CommaSeparatedIntParser;
use MPScholten\RequestParser\CommaSeparatedJsonParser;
use MPScholten\RequestParser\CommaSeparatedStringParser;
use MPScholten\RequestParser\CommaSeparatedYesNoBooleanParser;
use MPScholten\RequestParser\Config;
use MPScholten\RequestParser\ExceptionFactory;
use MPScholten\RequestParser\ExceptionMessageFactory;
use MPScholten\RequestParser\NotFoundException;

class CommaSeparatedTypeParserTest extends \PHPUnit_Framework_TestCase
{
    public function testCsvWithInt()
    {
        $expected = [1, 2, 3, 4];
        $result = (new CommaSeparatedIntParser(new Config(), 'intArr', '1,2,3,4'))->required();
        $this->assertEquals($expected, $result);
    }

    public function testCsvWithFloat()
    {
        $expected = [1.1, 2.99, 3.4, 4.13];
        $result = (new CommaSeparatedFloatParser(new Config(), 'intArr', '1.1,2.99,3.4,4.13'))->required();
        $this->assertEquals($expected, $result);
    }

    public function testCsvWithString()
    {
        $expected = ['apples', 'oranges', 'tomatoes'];
        $result = (new CommaSeparatedStringParser(new Config(), 'intArr', 'apples,oranges,tomatoes'))->required();
        $this->assertEquals($expected, $result);
    }

    public function testCsvWithDateTime()
    {
        $expected = [
            new \DateTime('2016-01-01'),
            new \DateTime('2016-01-02'),
            new \DateTime('2016-01-03')
        ];
        $result = (new CommaSeparatedDateTimeParser(new Config(), 'intArr', '2016-01-01,2016-01-02,2016-01-03'))->required();
        $this->assertEquals($expected, $result);
    }

    public function testCsvWithJson()
    {
        $expected = [
            [
                'event' => 'page_view',
                'deviceTimestamp' => '2016-01-01 08:10:00.151',
                'url' => 'https://www.domain.com/'
            ],
            [
                'event' => 'add_to_basket',
                'deviceTimestamp' => '2016-01-02 09:59:00.999',
                'url' => 'https://www.domain.com/'
            ]
        ];
        $value = '{"event":"page_view","deviceTimestamp":"2016-01-01 08:10:00.151","url":"https://www.domain.com/"},{"event":"add_to_basket","deviceTimestamp":"2016-01-02 09:59:00.999","url":"https://www.domain.com/"}';
        $result = (new CommaSeparatedJsonParser(new Config(), 'intArr', $value))->required();
        $this->assertEquals($expected, $result);
    }

    public function testCsvWithBoolean()
    {
        $expected = [false, true, true];
        $result = (new CommaSeparatedBooleanParser(new Config(), 'boolArr', 'false,true,true'))->required();
        $this->assertEquals($expected, $result);
    }

    public function testCsvWithYesNoBoolean()
    {
        $expected = [true, false, true];
        $result = (new CommaSeparatedYesNoBooleanParser(new Config(), 'yesNoBoolArr', 'Y,N,Y'))->required();
        $this->assertEquals($expected, $result);
    }
}
