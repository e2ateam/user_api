<?php

namespace Tests\Core\Domain\_Shared\Converter;

use App\Core\Domain\_Shared\Converter\ObjectToArray;
use App\Core\Domain\_Shared\Entity\Entity;
use Tests\TestCase;

class ObjectToArrayTest extends TestCase
{
    public function testConvertObjectToArray(): void
    {
        $entity = new AnyEntityTest(
            null,
            'Field Description 1',
            'Field Description 2',
            'Field Description 3',
        );
        $expected = [
            'field1' => 'Field Description 1',
            'field2' => 'Field Description 2',
            'field3' => 'Field Description 3',
        ];
        $actual = ObjectToArray::convert(
            AnyEntityTest::class,
            $entity,
        );
        $this->assertEquals($expected['field1'], $actual['field1']);
        $this->assertEquals($expected['field2'], $actual['field2']);
        $this->assertEquals($expected['field3'], $actual['field3']);
    }
}

class AnyEntityTest extends Entity
{
    private string $field1;

    private string $field2;

    private string $field3;

    public function __construct(
        ?string $id,
        string $field1,
        string $field2,
        string $field3
    ) {
        parent::__construct($id);
        $this->field1 = $field1;
        $this->field2 = $field2;
        $this->field3 = $field3;
    }

    /**
     * Get the value of field1
     */
    public function getField1()
    {
        return $this->field1;
    }

    /**
     * Get the value of field2
     */
    public function getField2()
    {
        return $this->field2;
    }

    /**
     * Get the value of field3
     */
    public function getField3()
    {
        return $this->field3;
    }

    public function serialize()
    {
        return get_object_vars($this);
    }
}
