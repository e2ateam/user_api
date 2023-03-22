<?php

namespace Tests\Core\Domain\_Shared\Converter;

use App\Core\Domain\_Shared\Converter\CamelCaseToSnakeCase;
use Tests\TestCase;

class CamelCaseToSnakeCaseTest extends TestCase
{
    public function testConvertString(): void
    {
        $actual = CamelCaseToSnakeCase::convertString('name');
        $this->assertEquals('name', $actual);
        $actual = CamelCaseToSnakeCase::convertString('name1');
        $this->assertEquals('name1', $actual);
        $actual = CamelCaseToSnakeCase::convertString('fullname');
        $this->assertEquals('fullname', $actual);
        $actual = CamelCaseToSnakeCase::convertString('fullName');
        $this->assertEquals('full_name', $actual);
    }

    public function testConvertArray(): void
    {
        $actual = CamelCaseToSnakeCase::convertArray([
            'name' => 'name',
            'name1' => 'name1',
            'fullname' => 'fullname',
            'fullName' => 'fullName',
        ]);
        $keys = array_keys($actual);
        $this->assertEquals(4, count($actual));
        $this->assertEquals('name', $keys[0]);        
        $this->assertEquals('name1', $keys[1]);        
        $this->assertEquals('fullname', $keys[2]);        
        $this->assertEquals('full_name', $keys[3]);
    }
}
