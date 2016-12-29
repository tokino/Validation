<?php
/**
 * Created by PhpStorm.
 * User: kino
 * Date: 2016/12/29
 * Time: 17:03
 */


use Tokino\Validation\Error;


class ErrorTest extends PHPUnit_Framework_TestCase
{
    public function errorProvider() {
        return array(array(new Error(array('test'))));
    }

    /**
     * @dataProvider errorProvider
     * @param Error $error
     */
    public function testError($error) {
        $this->assertEquals('test', $error->render(0));
    }

    /**
     * @dataProvider errorProvider
     * @param Error $error
     */
    public function testFormatError($error) {
        $error->setFormat('<p>%s</p>');
        $this->assertEquals('<p>test</p>', $error->render(0));
    }

    /**
     * @dataProvider errorProvider
     * @param Error $error
     */
    public function testHasError($error) {
        $this->assertTrue($error->hasError());
    }

    /**
     * @dataProvider errorProvider
     * @param Error $error
     */
    public function testGetError($error) {
        $this->assertTrue((bool)count($error->getErrors()));
    }
}