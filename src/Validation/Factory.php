<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 12:10
 */

namespace Tokino\Validation;


use ReflectionClass;
use Tokino\Validation\Rule\AbstractRule;

class Factory
{
    private $prefixRules = array(
        'Tokino\\Validation\\Rule\\',
    );

    /**
     * @param $name
     * @param array $args
     * @return AbstractRule|object
     * @throws \Exception
     */
    public function rule($name, $args = array()) {
        foreach ($this->prefixRules as $prefix) {
            $className = $prefix . ucfirst($name);

            if (!class_exists($className)) {
                continue;
            }

            $reflectionClass = new ReflectionClass($className);
            if (!$reflectionClass->isSubclassOf('Tokino\\Validation\\Rule\\AbstractRule')) {
                throw new \Exception('Invalid rules line: ' . __LINE__);
            }

            return $reflectionClass->newInstanceArgs($args);
        }

        throw new \Exception('Invalid rules');
    }
}