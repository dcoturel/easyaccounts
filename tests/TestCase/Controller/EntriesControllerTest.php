<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EntriesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\EntriesController Test Case
 */
class EntriesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Entries',
        'app.EntryItems'
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
        $this->loadFixtures("Entries", "EntryItems");
        $this->get("/entries/index");
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
        $this->loadFixtures("Entries", "EntryItems");
        $this->get("/entries/view/1");
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
        $this->loadFixtures("Entries", "EntryItems");
        $this->enableCsrfToken();
        $this->post("/entries/delete/1");
        $this->assertResponseCode(302);
    }
}
