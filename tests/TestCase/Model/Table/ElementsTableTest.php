<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ElementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ElementsTable Test Case
 */
class ElementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ElementsTable
     */
    public $Elements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.elements',
        'app.cocktails_elements',
        'app.cocktails',
        'app.cocktails_tags',
        'app.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Elements') ? [] : ['className' => ElementsTable::class];
        $this->Elements = TableRegistry::get('Elements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Elements);

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
}
