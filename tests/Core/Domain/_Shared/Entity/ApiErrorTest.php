<?php

namespace Tests\Core\Domain\_Shared\Entity;

use App\Core\Domain\_Shared\Entity\ApiError;
use Tests\TestCase;

class ApiErrorTest extends TestCase
{
    public function testCreateAnApiError(): void
    {        
        $actual = new ApiError(
            '[{"context":"user","message":"name: The name field is required."}]',
            'uri/mock',
        );        
        $actualMessage = [];
        foreach ($actual->getMessage() as $message) {
            array_push($actualMessage, $message);
        }
        $this->assertNotEmpty($actual);
        $this->assertNotEmpty($actual->getTimestamp());
        $this->assertEquals('user', $actualMessage[0]['context']);
        $this->assertEquals(
            'name: The name field is required.', 
            $actualMessage[0]['message']
        );
        $this->assertEquals('uri/mock', $actual->getUri());        
    }

    public function testeSerialize(): void
    {
        $error = new ApiError(
            '[{"context":"user","message":"name: The name field is required."}]',
            'uri/mock',
        );
        $actual = $error->serialize();
        $this->assertNotEmpty($actual);
        $actualMessage = [];
        foreach ($actual['message'] as $message) {
            array_push($actualMessage, $message);
        }        
        $this->assertNotEmpty($actual['timestamp']);
        $this->assertEquals('user', $actualMessage[0]['context']);
        $this->assertEquals(
            'name: The name field is required.', 
            $actualMessage[0]['message'],
        );
        $this->assertEquals('uri/mock', $actual['uri']);
    }
}
