<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AccountsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\AccountsController Test Case
 */
class AccountsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Accounts'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'Administrator',
                    // other keys.
                ]
            ]
        ]);
        $this->get('/accounts/index');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'Administrator',
                    // other keys.
                ]
            ]
        ]);
        $this->loadFixtures("Accounts");
        $this->get('/accounts/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'Administrator',
                    // other keys.
                ]
            ]
        ]);
        $this->get('/accounts/add');
        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'Administrator',
                    // other keys.
                ]
            ]
        ]);
        $this->loadFixtures("Accounts");
        $this->get('/accounts/edit/1');
        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'Administrator',
                    // other keys.
                ]
            ]
        ]);
        $this->enableCsrfToken();
        $this->loadFixtures("Accounts");
        $this->delete('/accounts/delete/1');
        $this->assertResponseCode(302);
        
    }
}
