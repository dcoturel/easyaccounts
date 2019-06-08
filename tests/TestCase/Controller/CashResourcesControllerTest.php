<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CashResourcesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CashResourcesController Test Case
 */
class CashResourcesControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
        $this->get('/cash-resources/index');
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
        $this->loadFixtures('Accounts', 'CashResources');
        $this->get("/cash-resources/view/1");
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
        $this->get('/cash-resources/add');
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
        $this->loadFixtures('Accounts', 'CashResources');
        $this->get("/cash-resources/edit/1");
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
        $this->loadFixtures('Accounts', 'CashResources');
        $this->delete("/cash-resources/delete/1");
        $this->assertResponseCode(302);
    }
}
