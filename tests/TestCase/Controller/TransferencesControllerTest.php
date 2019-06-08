<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TransferencesController;
use App\Model\Table\TransferencesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TransferencesController Test Case
 */
class TransferencesControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
        $this->loadFixtures('CashResources', 'Transferences');
        $this->get('/transferences/index');
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
        $this->loadFixtures('CashResources', 'Transferences');
        $this->get('/transferences/view/1');
        $this->assertResponseOk();}

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
        $this->loadFixtures('CashResources', 'Transferences');
        $this->get('/transferences/add');
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
        $this->loadFixtures('CashResources', 'Transferences');
        $this->get('/transferences/edit/1');
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
        
        $config = TableRegistry::getTableLocator()->exists('Transferences') ? [] : ['className' => TransferencesTable::class];
        $this->Transferences = TableRegistry::getTableLocator()->get('Transferences', $config);
        
        $goodTransference = [
            'reference' => 'Lorem ipsum dolor sit amet',
            'date' => '2019-06-04',
            'amount' => 1.5,
            'cash_resource_in_id' => 1,
            'cash_resource_out_id' => 1,
            'created' => '2019-06-04 01:56:19',
            'modified' => '2019-06-04 01:56:19'
        ];
        
        $entries = $this->Transferences->Entries->find('all', [])->count();
        $entry_items = $this->Transferences->Entries->EntryItems->find('all', [])->count();
        
        $this->assertInstanceOf("\App\Model\Entity\Transference", $this->Transferences->save($this->Transferences->newEntity($goodTransference)));
        $this->assertInstanceOf("\App\Model\Entity\Transference", $this->Transferences->save($this->Transferences->newEntity($goodTransference)));
        $this->assertEquals($entries + 2, $this->Transferences->Entries->find('all', [])->count());
        $this->assertEquals($entry_items + 4, $this->Transferences->Entries->EntryItems->find('all', [])->count());
        $this->delete('/transferences/delete/2');
        $this->assertResponseCode(302);
        $this->assertEquals($entries + 1, $this->Transferences->Entries->find('all', [])->count());
        $this->assertEquals($entry_items + 2, $this->Transferences->Entries->EntryItems->find('all', [])->count());
        
    }
}
