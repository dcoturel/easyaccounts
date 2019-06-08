<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IncomesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IncomesTable Test Case
 */
class IncomesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IncomesTable
     */
    public $Incomes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Accounts',
        'app.Incomes',
        'app.CashResources',
        'app.Concepts',
        'app.Entries',
        'app.EntryItems',
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
        $config = TableRegistry::getTableLocator()->exists('Incomes') ? [] : ['className' => IncomesTable::class];
        $this->Incomes = TableRegistry::getTableLocator()->get('Incomes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Incomes);

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
        
        $this->Incomes->Entries->EntryItems->deleteAll(['1=1']);
        $this->Incomes->Entries->deleteAll(['1=1']);
        
        $goodIncome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $badIncome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => 'Peter',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $this->assertInstanceOf("\App\Model\Entity\Income", $this->saveIncome($goodIncome));
        $this->assertFalse($this->saveIncome($badIncome));        
        
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->loadFixtures('Accounts', 'CashResources', 'Concepts', 'Entries', 'EntryItems');
        
        $this->Incomes->Entries->EntryItems->deleteAll(['1=1']);
        $this->Incomes->Entries->deleteAll(['1=1']);
        
        $goodIncome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $badIncome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $this->assertInstanceOf("\App\Model\Entity\Income", $this->saveIncome($goodIncome));
        $this->assertFalse($this->saveIncome($badIncome));
        
    }

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->loadFixtures('Accounts', 'CashResources', 'Concepts', 'Entries', 'EntryItems');
        
        $this->Incomes->Entries->EntryItems->deleteAll(['1=1']);
        $this->Incomes->Entries->deleteAll(['1=1']);
        
        $income = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $incomeO = $this->Incomes->newEntity();
        $incomeO = $this->Incomes->patchEntity($incomeO, $income);
        
        $result = $this->Incomes->save($incomeO);  
        
        $this->assertInstanceOf("\App\Model\Entity\Income", $result);
        
        $this->assertEquals(0, $this->Incomes->Entries->EntryItems->balance());
        $this->assertEquals(0, $this->Incomes->Entries->EntryItems->totalAt("1", "2019-06-30"));
    }
    
    private function saveIncome($income) {
        $incomeO = $this->Incomes->newEntity();
        $incomeO = $this->Incomes->patchEntity($incomeO, $income);
        
        $result = $this->Incomes->save($incomeO);
        return($result);
    }
}
