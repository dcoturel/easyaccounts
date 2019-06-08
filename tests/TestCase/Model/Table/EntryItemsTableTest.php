<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EntryItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EntryItemsTable Test Case
 */
class EntryItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EntryItemsTable
     */
    public $EntryItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EntryItems',
        'app.Entries',
        'app.Accounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EntryItems') ? [] : ['className' => EntryItemsTable::class];
        $this->EntryItems = TableRegistry::getTableLocator()->get('EntryItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EntryItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->loadFixtures('Entries');
        $goodItem = [
            'entry_id' => 1,
            'account_id' => 1,
            'sign' => 'D',
            'amount' => 1.5,
        ];
        
        $badItem = [
            'entry_id' => 1,
            'account_id' => 0,
            'sign' => 'D',
            'amount' => 1.5,];
        
        
        
        $this->assertInstanceOf("\App\Model\Entity\EntryItem", $this->EntryItems->save($this->EntryItems->newEntity($goodItem)));
        $this->assertFalse($this->EntryItems->save($this->EntryItems->newEntity($badItem)));
        
        $badItem = [
            'entry_id' => 1,
            'account_id' => 0,
            'sign' => 'D',
            'amount' => 1.5,];
        
        $this->assertFalse($this->EntryItems->save($this->EntryItems->newEntity($badItem)));
    }
}
