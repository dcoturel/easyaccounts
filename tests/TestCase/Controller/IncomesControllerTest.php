<?php
namespace App\Test\TestCase\Controller;

use App\Controller\IncomesController;
use App\Model\Table\IncomesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\IncomesController Test Case
 */
class IncomesControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
        'app.Entries'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session(['Auth' => ['User' => [
            'id' => 1,
            'username' => 'Administrator',
        ]]]);
        $this->loadFixtures("Incomes", "Entries");
        $this->get("/incomes/index");
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session(['Auth' => ['User' => [
            'id' => 1,
            'username' => 'Administrator',
        ]]]);
        $this->loadFixtures("Incomes", "Entries");
        $this->get("/incomes/view/1");
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->session(['Auth' => ['User' => [
            'id' => 1,
            'username' => 'Administrator',
        ]]]);
        $this->loadFixtures("Incomes", "Entries");
        $this->get("/incomes/add");
        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session(['Auth' => ['User' => [
            'id' => 1,
            'username' => 'Administrator',
        ]]]);
        $this->loadFixtures("Incomes", "Entries");
        $this->get("/incomes/edit/1");
        $this->assertResponseOk();}

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->session(['Auth' => ['User' => [
            'id' => 1,
            'username' => 'Administrator',
        ]]]);
        $this->enableCsrfToken();
        $this->loadFixtures("Accounts", "CashResources", "Concepts");
        
        $config = TableRegistry::getTableLocator()->exists('Incomes') ? [] : ['className' => IncomesTable::class];
        $this->Incomes = TableRegistry::getTableLocator()->get('Incomes', $config);
        
        $goodIncome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $entries = $this->Incomes->Entries->find('all', [])->count();
        $entry_items = $this->Incomes->Entries->EntryItems->find('all', [])->count();
        
        $this->assertInstanceOf("\App\Model\Entity\Income", $this->Incomes->save($this->Incomes->newEntity($goodIncome)));
        $this->assertInstanceOf("\App\Model\Entity\Income", $this->Incomes->save($this->Incomes->newEntity($goodIncome)));
        $this->assertEquals($entries + 2, $this->Incomes->Entries->find('all', [])->count());
        $this->assertEquals($entry_items + 4, $this->Incomes->Entries->EntryItems->find('all', [])->count());
        $this->delete('/incomes/delete/2');
        $this->assertResponseCode(302);
        $this->assertEquals($entries + 1, $this->Incomes->Entries->find('all', [])->count());
        $this->assertEquals($entry_items + 2, $this->Incomes->Entries->EntryItems->find('all', [])->count());
    }
}
