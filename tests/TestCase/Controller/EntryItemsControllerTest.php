<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EntryItemsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\EntryItemsController Test Case
 */
class EntryItemsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
        $this->loadFixtures("Accounts", "Entries", "EntryItems");
        $this->get("/entry-items/index");
        $this->assertResponseOk();
    }
    
    public function testAccountLedger()
    {
        $this->session(['Auth' => ['User' => [
            'id' => 1,
            'username' => 'Administrator',
        ]]]);
        $this->loadFixtures("Accounts", "Entries", "EntryItems");
        $this->get("/entry-items/account_ledger/1");
        $this->assertResponseOk();
    }
    
    public function testBalance()
    {
        $this->session(['Auth' => ['User' => [
            'id' => 1,
            'username' => 'Administrator',
        ]]]);
        $this->loadFixtures("Accounts", "Entries", "EntryItems");
        $this->get("/entry-items/balance");
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
        $this->loadFixtures("Accounts", "Entries", "EntryItems");
        $this->get("/entry-items/view/1");
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
        $this->loadFixtures("Accounts", "Entries", "EntryItems");
        $this->enableCsrfToken();
        $this->post("/entry-items/delete/1");
        $this->assertResponseCode(302);
    }
}
