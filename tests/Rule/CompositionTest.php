<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 21:44
 */


use Tokino\Validation\Rule\Composition;
use Tokino\Validation\Rule\InArray;
use Tokino\Validation\Rule\Regex;


class CompositionTest extends PHPUnit_Framework_TestCase
{
    public function testSuccess() {
        $validation = new Composition(array(
            new InArray('0', array(0, 1)),
            new Regex('tomohiro.kino@gooya.co.jp', '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i'),
        ));
        $this->assertTrue($validation->validate());
    }

    public function testFailed() {
        $validation = new Composition(array(
            new InArray(2, array(0, 1)),
            new Regex('tomohiro.kino@gooya.co.jp', '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i'),
        ));
        $this->assertFalse($validation->validate());
    }

    public function testErrorMsg() {
        $validation = new Composition(array(
            new InArray(2, array(0, 1)),
            new Regex('tomohiro.kino@gooya.co.jp', '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i'),
        ), array(
            'message' => 'test error',
        ));
        $validation->validate();
        $this->assertEquals('test error', $validation->getError());
    }

}
