<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransferencesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransferencesTable Test Case
 */
class TransferencesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TransferencesTable
     */
    public $Transferences;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Transferences',
        'app.CashResources',
        'app.Entries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Transferences') ? [] : ['className' => TransferencesTable::class];
        $this->Transferences = TableRegistry::getTableLocator()->get('Transferences', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Transferences);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->loadFixtures('Accounts', 'CashResources', 'Concepts', 'Entries', 'EntryItems', 'Users');
        
        $this->Transferences->Entries->EntryItems->deleteAll(['1=1']);
        $this->Transferences->Entries->deleteAll(['1=1']);
        
        $goodItem = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_in_id' => 1,
            'cash_resource_out_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $badItem = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => 'Peter',
            'amount' => 1.5,
            'cash_resource_in_id' => 1,
            'cash_resource_out_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $this->assertInstanceOf("\App\Model\Entity\Transference", $this->Transferences->save($this->Transferences->newEntity($goodItem)));
        $this->assertFalse($this->Transferences->save($this->Transferences->newEntity($badItem)));
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->loadFixtures('Accounts', 'CashResources', 'Concepts', 'Entries', 'EntryItems');
        
        $this->Transferences->Entries->EntryItems->deleteAll(['1=1']);
        $this->Transferences->Entries->deleteAll(['1=1']);
        
        $goodItem = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_in_id' => 1,
            'cash_resource_out_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $badItem = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_in_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $this->assertInstanceOf("\App\Model\Entity\Transference", $this->Transferences->save($this->Transferences->newEntity($goodItem)));
        $this->assertFalse($this->Transferences->save($this->Transferences->newEntity($badItem)));
    }
}
