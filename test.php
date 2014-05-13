<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午4:58
 * To change this template use File | Settings | File Templates.
 */

class IndexTest extends \PHPUnit_Framework_TestCase
{
    public function testHello()
    {
        $_GET['name'] = 'kendoctor';

        ob_start();
        include 'index.php';
        $content = ob_get_clean();

        $this->assertEquals('Hello kendoctor', $content);
    }
}