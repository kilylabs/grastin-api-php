<?php
namespace Kily\Delivery\Tests\Grastin;

use Kily\Delivery\Grastin\Delivery;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-05-21 at 00:54:39.
 */
class DeliveryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Delivery
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Delivery('');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::setOptions
     */
    public function testSetOptions()
    {
        $this->object->setOptions([]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::getOptions
     */
    public function testGetOptions()
    {
        $this->object->setOptions([]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::setOption
     */
    public function testSetOption()
    {
        $this->object->setOptions(['a'=>'b']);
        $this->object->setOption('a','c');
        $this->assertEquals($this->object->getOption('a'),'c');
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::getOption
     * @todo   Implement testGetOption().
     */
    public function testGetOption()
    {
        $this->object->setOptions(['a'=>'b']);
        $this->assertEquals($this->object->getOption('a'),'b');
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Orderinformation
     * @todo   Implement testOrderinformation().
     */
    public function testOrderinformation()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Selfpickup
     * @todo   Implement testSelfpickup().
     */
    public function testSelfpickup()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
        $list = $d->selfpickup();
        $this->assertTrue(count($list) > 0);
        $this->assertArrayHasKey(0,$list);
        $this->assertArrayHasKey('Name',$list[0]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Warehouse
     * @todo   Implement testWarehouse().
     */
    public function testWarehouse()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
        $list = $d->warehouse();
        $this->assertTrue(count($list) > 0);
        $this->assertArrayHasKey(0,$list);
        $this->assertArrayHasKey('Name',$list[0]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Deliveryregion
     * @todo   Implement testDeliveryregion().
     */
    public function testDeliveryregion()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::boxberryselfpickup
     * @todo   Implement testBoxberryselfpickup().
     */
    public function testBoxberryselfpickup()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::boxberrypostcode
     * @todo   Implement testBoxberrypostcode().
     */
    public function testBoxberrypostcode()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::hermesselfpickup
     * @todo   Implement testHermesselfpickup().
     */
    public function testHermesselfpickup()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::statushistory
     * @todo   Implement testStatushistory().
     */
    public function testStatushistory()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::printactofreceiving
     * @todo   Implement testPrintactofreceiving().
     */
    public function testPrintactofreceiving()
    {
        if(!isset($_SERVER['API_KEY']))
            $this->markTestSkipped("No API_KEY defined");

        $d = new Delivery($_SERVER['API_KEY']);
    }
}