<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 17:47
 */


use Tokino\Validation\Rule\Required;


class RequiredTest extends PHPUnit_Framework_TestCase
{
    public function testRequiredArrayFailed() {
        $inArray = new Required(array());
        $this->assertFalse($inArray->validate());
    }

    public function testRequiredStringFailed() {
        $inArray = new Required('');
        $this->assertFalse($inArray->validate());
    }

    public function testRequiredIntegerSuccess() {
        $inArray = new Required(0);
        $this->assertTrue($inArray->validate());
    }
}
