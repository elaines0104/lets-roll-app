<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriesPlacesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriesPlacesTable Test Case
 */
class CategoriesPlacesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CategoriesPlacesTable
     */
    public $CategoriesPlaces;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CategoriesPlaces',
        'app.Categories',
        'app.Places',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CategoriesPlaces') ? [] : ['className' => CategoriesPlacesTable::class];
        $this->CategoriesPlaces = TableRegistry::getTableLocator()->get('CategoriesPlaces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoriesPlaces);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
