<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OutcomesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OutcomesTable Test Case
 */
class OutcomesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OutcomesTable
     */
    public $Outcomes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Accounts',
        'app.Outcomes',
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
        $config = TableRegistry::getTableLocator()->exists('Outcomes') ? [] : ['className' => OutcomesTable::class];
        $this->Outcomes = TableRegistry::getTableLocator()->get('Outcomes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Outcomes);

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
        
        $this->Outcomes->Entries->EntryItems->deleteAll(['1=1']);
        $this->Outcomes->Entries->deleteAll(['1=1']);
        
        $goodOutcome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $badOutcome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => 'Peter',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $this->assertInstanceOf("\App\Model\Entity\Outcome", $this->saveOutcome($goodOutcome));
        $this->assertFalse($this->saveOutcome($badOutcome)); }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->loadFixtures('Accounts', 'CashResources', 'Concepts', 'Entries', 'EntryItems', 'Users');
        
        $this->Outcomes->Entries->EntryItems->deleteAll(['1=1']);
        $this->Outcomes->Entries->deleteAll(['1=1']);
        
        $goodOutcome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $badOutcome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $this->assertInstanceOf("\App\Model\Entity\Outcome", $this->saveOutcome($goodOutcome));
        $this->assertFalse($this->saveOutcome($badOutcome));
        
    }
    
    public function testBeforeSave()
    {
        $this->loadFixtures('Accounts', 'CashResources', 'Concepts', 'Entries', 'EntryItems', 'Users');
        
        $this->Outcomes->Entries->EntryItems->deleteAll(['1=1']);
        $this->Outcomes->Entries->deleteAll(['1=1']);
        
        $Outcome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'user_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $OutcomeO = $this->Outcomes->newEntity();
        $OutcomeO = $this->Outcomes->patchEntity($OutcomeO, $Outcome);
        
        $result = $this->Outcomes->save($OutcomeO);
        
        $this->assertInstanceOf("\App\Model\Entity\Outcome", $result);
        
        $this->assertEquals(0, $this->Outcomes->Entries->EntryItems->balance());
    }
    
    private function saveOutcome($Outcome) {
        $OutcomeO = $this->Outcomes->newEntity();
        $OutcomeO = $this->Outcomes->patchEntity($OutcomeO, $Outcome);
        
        $result = $this->Outcomes->save($OutcomeO);
        return($result);
    }
}
