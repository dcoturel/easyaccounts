<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CashResourcesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CashResourcesTable Test Case
 */
class CashResourcesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CashResourcesTable
     */
    public $CashResources;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CashResources',
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
        $config = TableRegistry::getTableLocator()->exists('CashResources') ? [] : ['className' => CashResourcesTable::class];
        $this->CashResources = TableRegistry::getTableLocator()->get('CashResources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CashResources);

        parent::tearDown();
    }

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
        
        $entity = $this->CashResources->newEntity($goodOne);
        $this->assertInstanceOf('App\Model\Entity\CashResource', $this->CashResources->save($entity));
        
        $entity = $this->CashResources->newEntity($badOne);
        $this->assertFalse($this->CashResources->save($entity));
        
        $entity = $this->CashResources->newEntity($badOne2);
        $this->assertFalse($this->CashResources->save($entity));
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
        
        $entity = $this->CashResources->newEntity($goodOne);
        $this->assertInstanceOf('App\Model\Entity\CashResource', $this->CashResources->save($entity));
        
        $entity = $this->CashResources->newEntity($badOne);
        $this->assertFalse($this->CashResources->save($entity));
    }
}
