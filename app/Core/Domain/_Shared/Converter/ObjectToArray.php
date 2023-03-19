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
        $firstLowerCase = lcfirst($replaceGetToSpace);
        return ObjectToArray::convertCamelCaseTo_LowerCase($firstLowerCase);
    }

    private static function isAValidMethod(string $method): bool
    {
        if (!str_contains($method, 'get')) {
            return false;
        }

        if ($method === 'getNotification') {
            return false;
        }        

        return true;
    }

    private static function convertCamelCaseTo_LowerCase(string $values): string 
    {
        $result = $values;
        if (ObjectToArray::hasUpperCase($values)) {
            $result = '';
            $lenght = strlen($values);
            for ($cont = 0; $cont < $lenght; $cont++) {
                if (preg_match('/\p{Lu}/u', $values[$cont])) {
                    $result .= '_' . strtolower($values[$cont]);
                    continue;
                }

                $result .= $values[$cont];
            }
        }                
        return $result;  
    } 

    private static function hasUpperCase(string $value): bool
    {
        return preg_match('/\p{Lu}/u', $value);
    }
}
