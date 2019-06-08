<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountsTable Test Case
 */
class AccountsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountsTable
     */
    public $Accounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Accounts') ? [] : ['className' => AccountsTable::class];
        $this->Accounts = TableRegistry::getTableLocator()->get('Accounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Accounts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidation()
    {
		$goodCase = [
		        'code' => '111',
                'name' => 'Lorem ipsum dolor sit amet',
                'usable' => 1,
                'created' => '2019-06-03 01:29:02',
                'modified' => '2019-06-03 01:29:02'
            ];
			
		$badCase = [
		        'code' => '111',
                'usable' => "Peter",
                'created' => '2019-06-03 01:29:02',
                'modified' => '2019-06-03 01:29:02'
            ];
			
		$badCase2 = [
		        'code' => '111',
                'name' => 'Lorem ipsum dolor sit amet',
                'usable' => "Peter",
                'created' => '2019-06-03 01:29:02',
                'modified' => '2019-06-03 01:29:02'
            ];
			
		$entity = $this->Accounts->newEntity();
		$entity = $this->Accounts->patchEntity($entity, $goodCase);
		$this->assertInstanceOf('App\Model\Entity\Account', $this->Accounts->save($entity));
		$entity = $this->Accounts->newEntity();
		$entity = $this->Accounts->patchEntity($entity, $badCase);
		$this->assertFalse($this->Accounts->save($entity));
		$entity = $this->Accounts->newEntity();
		$entity = $this->Accounts->patchEntity($entity, $badCase2);
		$this->assertFalse($this->Accounts->save($entity));
    }
}
