<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 16:35
 */


use Tokino\Validation\Rule\AbstractRule;

class TokinoDummy extends AbstractRule {

    public function __construct($value, $options = array())
    {
        $this->setOptions($options);

        $this->setValue($value);
    }

    protected function check($value)
    {
        return $value === 1;
    }
}

class AbstractRuleTest extends PHPUnit_Framework_TestCase
{

    public function testCheckDefaultError() {
        $inArray = new TokinoDummy(1);

        $this->assertEquals('', $inArray->getError());
    }

    public function testCheckCustomError() {
        $inArray = new TokinoDummy('', array(
            'message' => 'test error'
        ));

        $inArray->validate();

        $this->assertEquals('test error', $inArray->getError());
    }

    public function testCheckDefaultName() {
        $inArray = new TokinoDummy(1);

        $this->assertTrue(is_null($inArray->getName()));
    }

    public function testCheckCustomName() {
        $inArray = new TokinoDummy(1, array(
            'name' => 'test'
        ));

        $this->assertEquals('test', $inArray->getName());
    }

}
