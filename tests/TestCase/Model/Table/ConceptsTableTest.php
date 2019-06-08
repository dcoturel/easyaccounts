<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConceptsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConceptsTable Test Case
 */
class ConceptsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConceptsTable
     */
    public $Concepts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Concepts',
        'app.Accounts'
    ];
    
    public $dropTables = false; // <- here it is 

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Concepts') ? [] : ['className' => ConceptsTable::class];
        $this->Concepts = TableRegistry::getTableLocator()->get('Concepts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Concepts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    
    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->loadFixtures("Accounts");
        $goodOne = [
            'name' => 'Lorem ipsum dolor sit amet',
            'usable' => 1,
            'account_id' => 1,
            'created' => '2019-06-03 02:41:15',
            'modified' => '2019-06-03 02:41:15'
        ];
        
        $badOne = [
            'name' => 'Lorem ipsum dolor sit amet',
            'usable' => "Im kramer",
            'account_id' => 1,
            'created' => '2019-06-03 02:41:15',
            'modified' => '2019-06-03 02:41:15'
        ];
        
        $badOne2 = [
            'usable' => "1",
            'account_id' => 1,
            'created' => '2019-06-03 02:41:15',
            'modified' => '2019-06-03 02:41:15'
        ];
        
        $entity = $this->Concepts->newEntity($goodOne);
        $this->assertInstanceOf('App\Model\Entity\Concept', $this->Concepts->save($entity));
        
        $entity = $this->Concepts->newEntity($badOne);
        $this->assertFalse($this->Concepts->save($entity));
        
        $entity = $this->Concepts->newEntity($badOne2);
        $this->assertFalse($this->Concepts->save($entity));
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->loadFixtures("Accounts");
        $goodOne = [
            'name' => 'Lorem ipsum dolor sit amet',
            'usable' => 1,
            'account_id' => 1,
            'created' => '2019-06-03 02:41:15',
            'modified' => '2019-06-03 02:41:15'
        ];
        
        $badOne = [
            'name' => 'Lorem ipsum dolor sit amet',
            'usable' => 1,
            'account_id' => 4500,
            'created' => '2019-06-03 02:41:15',
            'modified' => '2019-06-03 02:41:15'
        ];
        
        $entity = $this->Concepts->newEntity($goodOne);
        $this->assertInstanceOf('App\Model\Entity\Concept', $this->Concepts->save($entity));
        
        $entity = $this->Concepts->newEntity($badOne);
        $this->assertFalse($this->Concepts->save($entity));
    }
}
