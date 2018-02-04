<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CocktailsElementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CocktailsElementsTable Test Case
 */
class CocktailsElementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CocktailsElementsTable
     */
    public $CocktailsElements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cocktails_elements',
        'app.cocktails',
        'app.cocktails_tags',
        'app.tags',
        'app.elements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CocktailsElements') ? [] : ['className' => CocktailsElementsTable::class];
        $this->CocktailsElements = TableRegistry::get('CocktailsElements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CocktailsElements);

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
