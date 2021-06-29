<?php

namespace Paginate\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Paginate\Controller\Component\PaginateComponent;

/**
 * Paginate\Controller\Component\PaginateComponent Test Case
 */
class PaginateComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Paginate\Controller\Component\PaginateComponent
     */
    public $Paginate;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Paginate = new PaginateComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Paginate);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
