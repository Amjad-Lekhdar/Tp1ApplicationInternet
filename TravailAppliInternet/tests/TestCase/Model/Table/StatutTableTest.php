<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatutTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatutTable Test Case
 */
class StatutTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StatutTable
     */
    public $Statut;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Statut',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Statut') ? [] : ['className' => StatutTable::class];
        $this->Statut = TableRegistry::getTableLocator()->get('Statut', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Statut);

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
