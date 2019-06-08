<?php
namespace App\Test\TestCase\Controller;

use App\Controller\OutcomesController;
use App\Model\Table\OutcomesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\OutcomesController Test Case
 */
class OutcomesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Outcomes',
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
        $this->loadFixtures("Outcomes", "Entries");
        $this->get("/outcomes/index");
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
        $this->loadFixtures("Outcomes", "Entries");
        $this->get("/outcomes/view/1");
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
        $this->loadFixtures("Outcomes", "Entries");
        $this->get("/outcomes/add/1");
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
        $this->loadFixtures("Outcomes", "Entries");
        $this->get("/outcomes/edit/1");
        $this->assertResponseOk();
    }

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
        
        $config = TableRegistry::getTableLocator()->exists('Outcomes') ? [] : ['className' => OutcomesTable::class];
        $this->Outcomes = TableRegistry::getTableLocator()->get('Outcomes', $config);
        
        $goodOutcome = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_id' => 1,
            'concept_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $entries = $this->Outcomes->Entries->find('all', [])->count();
        $entry_items = $this->Outcomes->Entries->EntryItems->find('all', [])->count();
        
        $this->assertInstanceOf("\App\Model\Entity\Outcome", $this->Outcomes->save($this->Outcomes->newEntity($goodOutcome)));
        $this->assertInstanceOf("\App\Model\Entity\Outcome", $this->Outcomes->save($this->Outcomes->newEntity($goodOutcome)));
        $this->assertEquals($entries + 2, $this->Outcomes->Entries->find('all', [])->count());
        $this->assertEquals($entry_items + 4, $this->Outcomes->Entries->EntryItems->find('all', [])->count());
        $this->delete('/outcomes/delete/2');
        $this->assertResponseCode(302);
        $this->assertEquals($entries + 1, $this->Outcomes->Entries->find('all', [])->count());
        $this->assertEquals($entry_items + 2, $this->Outcomes->Entries->EntryItems->find('all', [])->count());
    }
}
