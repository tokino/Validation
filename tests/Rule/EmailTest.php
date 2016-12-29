<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 17:47
 */


use Tokino\Validation\Rule\Email;


class EmailTest extends PHPUnit_Framework_TestCase
{
    public function testSuccess() {
        $inArray = new Email('t.kino0219@gmail.com');
        $this->assertTrue($inArray->validate());
    }

    public function testArraySuccess() {
        $inArray = new Email(array('name' => 't.kino0219@gmail.com'), array(
            'name' => 'name'
        ));
        $this->assertTrue($inArray->validate());
    }

    public function testFailed() {
        $inArray = new Email('');
        $this->assertFalse($inArray->validate());
    }

    public function testArrayFailed() {
        $inArray = new Email(array('name' => ''), array(
            'name' => 'name'
        ));
        $this->assertFalse($inArray->validate());
    }

}
