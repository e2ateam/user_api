<?php

namespace App\Core\Domain\_Shared\Converter;

use App\Core\Domain\_Shared\Entity\Entity;

class ObjectToArray
{
    public static function convert(string $className, Entity $entity): array 
    {
        $class = new \ReflectionClass($className);

        $methods = $class->getMethods();
        $result = [];
        
        foreach ($methods as $method) {
            if (ObjectToArray::isAValidMethod($method->getName())) {            
                $attr = $class->getMethod($method->getName());
                $attrName = ObjectToArray::getAttrNameWithoutGetAndLowercase(
                    $attr->getName()
                );
                $result[$attrName] = $attr->invoke($entity);            
            }
        }

        return $result;
    }

    private static function getAttrNameWithoutGetAndLowercase(string $attr)
    {
        $replaceGetToSpace = str_replace('get', '', $attr);
        return strtolower($replaceGetToSpace);
    }

    private static function isAValidMethod(string $method): bool
    {
        if (!str_contains($method, 'get')) {
            return false;
        }

        if ($method === 'getNotification') {
            return false;
        }

        if ($method === 'serialize') {
            return false;
        }

        return true;
    }
}
