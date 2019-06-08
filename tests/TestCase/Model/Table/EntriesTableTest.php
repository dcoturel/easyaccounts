<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EntriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EntriesTable Test Case
 */
class EntriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EntriesTable
     */
    public $Entries;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Entries') ? [] : ['className' => EntriesTable::class];
        $this->Entries = TableRegistry::getTableLocator()->get('Entries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Entries);

        parent::tearDown();
    }

}
