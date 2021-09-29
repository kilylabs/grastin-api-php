<?php

namespace Kily\Delivery\Tests\Grastin;

use Kily\Delivery\Grastin\Delivery;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-05-21 at 00:54:39.
 */
class DeliveryTest extends TestCase
{
    /**
     * @var Delivery
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->object = new Delivery('');
        parent::setUp();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();
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
        $this->object->setOptions(['a' => 'b']);
        $this->object->setOption('a', 'c');
        $this->assertEquals($this->object->getOption('a'), 'c');
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::getOption
     */
    public function testGetOption()
    {
        $this->object->setOptions(['a' => 'b']);
        $this->assertEquals($this->object->getOption('a'), 'b');
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Orderinformation
     */
    public function testOrderinformation()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $d->orderinformation([123]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Selfpickup
     */
    public function testSelfpickup()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $list = $d->selfpickup();
        $this->assertTrue(count($list) > 0);
        $this->assertArrayHasKey(0, $list);
        $this->assertArrayHasKey('Name', $list[0]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Warehouse
     */
    public function testWarehouse()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $list = $d->warehouse();
        $this->assertTrue(count($list) > 0);
        $this->assertArrayHasKey(0, $list);
        $this->assertArrayHasKey('Name', $list[0]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::Deliveryregion
     */
    public function testDeliveryregion()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $d->deliveryregion();
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::boxberryselfpickup
     */
    public function testBoxberryselfpickup()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $d->boxberryselfpickup();
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::boxberrypostcode
     */
    public function testBoxberrypostcode()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $d->boxberrypostcode();
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::hermesselfpickup
     */
    public function testHermesselfpickup()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $d->hermesselfpickup();
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::statushistory
     */
    public function testStatushistory()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $d->statushistory([123]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::printactofreceiving
     */
    public function testPrintactofreceiving()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $d->printactofreceiving([123]);
    }

    /**
     * @covers Kily\Delivery\Grastin\Delivery::agentreportlist
     */
    public function testAgentreportlist()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped('No API_KEY defined');
        }

        $d = new Delivery($_SERVER['API_KEY']);
        $list = $d->agentreportlist('1970-01-01','1970-01-01');
        $this->assertTrue(is_array($list));
    }
}
